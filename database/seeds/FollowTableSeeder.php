<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Raffle;
use App\User;

class FollowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $raffles    = Raffle::all();
        $users      = User::all();

        // Seeding root comments by interatin in to all raffles list
        foreach ($raffles as $raffle) {

            foreach ($users as $user) {

                if (mt_rand(0, 100) >= 35 ) continue;                   // Pasing some user

                DB::table('follow')->insert([
                    'user_id'       => $user->id,
                    'raffle_id'     => $raffle->id,
                ]);
            }
        }
    }
}
