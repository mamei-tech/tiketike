<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaffleItem extends Model
{
    protected $table = 'raffleitems';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description'];

    /**
     * Retrieve item's raffle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getRaffle()
    {
        return $this->belongsTo('App\Raffle', 'raffle');
    }
}
