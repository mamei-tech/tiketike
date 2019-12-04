<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WelcomePosterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Promo Seeder
        DB::table('welcome_poster')->insert([
                'id'             => 1,
                'title'          => 'Este es el títuto de Bienvenida del sitio',
                'subtitle'       => 'Este es el subtítuto de Bienvenida del sitio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

    }
}
