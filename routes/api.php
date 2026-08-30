<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\TravelMapController;
use App\Http\Controllers\Api\StatisticsController;
use App\Http\Controllers\Api\TripsController;

// use App\Http\Controllers\Api\StoreTravelController;
// use App\Http\Controllers\Api\UpdateTravelController;

Route::post('/location', [LocationController::class, 'store']);
Route::get('/map-points', [TravelMapController::class,'getData']);
Route::get('/filter-data', [TravelMapController::class,'getFilterData']);
Route::get('/statistics', [StatisticsController::class,'index']);
Route::get('/trips', [TripsController::class, 'index']);
// Route::put('/trips/{travel}', [UpdateTravelController::class, 'update']);

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/travel-map', function () {
    return view('travel-map');
});
?>