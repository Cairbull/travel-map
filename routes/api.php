<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\TravelMapController;

Route::post('/location', [LocationController::class, 'store']);
Route::get('/map-points', [TravelMapController::class,'getData']);
Route::get('/filter-data', [TravelMapController::class,'getFilterData']);
Route::get('/travel-map', function () {
    return view('travel-map');
});
?>