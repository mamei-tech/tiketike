<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeding custom user
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

        //Seeding custom users's profile
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

        //Seeding other users & usersprofiles
        (new Faker\Generator)->seed(123);

        factory(\App\User::class, 30)->create();
        factory(\App\UserProfile::class, 30)->create();

        $users = \App\User::all();
        $values = [0 => 'user', 1=> 'user2'];
        foreach ($users as $user)
        {
            $img = rand(0,1);
            $user->addMediaFromUrl('http://www.tiketikes.site/pics/front/'.$values[$img].'.jpg')->toMediaCollection('avatars','avatars');

            $anotherusersset = \App\User::inRandomOrder()->take(5)->get();

            foreach ($anotherusersset as $anotheruser)
            {
                if($user->id == $anotheruser->id) continue;

                DB::table('user_follow')->insert([
                        'follow_id'     => $user->id,
                        'follower_id'  => $anotheruser->id,
                    ]
                );
            }
        }
    }
}
