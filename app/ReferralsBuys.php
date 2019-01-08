<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralsBuys extends Model
{
    protected $table = 'referralsbuys';
    protected $primaryKey = 'id';
    protected $fillable = [];

    /**
     * Get the sharer user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getComisionist()
    {
        return $this->belongsTo('App\User', 'comisionist');
    }

    /**
     * Get the shared ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getTicket()
    {
        return $this->belongsTo('App\Ticket', 'ticket');
    }
}
