<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Ledcontroller;
use App\Service\WhatsappNotificationService;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('layouts.landing');
});

Route::get('/dashboard', function () {
    $data['title'] = 'Dashboard';
    $data['breadcrumbs'][] = [
        'title' => 'Dashboard',
        'url' => route('dashboard')
    ];

    return view('pages.dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/coba', function () {
    return view('pages.coba');
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //users
    Route::get('users', [Usercontroller::class, 'index'])->name('users.index');

    //Leds
    Route::get('leds', [LedController::class, 'index'])->name('leds.index');
    Route::post('leds', [LedController::class, 'store'])->name('leds.store');

    //wa
    // Route::get('/whatsapp', function () {
    //    $target = request('target');
    //   $message = 'Ada kebocoran gas di rumah anda, segera cek dan perbaiki';
    //   $response = WhatsappNotificationService::sendMessage($target, $message);
    //  echo $response;
    // });
});

Route::get('/sensor', function () {
    $data['title'] = 'Sensor';
    $data['breadcrumbs'][] = [
        'title' => 'Sensor',
        'url' => route('sensor')
    ];

    return view('pages.sensor', $data);
})->middleware(['auth', 'verified'])->name('sensor');


require __DIR__ . '/auth.php';
