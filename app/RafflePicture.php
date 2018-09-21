<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RafflePicture extends Model
{
    protected $table = 'rafflepictures';
    protected $primaryKey = 'id';
    protected $fillable = ['src'];

    /**
     * Retrieve picture's raffle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getRaffle()
    {
        return $this->belongsTo('App\Raffle', 'raffle');
    }
}
