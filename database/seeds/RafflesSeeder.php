<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Repositories\RaffleRepository;

use App\Raffle;
use App\User;
use App\Http\TkTk\Formula;
use Khsing\World\Models\Country;


class RafflesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moreraffles2create = 0;
        $totalr             = $moreraffles2create + 0;       // There are 5 raffles creation by default written her below so, ...
        $rpostry            = new RaffleRepository();

        //Seeding raffles
        DB::table('raffles')->insert([
                'id'            => \App\Http\TkTk\CodesGenerator::newRaffleId(),
                'owner'         => \App\User::all()->first()->id,
                'category'      => \App\RaffleCategory::where('category', 'Phones')->first()->id,
                'status'        => \App\RaffleStatus::where('status', 'Unpublished')->first()->id,
                'title'         => 'Samsung S8',
                'description'   => 'Samsung S8 nuevo en su caja. No se lo pierda',
                'price'         => 600,
                'location'      => Country::all()->first()->id,
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
                'location'      => Country::all()->first()->id,
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
                'location'      => Country::all()->first()->id,
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
                'location'      => Country::all()->first()->id,
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
                'location'      => Country::all()->first()->id,
            ]
        );

        factory(\App\Raffle::class, $moreraffles2create)->create();

        // Adding images to the raffles
        $imgnum = [1,2,3,4,5,6,7,8,9,10,11,12,13];

        $raffles = Raffle::all();

        foreach ($raffles as $raffle) {

            shuffle($imgnum);shuffle($imgnum);

            $raffle->addMediaFromUrl('http://localhost/pics/common/rsample_'.$imgnum[0].'.jpg')->toMediaCollection('raffles','raffles');
            $raffle->addMediaFromUrl('http://localhost/pics/common/rsample_'.$imgnum[1].'.jpg')->toMediaCollection('raffles','raffles');
            $raffle->addMediaFromUrl('http://localhost/pics/common/rsample_'.$imgnum[2].'.jpg')->toMediaCollection('raffles','raffles');

        }

        // Publishing some raffles
        $someupublished = Raffle::where('status', 1)->take($totalr - $totalr/4)->get();           // Publishing only the 1/3 of the total

        foreach ($someupublished as $raffle) {

            $tcount     = mt_rand(10, $raffle->price / 2);
            $profit     = 20;
            $commision  = 15;
            $transfee   = 10;
            $tprice     = Formula::calcTicketsPrice($raffle->price, $profit, $commision, $tcount, $transfee);

            $raffle->publish($profit, $commision, $tcount, $tprice);
        }

        // Buying Tickets
        $publishedraffles = $rpostry->getPublishedRaffles();                            // Getting all the raffles
        $users = User::all();

        foreach ($users as $user) {                                                     // Getting all users

            if(mt_rand(0,1) == 0) continue;                                             // Passing some of them

            foreach ($publishedraffles as $praffle) {                                   // Iterating over published raffles

                if(mt_rand(0,1) == 0) continue;                                         // Passing some of those

                $tkavailable = $praffle->getTicketsAvailable()->get();                  // Getting available tickets for buying
                $tktotal     = $tkavailable->count();                                   // Getting the total of them
                $buys        = mt_rand(5, 10);                                          // Making a random iterator count

                if ($tktotal < $buys) continue;                                         // If there is not enough available tickets then continue to the next published raffle

                for ($i = 1; $i <= $buys; $i++) {                                       // Doing that 10 times when total is more or equal to 10
                    //if(mt_rand(0,1) == 0) continue;                                   // passing some of the tks

                    $tk = $tkavailable->random();                                       // Getting one tk ramdomly

                    // Directs Buys
                    if (mt_rand(0, 100) >= 35) {
                        if (!$tk->sold && $tk->getRaffle->getOwner->id != $user->id) {  // If the tk is not sold already and the user is not the raffle owner so
                            $praffle->buyTickets($user, [$tk->code]);                   // Buying the tk
                            $praffle->progress = $praffle->getProgress();
                            $praffle->save();
                            $tkavailable = $praffle->getTicketsAvailable()->get();      // Refreshing tickets for buying
                        }
                    }
                    // Referasl Buys
                    else {
                        if (!$tk->sold && $tk->getRaffle->getOwner->id != $user->id) {  // Buying the tk through referal
                            $praffle->buyTickets(
                                $user,
                                [$tk->code],
                                $tk->getRaffle->getOwner->id,
                                mt_rand(0, 3)   //social network: 0 none, 1 facebook, 2 twitter, 3 instagram
                            );
                            $praffle->progress = $praffle->getProgress();
                            $praffle->save();
                            $tkavailable = $praffle->getTicketsAvailable()->get();      // Refreshing tickets for buying
                        }
                    }
                }
            }
        }
    }
}
