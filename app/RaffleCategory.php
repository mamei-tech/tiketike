<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RaffleCategory extends Model
{
    protected $table = 'rafflecategories';
    protected $primaryKey = 'id';
    protected $fillable = ['category'];

    /**
     * Retrieve category's raffles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getRaffles()
    {
        return $this->hasMany('App\Raffle', 'category');
    }
}
