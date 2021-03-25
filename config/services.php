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

    'facebook' => [
        'client_id' => '282732098924494',
        'client_secret' => 'c481472e2a2f1988bbe0b8494cf7ebd6',
        'redirect' => 'http://localhost:8000/callback/facebook',
    ],

    'google' => [
        'client_id' => '446448185722-2hn2072i3gdbfsqt0rjl9tsikolru2nc.apps.googleusercontent.com',
        'client_secret' => 'iP_s1B429LDmeWmX22F34OUh',
        'redirect' => 'http://localhost:8000/callback/google',
    ],
];
