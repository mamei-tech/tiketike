<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RaffleCategoryTableSeeder::class,       //rafflecategories
            RafflestatusTableSeeder::class,         //rafflestatus
            UsersTableSeeder::class,                //User
            RafflesSeeder::class,                   //raffles
            PromoSeeder::class,                     //Promo & Ads and also Promo Clients
            ConfigsSeeder::class,                   //configs
            PermissionsTableSeeder::class,
        ]);
    }
}