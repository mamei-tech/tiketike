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
            'icon'      => 'ti-desktop'
        ]);

        DB::table('rafflecategories')->insert([
            'category'  => 'Phones',
            'icon'      => 'ti-mobile'
        ]);

        DB::table('rafflecategories')->insert([
            'category'  => 'Cars',
            'icon'      => 'ti-car'
        ]);

        DB::table('rafflecategories')->insert([
            'category'  => 'TVs',
            'icon'      => 'ti-blackboard'
        ]);

        DB::table('rafflecategories')->insert([
            'category'  => 'Clocks',
            'icon'      => 'ti-time'
        ]);
    }
}
