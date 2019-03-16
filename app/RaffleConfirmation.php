<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 3/11/2019
 * Time: 11:49 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class RaffleConfirmation extends Model
{
    protected $table        = 'raffle_confirmation';
    protected $primaryKey   = 'id';

    protected $fillable = [
        'title',
        'description',
        'owner_id',
        'oconfirmation',
        'raffle_id'
    ];

    public function getWinner()
    {
        return $this->hasOne(User::class,'winner_id','id');
    }

    public function getOwner()
    {
        return $this->hasOne(User::class,'owner_id','id');
    }

    public function getRaffle()
    {
        return $this->hasOne(Raffle::class,'raffle_id','id');
    }
}