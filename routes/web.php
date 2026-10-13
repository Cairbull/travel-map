<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TravelPlansController;
use App\Http\Controllers\Admin\AuthController;

// Route::inertia('/', 'Welcome')->name('home');


Route::prefix('admin')->group(function () {

    Route::middleware('guest')->group(function () {

        Route::get('/login', [AuthController::class, 'login'])
            ->name('login');

        Route::post('/login', [AuthController::class, 'authenticate'])->name('admin.login.authenticate');
    });

    Route::middleware('auth')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('admin.logout');

        Route::resource('travel-plans', TravelPlansController::class)
            ->names('admin.travel-plans');
    });
});

