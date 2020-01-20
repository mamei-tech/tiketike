<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table        = 'tickets';
    protected $primaryKey   = 'id';

    protected $fillable     = ['raffle', 'code'];


    public static function ticketsCount()
    {
        $ticketsCount = 0;
        Ticket::chunk(1000, function ($ticket) use (&$ticketsCount) {
            $ticketsCount += count($ticket);
        });

        return $ticketsCount;
    }

    /**
     * Retrieve ticket's raffle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getRaffle() {
        return $this->belongsTo('App\Raffle', 'raffle', 'id');
    }

    /**
     * Retrieve ticket's buyer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getBuyer() {
        return $this->belongsTo('App\User', 'buyer');
    }

    public function getReferralsBuys() {
        return $this->hasOne('App\ReferralsBuys', 'ticket');
    }
}
