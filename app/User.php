<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;


    // Explicit table definition for the model
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'avatar' , 'password', 'api_token'
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

    /**
     * Retrieve user's tickets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getTickets()
    {
        return $this->hasMany('App\Ticket', 'buyer');
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
        return 'acuevas1605@gmail.com';
    }
}
