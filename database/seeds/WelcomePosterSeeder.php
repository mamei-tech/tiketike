<?php

use Illuminate\Database\Seeder;

class WelcomePosterSeeder extends Seeder
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
                'title'          => 'Este es el títuto de Bienvenida del sitio',
                'subtitle'       => 'Este es el subtítuto de Bienvenida del sitio',
            ]
        );

    }
}
