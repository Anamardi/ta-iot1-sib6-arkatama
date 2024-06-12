<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Ledcontroller;
use App\Http\Controllers\Api\MqSensorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// // CRUD
// Route::get('/users', [UserController::class, 'index']);
// Route::get('/users/{id}', [UserController::class, 'show']);
// Route::post('/users', [UserController::class, 'store']);
// Route::put('/users/{id}', [UserController::class, 'update']);
// Route::delete('/users/{id}', [UserController::class, 'destroy']);

// route group name api
Route::group(['as' => 'api.'], function () {
    // resource route
    Route::resource('users', UserController::class)
        ->except(['create', 'edit']);

    Route::resource('sensors/mq', MqSensorController::class)
        ->names('sensors.mq');
});



Route::prefix('/leds')->name('leds.')->group(function () {
    Route::get('/', [LedController::class, 'index'])
        -> name ('index');
    Route::get('/{id}', [LedController::class, 'show'])
        -> name ('show');
    Route::post('/', [LedController::class, 'store'])
        -> name ('store');
    Route::put('/{id}', [LedController::class, 'update'])
        -> name ('update');
    Route::delete('/{id}', [LedController::class, 'destroy'])
        -> name ('destroy');
    });
