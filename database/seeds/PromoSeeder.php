<?php

use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Promo Seeder
        DB::table('promoclients')->insert([
                'name'          => 'Lezcano',
                'contact'       => serialize(['+5355555555', '+5378881122']),
                'email'         => 'info@lezcano.com',
            ]
        );
        DB::table('promoclients')->insert([
                'name'      => 'King\'s Bar',
                'contact'      => serialize(['+5355555555', '+5378881122']),
                'email'    => 'info@kingsbar.com',
            ]
        );
        DB::table('promoclients')->insert([
                'name'      => 'Mamei',
                'contact'      => serialize(['+5355555555', '+5378881122']),
                'email'    => 'info@mamei.com',
            ]
        );

        // Promo Seeder
        DB::table('promos')->insert([
                'name'          => 'Lezcano 01',
                'type'          => 1,
                'status'        => 0,
                'expdate'       => date(            // 1 Month Ahedad of today
                    'Y-m-d',
                    mktime(
                        0, 0, 0,
                        date("m")+1  , date("d"), date("Y")

                    )),
                'image'         => 'tample.jpg',
                'client'        => 1,
                'alternative'   => 'This image is very sxtrange',
                'website'       => 'http://www.lezcano.com'
            ]
        );

        $lezcano = DB::table('promos')->insertGetId([
                'name'          => 'Lezcano 02',
                'type'          => 0,
                'status'        => 1,
                'expdate'       => date(            // 1 Month Ahedad of today
                    'Y-m-d',
                    mktime(
                        0, 0, 0,
                        date("m")+1  , date("d"), date("Y")
                    )),
                'image'         => 'kample.jpg',
                'client'        => 1,
                'alternative'   => 'This image is very good',
                'website'       => 'http://www.lezcano.com'
            ]
        );

        \App\Promo::find($lezcano)->addMediaFromUrl('http://localhost/pics/front/slide1.jpg')->toMediaCollection('promos','promos');

        DB::table('promos')->insert([
                'name'          => 'Girls Pics',
                'type'          => 0,
                'status'        => 0,
                'expdate'       => date(            // 1 Month Ahedad of today
                    'Y-m-d',
                    mktime(
                        0, 0, 0,
                        date("m")+1  , date("d"), date("Y")
                    )),
                'client'        => 2,
                'image'         => 'nample.jpg',
                'alternative'   => 'This image is very awesome',
                'website'       => 'http://www.kingsbar.com'
            ]
        );

        DB::table('promos')->insert([
                'name'          => 'Mamei Promo',
                'type'          => 1,
                'status'        => 1,
                'expdate'       => date(            // 1 Month Ahedad of today
                    'Y-m-d',
                    mktime(
                        0, 0, 0,
                        date("m")+1  , date("d"), date("Y")
                    )),
                'client'        => 3,
                'image'         => 'oample.jpg',
                'alternative'   => 'This image is very wonderfull',
                'website'       => 'http://www.mamaei.com'
            ]
        );

        // Main
        $promoa = \App\Promo::find(2);
        $promob = \App\Promo::find(3);

        $promoa->addMediaFromUrl('http://localhost/pics/common/psample_1.jpg')->toMediaCollection('promos', 'promos');
        $promob->addMediaFromUrl('http://localhost/pics/common/psample_2.jpg')->toMediaCollection('promos', 'promos');


        // Sec
        $promoc = \App\Promo::find(1);
        $promod = \App\Promo::find(4);

        $promoc->addMediaFromUrl('http://localhost/pics/common/psample_3.jpg')->toMediaCollection('promos', 'promos');
        $promod->addMediaFromUrl('http://localhost/pics/common/psample_4.jpg')->toMediaCollection('promos', 'promos');
    }
}
