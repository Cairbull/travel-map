<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TravelLocation;
use App\Http\Resources\TravelLocationResource;

class TripsController extends Controller
{
    public function index(){
        
    $trips = TravelLocation::query()
    ->latest('publish_up')
    ->take(6)
    ->get();

    return TravelLocationResource::collection($trips);
    }
}
