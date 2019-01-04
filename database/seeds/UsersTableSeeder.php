<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeding users
        DB::table('users')->insert([
            'name' => 'Administrator',
            'lastname' => 'Admin Last Name',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin00'),

            'created_at' => date('Y-m-d H:i:s'),

        ]);

        DB::table('users')->insert([
            'name' => 'Webmaster',
            'lastname' => 'Webmaster Last Name',
            'email' => 'webmaster@test.com',

            'password' => bcrypt('master00'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        //Seeding countries
        DB::table('countries')->insert([
            'name' => 'Cuba',
        ]);

        DB::table('countries')->insert([
            'name' => 'Colombia',
        ]);

        //Seeding cities
        DB::table('cities')->insert([
            'name' => 'La Havana',
            'country' => 1,
        ]);

        DB::table('cities')->insert([
            'name' => 'Matanzas',
            'country' => 1,
        ]);

        DB::table('cities')->insert([
            'name' => 'La Paz',
            'country' => 2,
        ]);

        DB::table('cities')->insert([
            'name' => 'Medellin',
            'country' => 2,
        ]);

        //Seeding users's profile
        DB::table('usersprofiles')->insert([
            'username' => 'admin',
            'birthdate' => date('Y-m-d', strtotime('1989-11-06')),
            'gender' => 'Male',
            'langcode' => 'en',
            'avatarname' => 'default',
            'user' => '1',
            'city' => '1',
            'addrss' => 'The addrss goes here',
            'phone' => '',
            'zipcode' => 10100,
            'bio' => 'The bio goes here, add a field for this and set a word word limits for keeps the right look in this yea already',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('usersprofiles')->insert([
            'username' => 'webmaster',
            'birthdate' => date('Y-m-d', strtotime('1989-11-06')),
            'gender' => 'Female',
            'langcode' => 'es',
            'avatarname' => 'default',
            'user' => '2',
            'city' => '4',
            'addrss' => 'The addrss goes here',
            'phone' => '',
            'zipcode' => 10100,
            'bio' => 'The bio goes here, add a field for this and set a word word limits for keeps the right look in this yea already',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
