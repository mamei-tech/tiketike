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
        'client_id' => '464238204247375',
        'client_secret' => '34b2793c71bf74f201c04157448ce351',
        'redirect' => env('APP_URL').'/auth/facebook/callback'
    ],
    'twitter' => [
        'client_id' => 'B7oIUInNaskO2Ow4scKo1aNxz',
        'client_secret' => '5rTFTlHuxizw9RqrtRWm89CJUs3SDh7OAYaPWel5D9NUvx6dej ',
        'redirect' => env('APP_URL').'/auth/twitter/callback'
    ],

    'google' => [
        'client_id' => '289859094179-9bcb9c4l5t1v2oaaje1g4qqo03h6l268.apps.googleusercontent.com',
        'client_secret' => 'xGquq2_KYVz0QkQQg4j1RLRB',
        'redirect' => env('APP_URL').'/auth/google/callback'
    ],

//    Cualquier otra red que quieran agregar lo hacen manteniendo la estructura anterior

//******************************************************************************************👌👌👌👌👌👌👌👌👌👌👌👌👌👌

];


