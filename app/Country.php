<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // Explicit table definition for the model
    protected $table = 'countries';
    // Explicit primary key definition for the model
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];


    public function cities()
    {
        return $this->hasMany('App\City', 'country', 'id');
    }

}
