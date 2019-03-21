<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

//    *********************************************************************************✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌✌

//    Social Networks Authentication

    'facebook' => [
        'client_id' => '2089531807735327',
        'client_secret' => 'b55790b08e57117371badaa2084f87df',
        'redirect' => 'http://tiketikes.com/auth/facebook/callback'
    ],
    'twitter' => [
        'client_id' => 'B7oIUInNaskO2Ow4scKo1aNxz',
        'client_secret' => '5rTFTlHuxizw9RqrtRWm89CJUs3SDh7OAYaPWel5D9NUvx6dej ',
        'redirect' => 'http://tiketikes.com/auth/twitter/callback'
    ],

    'google' => [
        'client_id' => 'XXXXXXXXXXX',
        'client_secret' => 'XXXXXXXXXXXXXX',
        'redirect' => 'http://localhost/tiketike/public/auth/google/callback'
    ],

    'linkedin' => [
        'client_id' => 'XXXXXXXXXXX',
        'client_secret' => 'XXXXXXXXXXXXXX',
        'redirect' => 'http://localhost/tiketike/public/auth/linkedin/callback'
    ],

//    Cualquier otra red que quieran agregar lo hacen manteniendo la estructura anterior

//******************************************************************************************👌👌👌👌👌👌👌👌👌👌👌👌👌👌

];


