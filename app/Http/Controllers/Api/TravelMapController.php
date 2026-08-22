<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TravelLocation;
use App\Services\TravelService;
use Illuminate\Http\Request;

class TravelMapController extends Controller
{
   protected TravelService $travelService;

   public function __construct(TravelService $travelService)
   {
      $this->travelService = $travelService;
   }

   public function getData()
   {
      return TravelLocation::getMapPoints();
   }

   public function getFilterData(Request $request)
   {
      $request->validate(['year'=>['nullable', 'digits:4']]);
      
      $year = $request->query('year');
      $points = $this->travelService->cacheMapPoints($year);
      return response()->json($points);
   }
}
