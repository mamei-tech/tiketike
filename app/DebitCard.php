<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DebitCard extends Model
{
    protected $table = 'debitcards';
    protected $primaryKey = 'id';

    /**
     * Retrieve card's owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getOwner()
    {
        return $this->belongsTo('App\User', 'owner');
    }


    /**
     * Retrieve the expiration month of the credit card
     *
     * @return string
     */
    public function getExpMonth()
    {
        return explode("/", $this->expiration)[0];
    }

    /**
     * Retrieve the expiration year of the credit card
     *
     * @return string
     */
    public function getExpYear()
    {
        return explode("/", $this->expiration)[1];
    }
}
