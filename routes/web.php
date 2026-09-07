<?php

use App\Http\Controllers\Teams\TeamInvitationController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TravelPlansController;
use App\Http\Controllers\Admin\AuthController;

Route::inertia('/', 'Welcome')->name('home');


Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    });

Route::middleware(['auth'])->group(function () {
    Route::get('invitations/{invitation}/accept', [TeamInvitationController::class, 'accept'])->name('invitations.accept');
});

Route::prefix('admin')->group(function () {

    Route::middleware('guest')->group(function () {

        Route::get('/login', [AuthController::class, 'login'])
            ->name('admin.login');

        Route::post('/login', [AuthController::class, 'authenticate']);
    });

    Route::middleware('auth')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('admin.logout');

        Route::resource('travel-plans', TravelPlansController::class)
            ->names('admin.travel-plans');
    });
});

require __DIR__.'/settings.php';
