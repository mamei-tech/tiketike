<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasRoles;
    use HasMediaTrait;


    // Explicit table definition for the model
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'avatar' , 'password', 'ranking',   'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Retrieve user's profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getProfile()  {
        return $this->hasOne('App\UserProfile', 'user', 'id');
    }

    /**
     * Retrieve user's cards.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function debitcards()
    {
        return $this->hasMany('App\DebitCard', 'owner');
    }

    /**
     * Retrieve user's raffles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getRaffles()
    {
        return $this->hasMany('App\Raffle', 'owner');
    }

    public function getRafflesFollowed()
    {
        return $this->belongsToMany(Raffle::class,'follow');
    }

    public function getRafflesBuyed()
    {
       return $this->belongsToMany(Raffle::class,'tickets','buyer','raffle')->groupBy('raffles.id');
    }


    /**
     * Retrieve user's tickets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getTickets()
    {
        return $this->hasMany('App\Ticket', 'buyer');
    }


    public function getTicketsByRaffle($raffle_id)
    {
        $tickets = Ticket::with('getBuyer')
            ->where('buyer',$this->id)
            ->where('raffle',$raffle_id)
            ->get();
        return $tickets;
    }

    /**
     * Retrieve user's comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getComments()
    {
        return $this->hasMany('App\Comment', 'user');
    }

    /**
     * Get user's referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getReferralsBuys()
    {
        return $this->hasMany('App\ReferralsBuys', 'comisionist');
    }

    /**
     * Generate the user token for API authentication
     *
     * @return mixed
     */
    public function generateApiToken()
    {
        $this->attributes['api_token'] = str_random(60);
        $this->save();

        return $this->attributes['api_token'];
    }

    /**
     * Get the user token for API authentication
     *
     * @return mixed
     */
    public function getApiToken()
    {
        return $this->attributes['api_token'];
    }

    /**
     * Invalidate the user token for API authentication
     *
     */
    public function invalidateApiToken()
    {
        $this->attributes['api_token'] = null;
        $this->save();
    }

    public function routeNotificationForMail( $notification )
    {
        return $this->email;
    }

    public function WinnedRaffles()
    {
        $id = $this->id;
        return $this->hasMany('App\Raffle', 'owner')
            ->with('getTickets')
            ->whereHas('getTickets',function (Builder $q) use ($id) {
                $q->where('buyer',$id);
                $q->where('sold',1);
                $q->where('bingo',1);
            })->get();
    }

    public function getSoldTicketsCount()
    {
        $total = 0;
        foreach ($this->getRaffles() as $raffle) {
            $total += $raffle->getTickets->where('sold',1)->get();
        }
        return $total;
    }

    public function getCountryCode()
    {
        return strtoupper($this->getProfile->getCity->country->code);
    }

    public static function usersCount()
    {
        $usersCount = 0;
        User::chunk(1000, function ($users) use (&$usersCount) {
            $usersCount += count($users);
        });

        return $usersCount;
    }
}
