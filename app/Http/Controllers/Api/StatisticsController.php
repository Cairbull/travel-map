<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StatisticsServices;

class StatisticsController extends Controller
{

    public function __construct(private StatisticsServices $statisticsServices)
    {
    //    
    }

    public function index(Request $request)
    {
       $year = $request->query('year');

       return response()->json(
        $this->statisticsServices->getStatistics( $year ? (int) $year : null)
       );
    }
}
