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
            'category' => 'Computers'
        ]);

        DB::table('rafflecategories')->insert([
            'category' => 'Phones'
        ]);

        DB::table('rafflecategories')->insert([
            'category' => 'Cars'
        ]);

        DB::table('rafflecategories')->insert([
            'category' => 'TVs'
        ]);

        DB::table('rafflecategories')->insert([
            'category' => 'Clocks'
        ]);
    }
}
