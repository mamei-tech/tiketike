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

    public static function activeUsersCountInDay($day) {
        $currentDay = ActiveUsers::find($day);
        return $currentDay->male_count + $currentDay->female_count;
    }

    //Update active users in current day.
    public static function updateActiveUsers() {
        $maleCount      = 0;
        $femaleCount    = 0;
        User::chunk(1000, function ($users) use (&$maleCount, &$femaleCount){
            foreach ($users as $u) {
                if ($u->logged) {
                    if ($u->getProfile->gender == 'male')
                        $maleCount++;
                    else
                        $femaleCount++;
                }
            }
        });
        $loggedUsersCount           = $maleCount + $femaleCount;
        $registeredLoggedUsersCount = ActiveUsers::activeUsersCountInDay(0);
        if ($loggedUsersCount > $registeredLoggedUsersCount)
            ActiveUsers::updateCurrentDay($maleCount, $femaleCount);
    }
}
