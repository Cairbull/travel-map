<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TravelPlans;

class PlansController extends Controller
{
    public function index()
    {
        return response()->json(
            TravelPlans::query()
                ->orderBy('start_date')
                ->get()
        );
    }
}
