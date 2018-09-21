<?php

namespace App;

use App\Http\Aux\CodesGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;


class Raffle extends Model
{
    protected $table = 'raffles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'description',
        'price'
    ];

    /*public function __construct(array $attributes = [])
    {
        $this->id = CodesGenerator::newRaffleId();
        parent::__construct($attributes);
    }*/

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
     * Retrieve raffle's tickets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getTickets()
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
    /**
     * Perform a tickets buy
     *
     * @param $user             User that buy
     * @param $ticketIds        Ids of tickets
     * @param $url              Url from that the buy is performed
     * @param null $referralId If not null is the referral id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function  buyTickets($user, $ticketIds, $url, $referralId = null)
    {
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
            if ($ticket->sold)
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

        $this->getTickets()->saveMany($ticketsBuyed);

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
                $refBuy = new ReferralsBuys;
                $refBuy->comisionist = $referralId;
                $refBuy->ticket = $ticket->id;
                array_push($referralsBuys, $refBuy);
            }
            $referralUserProfile = $referralUser->getProfile;
            $referralUserProfile->balance += count($referralsBuys) * $this->commissions / $this->tickets_count;
            $referralUserProfile->save();
            $referralUser->getReferralsBuys()->saveMany($referralsBuys);
        }

        return redirect($url, 303);
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
        $this->save();
    }


    /**
     * Retrieve all the Anulled raffles
     *
     * @return mixed
     */
    public static function getAnulleddRaffles()
    {
        return DB::table('raffles')
            ->join('rafflestatus', 'raffles.status', '=', 'rafflestatus.id')
            ->join('tickets', 'raffles.id', '=', 'tickets.raffle')
            ->select(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                DB::raw('sum(tickets.sold) as solds_tickets'),
                'raffles.tickets_count',
                'raffles.activation_date')
            ->where('rafflestatus.status', 'Cancelled')
            ->groupBy(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_count',
                'raffles.activation_date'
            )
            ->paginate(10);
    }


    /**
     * Retrieve all the Published raffles
     *
     * @return mixed
     */
    public static function getPublishedRaffles()
    {
        return DB::table('raffles')
            ->join('rafflestatus', 'raffles.status', '=', 'rafflestatus.id')
            ->join('tickets', 'raffles.id', '=', 'tickets.raffle')
            ->select(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_price',
                DB::raw('sum(tickets.sold) as solds_tickets'),
                'raffles.tickets_count',
                'raffles.activation_date')
            ->where('rafflestatus.status', 'Published')
            ->groupBy(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_price',
                'raffles.tickets_count',
                'raffles.activation_date'
            )
            ->paginate(10);
    }


    /**
     * Retrieve all the unpublished raffles
     *
     * @return mixed
     */
    public static function getUnpublishedRaffles()
    {
        return DB::table('raffles')
            ->join('rafflestatus', 'raffles.status', '=', 'rafflestatus.id')
            ->select(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit'
            )
            ->where('rafflestatus.status', 'Unpublished')
            ->groupBy(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit'
            )
            ->paginate(2);
    }

    /**
     * Retrieve the raffles that are almost sold, all his tickets I mean.
     *
     * @return Collection
     */
    public static function almostsoldraffles() {

        $rafflesdbquery = Raffle::join('rafflestatus', 'raffles.status', '=', 'rafflestatus.id')
            ->join('tickets', 'raffles.id', '=', 'tickets.raffle')
            ->select(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_price',
                DB::raw('sum(tickets.sold) as solds_tickets'),
                'raffles.tickets_count',
                'raffles.activation_date')
            ->where('rafflestatus.status', 'Published')
            ->groupBy(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_price',
                'raffles.tickets_count',
                'raffles.activation_date'

            )
            ->take(35)                  // Limit the query to 35 raffles
            ->paginate(10);

        $almostsoldraffles = new Collection();

        $break = 0;
        foreach ($rafflesdbquery as $key => $raffle)
        {
            // Checking if the progress of the raffle is higher than 80 %
            $progres = ($raffle->solds_tickets * 100) / $raffle->tickets_count;
            if ($progres >= 80)
                $almostsoldraffles->add($raffle);

            // Braking the habit
            if ($break == 23)                                   // 0 ~ 23  count 24
                break;

            $break++;
        }

        return $almostsoldraffles;
    }

    public function suflee()
    {
        $tickets = Ticket::where('tickets.raffle', $this->id)->get();
        $length = $tickets->count();
        return $tickets[mt_rand(0, $length - 1)]->code;
    }
}
