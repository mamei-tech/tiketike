<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function getUser()
    {
        return $this->morphedByMany(User::class, 'payable')->withTimestamps();
    }

    public function getRaffle()
    {
        return $this->morphedByMany(Raffle::class, 'payable')->withTimestamps();
    }
}
