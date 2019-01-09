<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

use App\Raffle;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $faker      = Factory::create();

        $raffles    = Raffle::all();

        // Seeding root comments by interatin in to all raffles list
        foreach ($raffles as $raffle) {

            $rootcmts   = mt_rand(5, 10);                                   //  Getting root comments

            for ($i = 1; $i <= $rootcmts; $i++) {
                DB::table('comments')->insert([
                    'user'          => $faker->numberBetween(1, 32),
                    'raffle'        => $raffle->id,
                    'text'          => $faker->text(225),
                    'created_at'    => date('Y-m-d H:i:s'),
                ]);
            }
        }

        // Seeding childs comments
        foreach ($raffles as $raffle) {

            $cmnts = $raffle->getComments()->get();

            foreach ($cmnts as $cmnt) {

                if (mt_rand(0, 1) == 1) continue;                   // Pasing some commnents

                $childcmnts   = mt_rand(1, 3);                      // Generating number of child comments
                $parent       = $cmnts->random();                   // Getting a random parent comment

                for ($i = 1; $i <= $childcmnts; $i++) {

                    DB::table('comments')->insert([
                        'user' => $faker->numberBetween(1, 32),
                        'raffle' => $raffle->id,
                        'text' => $faker->text(225),
                        'parent' => $parent->id,
                        'created_at'    => date('Y-m-d H:i:s'),
                    ]);
                }
            }
        }
    }
}
