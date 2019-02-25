<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveUsers extends Model
{
    protected $table        = 'activeusers';
    protected $primaryKey   = 'id';

    public static function updateCurrentDay($maleCount, $femaleCount) {
        $currentDay = ActiveUsers::find(0);
        $currentDay->male_count     = $maleCount;
        $currentDay->female_count   = $femaleCount;
        $currentDay->save();
    }

    public static function shiftDays() {
        $days = ActiveUsers::all();
        for ($i = count($days) - 1; $i > 0; $i--) {
            $days[$i]->male_count   = $days[$i - 1]->male_count;
            $days[$i]->female_count = $days[$i - 1]->female_count;
            $days[$i]->save();
        }
        $days[0]->male_count    = 0;
        $days[0]->female_count  = 0;
        $days[0]->save();
    }
}
