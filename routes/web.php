<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.landing');
});

Route::get('/dashboard', function () {
    $data ['title'] = 'Dashboard';
    $data ['breadcrumbs'][]= [
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
});

require __DIR__.'/auth.php';
