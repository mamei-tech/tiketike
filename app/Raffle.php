<?php

namespace App;

use App\Http\TkTk\Cfg\CfgRaffles;
use App\Http\TkTk\CodesGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Scalar\String_;
use Psy\Util\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;



class Raffle extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table        = 'raffles';
    protected $primaryKey   = 'id';

    public $incrementing    = false;

    protected $fillable = [
        'winner_id',
        'wconfirmation',
        'price',
        'progress'
    ];

    /**
     * Retrieve the raffle owner user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getOwner()
    {
        return $this->belongsTo('App\User', 'owner');
    }

    /**
     * Retrieve the raffle status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getStatus()
    {
        return $this->belongsTo('App\RaffleStatus', 'status');
    }

    /**
     * Retrieve the raffle category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCategory()
    {
        return $this->belongsTo('App\RaffleCategory', 'category');
    }

    /**
     * Retrieve all comments about this raffle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getComments()
    {
        return $this->hasMany('App\Comment', 'raffle');
    }

    /**
     * Retrieve raffle's pictures.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getPictutes()
    {
        return $this->hasMany('App\RafflePicture', 'raffle');
    }

    /**
     * Retrieve raffle's items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getItems()
    {
        return $this->hasMany('App\RaffleItem', 'raffle');
    }

    /**
     * Retrieve all payments attached to a raffle for refunds
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getPaymentsAttached()
    {
        return $this->hasMany(RafflePays::class);
    }

    /**
     * Retrieve raffle's tickets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getTickets()
    {
        return $this->hasMany('App\Ticket', 'raffle', 'id');
    }

    public function getTicketsByUser($user_id)
    {
        return $this->hasMany('App\Ticket', 'raffle');
    }

    public function getFollowers()
    {
        return $this->belongsToMany(User::class,'follow');
    }

    public function getLocation()
    {
        return $this->hasOne(Country::class,'id','location');
    }

    public function getReferrals()
    {
        return $this->hasMany(ReferralsBuys::class,'raffle_id','id');
    }

    /**
     * Perform a tickets buy
     *
     * @param $user - User that buy
     * @param $ticketIds - Ids of tickets
     * @param null $referralId
     * @param int $socialNetworkId    0 for none, 1 for facebook, 2 for twitter, 3 for instagram
     * @return bool
     */
    public function buyTickets ($user, $ticketIds, $referralId = null, $socialNetworkId = -1) {

        $moneyForCommission = $this->commissions * $this->price / 100;
        $comForTicket = $moneyForCommission / $this->tickets_count;

        $baseTicketGain = ($this->profit * $this->price / 100) / $this->tickets_count;

        if ($referralId == null)
            $this->netGain += count($ticketIds) * ($baseTicketGain + $comForTicket);
        else
            $this->netGain += count($ticketIds) * $baseTicketGain;

        if ($this->getStatus->status != 'Published')
        {
            //TODO return some error view
            echo "UNPUBLISHED RAFFLE";
            die();
        }
        $ticketsBuyed = [];
        foreach ($ticketIds as $tid)
        {
            $ticket = Ticket::where('raffle', $this->id)->where('code', $tid)->first();
            if ($ticket == null)
            {
                //TODO return some error view
                echo "UNKNOW TICKET";
                die();
            }
            if ($ticket->sold == 1)
            {
                //TODO return some error view
                echo "TICKETS HAS BEEN SOLD";
                die();
            }
            $ticket->buyer = $user->id;
            $ticket->sold = true;
            array_push($ticketsBuyed, $ticket);
        }

        //TODO transfer the money from user account to tiketike account
        //if fail, return some error view

        if ($referralId != null) //Ticket buyed by a referral.
        {
            $referralUser = User::find($referralId);
            if ($referralUser == null)
            {
                //TODO return some error view
                echo "USER NOT FOUND";
                die();
            }
            $referralsBuys = [];
            foreach ($ticketsBuyed as $ticket)
            {
                $ticket->soldByCom = true; //Ticket has been buyed by referrals

                $refBuy = new ReferralsBuys;
                $refBuy->comisionist = $referralId;
                $refBuy->ticket = $ticket->id;
                $refBuy->raffle_id = $this->id;
                $refBuy->socialNetwork = $socialNetworkId;
                array_push($referralsBuys, $refBuy);
            }
            // TODO review because the referrals profit only pass to the comissionist when raffle ends
//            $referralUserProfile = $referralUser->getProfile;
//            $referralUserProfile->balance += count($referralsBuys) * $this->commissions / $this->tickets_count;
//            $referralUserProfile->save();
            $referralUser->getReferralsBuys()->saveMany($referralsBuys);
        }
        $this->progress = $this->getProgress();
        $this->save();

        $this->getTickets()->saveMany($ticketsBuyed);
        $this->save();

        return true;
    }

    /**
     *
     * Publish the raffle and generate the tickets for it
     *
     * @param $profit
     * @param $comision
     * @param $tcount
     * @param $trpice
     */
    public function publish($profit, $comision, $tcount, $trpice){
        if($this->status == 1){

            // Setting new raffle data
            $this->profit = $profit;
            $this->commissions = $comision;
            $this->tickets_count = $tcount;
            $this->tickets_price = $trpice;
            $this->activation_date = date('Y-m-d H:i:s');

            // Changin the status of the raffle, taging it as published
            $this->status = 2;          // 2 is published status

            // Saving the raffle

            $this->save();

            //Generate tickets for the published raffle
            $tickets = [];
            for ($i = 0; $i < $tcount; $i++) {
                //Create ticket
                $currentTicket = new Ticket;
                $currentTicket->code = CodesGenerator::newTicketCode($this);
                $currentTicket->raffle = $this->id;
                //Add to tickets array
                array_push($tickets, $currentTicket);
            }

            //Save tickets
            $this->getTickets()->saveMany($tickets);
        }
    }

    /* TODO Enhance this method for situation like is the raffle is published already */
    public function anullate() {
        $this->status = 3;                    // ID for anulled status
        $this->netGain = 0;
        $this->save();
    }

    public function getProgress()
    {
        if($this->tickets_count == 0)
            return 0;
        $solds_tickets = $this->getTicketsSold();
        $progress = ($solds_tickets * 100) / $this->tickets_count;
        return $progress;

    }

    public function shuffle()
    {
        $tickets = Ticket::where('tickets.raffle', $this->id)->get();
        $length = $tickets->count();
        return $tickets[mt_rand(0, $length - 1)]->code;
    }

    public function getTicketsSold()
    {
        $tickets = Raffle::join('tickets', 'raffles.id', '=', 'tickets.raffle')
            ->select('tickets.id')
            ->where('raffles.id',$this->id)
            ->where('tickets.sold',1)
            ->count();
        return $tickets;
    }

    /* Only jpg or png files are allowed */
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('raffles')
            ->acceptsFile(function (File $file) {

                // Checking if the file already exist in the database
                $exists = DB::table('media')
                    ->where('file_name', '=' ,$file->name)
                    ->where('mime_type', '=' ,$file->mimeType)
                    ->where('disk', '=' ,'avatars')
                    ->where('size', '=' ,$file->size)
                    ->exists();

                if ($exists)
                    return false;
                if ($file->mimeType !== 'image/jpeg' && $file->mimeType !== 'image/png')
                    return false;
                else
                    return true;
            });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany with raffle available tickets
     */
    public function getTicketsAvailable() {
        return $this->hasMany('App\Ticket', 'raffle', 'id')->where('sold','=',false);
    }

    public static function rafflesNetGain()
    {
        $netGain = 0;
        Raffle::chunk(1000, function ($raffles) use (&$netGain) {
            foreach ($raffles as $r) {
                if ($r->status != 3)    // Not anulled
                    $netGain += $r->netGain;
            }
        });

        return $netGain;
    }

    public static function sharedRaffles()
    {
        return Raffle::join('tickets', 'raffles.id', '=', 'tickets.raffle')
            ->join('referralsbuys', 'tickets.id', '=', 'referralsbuys.ticket')
            ->select(
                'raffles.id',
                'raffles.title',
                'raffles.price'
            )
            ->groupBy('raffles.id')->get();
    }

    public function referralsInfo()
    {
        return Raffle::join('tickets', 'raffles.id', '=', 'tickets.raffle')
            ->join('referralsbuys', 'tickets.id', '=', 'referralsbuys.ticket')
            ->join('users', 'users.id', '=', 'referralsbuys.comisionist')
            ->select(
                'users.id',
                'users.name',
                DB::raw('count(users.id) as shared_tickets')
            )
            ->where('raffles.id', '=', $this->id)
            ->groupBy('users.id')
            ->get();
    }
}
