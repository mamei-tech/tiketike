<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoClient extends Model
{
    // Explicit table definition for the model
    protected $table = 'promoclients';
    // Explicit primary key definition for the model
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'website',             // ecxept contact
    ];

    public function promos()
    {
        return $this->hasMany('App\Promo', 'client');
    }
}
