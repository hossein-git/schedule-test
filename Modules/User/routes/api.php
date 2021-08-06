<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

//TODO add middleware
Route::group(
    [
        'prefix' => 'schedules',
        'where' => ['id' => '[0-9]+'],
    ],
    function () {

        Route::get('/', [UserController::class, 'dashboard']);

        Route::group(
            [
                'middleware' => 'auth:api',
            ],
            function () {
                Route::get('/user', [UserController::class, 'index']);
                Route::post('/user', [UserController::class, 'createSchedule']);

                Route::get('/admin', [UserController::class, 'mangerIndex']);
                Route::put('/admin/{id}', [UserController::class, 'changeScheduleStatus']);
            }
        );
    }
);
