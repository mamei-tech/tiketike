<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    // Explicit table definition for the model
    protected $table = 'cities';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'country'];

    public function getCountry(){
        return $this->belongsTo('App\Country', 'country', 'id');
    }

    public function getUserProfiles() {
        return $this->hasMany('App\UserProfile', 'city', 'id');
    }

}
