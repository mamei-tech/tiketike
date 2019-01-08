<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RaffleStatus extends Model
{
    protected $table = 'rafflestatus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'status'
    ];

    /**
     * Retrieve the raffles that are in this status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getRaffles() {
        return $this->hasMany('App\Raffle', 'status');
    }
}
