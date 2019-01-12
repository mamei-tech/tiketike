<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'id';
    protected $fillable = [];

    /**
     * Retrieve ticket's raffle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getRaffle()
    {
        return $this->belongsTo('App\Raffle', 'raffle');
    }

    /**
     * Retrieve ticket's buyer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getBuyer()
    {
        return $this->belongsTo('App\User', 'buyer');
    }

    public function getReferralsBuys()
    {
        return $this->hasOne('App\ReferralsBuys', 'ticket');
    }
}
