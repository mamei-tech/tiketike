<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActiveUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    const daysCount = 30; //Days count to keep track of active users

    public function run()
    {
        for ($i = 0; $i < ActiveUsersTableSeeder::daysCount; $i++)
            DB::table('activeusers')->insert([
                'id'            => $i,
                'male_count'    => 0,
                'female_count'  => 0,
            ]);
    }
}
