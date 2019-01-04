<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RafflesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeding raffles
        DB::table('raffles')->insert([
                'id' => \App\Http\TkTk\CodesGenerator::newRaffleId(),
                'owner' => \App\User::all()->first()->id,
                'category' => \App\RaffleCategory::where('category', 'Phones')->first()->id,
                'status' => \App\RaffleStatus::where('status', 'Unpublished')->first()->id,
                'title' => 'Samsung S8',
                'description' => 'Samsung S8 nuevo en su caja. No se lo pierda',
                'price' => 600,
                'location' => \App\Country::all()->first()->id,
            ]
        );

        DB::table('raffles')->insert([
                'id' => \App\Http\TkTk\CodesGenerator::newRaffleId(),
                'owner' => \App\User::all()->first()->id,
                'category' => \App\RaffleCategory::where('category', 'Computers')->first()->id,
                'status' => \App\RaffleStatus::where('status', 'Unpublished')->first()->id,
                'title' => 'Laptop Dell',
                'description' => 'Dell core i7 7ma, 16GB ram, 2TB HDD, pantalla 17"',
                'price' => 700,
                'location' => \App\Country::all()->first()->id,
            ]
        );

        DB::table('raffles')->insert([
                'id' => \App\Http\TkTk\CodesGenerator::newRaffleId(),
                'owner' => \App\User::all()->first()->id,
                'category' => \App\RaffleCategory::where('category', 'Computers')->first()->id,
                'status' => \App\RaffleStatus::where('status', 'Unpublished')->first()->id,
                'title' => 'PC de escritorio',
                'description' => 'Core i3 de 4ta, chasis negro, 1TB HDD, 4GB ram, monitor led de 24"',
                'price' => 500,
                'location' => \App\Country::all()->first()->id,
            ]
        );

        DB::table('raffles')->insert([
                'id' => \App\Http\TkTk\CodesGenerator::newRaffleId(),
                'owner' => \App\User::all()->first()->id,
                'category' => \App\RaffleCategory::where('category', 'TVs')->first()->id,
                'status' => \App\RaffleStatus::where('status', 'Unpublished')->first()->id,
                'title' => 'Konka de 32"',
                'description' => 'Nuevo TV Konka de 32" en su caja. No se lo pierda',
                'price' => 220,
                'location' => \App\Country::all()->first()->id,
            ]
        );

        DB::table('raffles')->insert([
                'id' => \App\Http\TkTk\CodesGenerator::newRaffleId(),
                'owner' => \App\User::all()->first()->id,
                'category' => \App\RaffleCategory::where('category', 'TVs')->first()->id,
                'status' => \App\RaffleStatus::where('status', 'Unpublished')->first()->id,
                'title' => 'Atec-Panda',
                'description' => 'TV panda como nuevo, esta muy bien cuidado, mando nuevo',
                'price' => 100,
                'location' => \App\Country::all()->first()->id,
            ]
        );
    }
}
