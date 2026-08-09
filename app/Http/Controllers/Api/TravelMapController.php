<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\TravelLocation;
use Illuminate\Http\Request;

class TravelMapController extends Controller
{
   public function getData()
   {
      return TravelLocation::getMapPoints();
   }

   public function getFilterData(Request $request)
   {
       $year = $request->query('year');
      return TravelLocation::getFilterData($year);
   }
}
