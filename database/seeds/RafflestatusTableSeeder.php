<?php

use Illuminate\Database\Seeder;

class RafflestatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rafflestatus')->insert([
            'status' => 'Unpublished',                  //not available for the public
        ]);
        DB::table('rafflestatus')->insert([
            'status' => 'Published',                    //available for the public
        ]);
        DB::table('rafflestatus')->insert([
            'status' => 'Cancelled',                    //cancelled for any reason by admins (anulled)
        ]);
        DB::table('rafflestatus')->insert([
            'status' => 'Sold',                         //all tikets has ben sold
        ]);
        DB::table('rafflestatus')->insert([
            'status' => 'Shuffled',                     //the random algorithm find a winner
        ]);
        DB::table('rafflestatus')->insert([
            'status' => 'Confirmed',                    //winner and owner has cofirm, raffle is terminated
        ]);
    }
}
