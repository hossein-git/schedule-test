<?php

use Illuminate\Support\Facades\Route;


Route::post('/login',
    'SampleAuthController@login')
    ->middleware(config('sample_login.throttler_middleware'));
