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

    'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID','35751495574-sj1i56ungjkgua2pa77ojpbblu8aj4fj.apps.googleusercontent.com'),         // Your GitHub Client ID
    'client_secret' => env('GOOGLE_CLIENT_SECRET','TIAi0uowum2qPG7nK6zo2Q-_'), // Your GitHub Client Secret
    'redirect' => 'http://localhost/PlanDeAccion/public/login/google/callback',
    ],

];
