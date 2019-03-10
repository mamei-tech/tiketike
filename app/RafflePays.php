<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 3/9/2019
 * Time: 8:13 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class RafflePays extends Model
{
    protected $table        = 'raffles';
    protected $primaryKey   = 'id';

    protected $fillable = [
        'raffle_id',
        'charge_id',
        'amount',
    ];
}