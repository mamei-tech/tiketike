<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Raffle;
use App\User;
use App\Http\TkTk\Formula;


class RafflesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moreraffles2create = 55;
        $totalr             = $moreraffles2create + 5;       // There are 5 raffles creation by default written her below so, ...

        //Seeding raffles
        DB::table('raffles')->insert([
                'id'            => \App\Http\TkTk\CodesGenerator::newRaffleId(),
                'owner'         => \App\User::all()->first()->id,
                'category'      => \App\RaffleCategory::where('category', 'Phones')->first()->id,
                'status'        => \App\RaffleStatus::where('status', 'Unpublished')->first()->id,
                'title'         => 'Samsung S8',
                'description'   => 'Samsung S8 nuevo en su caja. No se lo pierda',
                'price'         => 600,
                'location'      => \App\Country::all()->first()->id,
            ]
        );

        DB::table('raffles')->insert([
                'id'            => \App\Http\TkTk\CodesGenerator::newRaffleId(),
                'owner'         => \App\User::all()->first()->id,
                'category'      => \App\RaffleCategory::where('category', 'Computers')->first()->id,
                'status'        => \App\RaffleStatus::where('status', 'Unpublished')->first()->id,
                'title'         => 'Laptop Dell',
                'description'   => 'Dell core i7 7ma, 16GB ram, 2TB HDD, pantalla 17"',
                'price'         => 700,
                'location'      => \App\Country::all()->first()->id,
            ]
        );

        DB::table('raffles')->insert([
                'id'            => \App\Http\TkTk\CodesGenerator::newRaffleId(),
                'owner'         => \App\User::all()->first()->id,
                'category'      => \App\RaffleCategory::where('category', 'Computers')->first()->id,
                'status'        => \App\RaffleStatus::where('status', 'Unpublished')->first()->id,
                'title'         => 'PC de escritorio',
                'description'   => 'Core i3 de 4ta, chasis negro, 1TB HDD, 4GB ram, monitor led de 24"',
                'price'         => 500,
                'location'      => \App\Country::all()->first()->id,
            ]
        );

        DB::table('raffles')->insert([
                'id'            => \App\Http\TkTk\CodesGenerator::newRaffleId(),
                'owner'         => \App\User::all()->first()->id,
                'category'      => \App\RaffleCategory::where('category', 'TVs')->first()->id,
                'status'        => \App\RaffleStatus::where('status', 'Unpublished')->first()->id,
                'title'         => 'Konka de 32"',
                'description'   => 'Nuevo TV Konka de 32" en su caja. No se lo pierda',
                'price'         => 220,
                'location'      => \App\Country::all()->first()->id,
            ]
        );

        DB::table('raffles')->insert([
                'id'            => \App\Http\TkTk\CodesGenerator::newRaffleId(),
                'owner'         => \App\User::all()->first()->id,
                'category'      => \App\RaffleCategory::where('category', 'TVs')->first()->id,
                'status'        => \App\RaffleStatus::where('status', 'Unpublished')->first()->id,
                'title'         => 'Atec-Panda',
                'description'   => 'TV panda como nuevo, esta muy bien cuidado, mando nuevo',
                'price'         => 100,
                'location'      => \App\Country::all()->first()->id,
            ]
        );

        factory(\App\Raffle::class, $moreraffles2create)->create();

        // Adding images to the raffles
        $imgnum = [1,2,3];

        $raffles = Raffle::all();

        foreach ($raffles as $raffle) {

            shuffle($imgnum);

            $raffle->addMediaFromUrl('http://localhost/pics/common/'.$imgnum[0].'.jpg')->toMediaCollection('raffles','raffles');
            $raffle->addMediaFromUrl('http://localhost/pics/common/'.$imgnum[1].'.jpg')->toMediaCollection('raffles','raffles');
            $raffle->addMediaFromUrl('http://localhost/pics/common/'.$imgnum[2].'.jpg')->toMediaCollection('raffles','raffles');
        }

        // Publishing some raffles
        $someupublished = Raffle::where('status', 1)->take($totalr - $totalr/4)->get();           // Publishing only the 1/3 of the total

        foreach ($someupublished as $raffle) {

            $tcount     = mt_rand(20, $raffle->price / 2);
            $profit     = 20;
            $commision  = 15;
            $transfee   = 10;
            $tprice     = Formula::calcTicketsPrice($raffle->price, $profit, $commision, $tcount, $transfee);

            $raffle->publish($profit, $commision, $tcount, $tprice);
        }

        // Buying Tickets
        $users = User::all();

        // Making directs buys
        foreach ($users as $user) {

            if(mt_rand(0,1) == 0) continue;

            $publishedraffles = Raffle::getPublishedRaffles();

            // TODO Working here



        }
    }
}
