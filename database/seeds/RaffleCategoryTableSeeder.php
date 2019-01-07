<?php

use Illuminate\Database\Seeder;

class RaffleCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rafflecategories')->insert([
            'category'  => 'Computers',
            'icon'      => 'tech_laptop'
        ]);

        DB::table('rafflecategories')->insert([
            'category'  => 'Phones',
            'icon'      => 'tech_mobile'
        ]);

        DB::table('rafflecategories')->insert([
            'category'  => 'Cars',
            'icon'      => 'transportation_bus-front-12'
        ]);

        DB::table('rafflecategories')->insert([
            'category'  => 'TVs',
            'icon'      => 'tech_tv'
        ]);

        DB::table('rafflecategories')->insert([
            'category'  => 'Clocks',
            'icon'      => 'tech_watch-time'
        ]);
    }
}
