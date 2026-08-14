<?php

namespace App\Services;

use App\Models\TravelLocation;
use Illuminate\Support\Facades\Cache;

class TravelService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function cacheMapPoints(?string $year = null)
    {
        $cacheKey = $year
            ? 'map-points-year-' . $year
            : 'map-points-all';
        $points = Cache::remember(
            $cacheKey,
            now()->addDay(),
            function () use ($year) {
                return TravelLocation::getFilterData($year)->toArray();
            }
        );

        return $points;
    }

    public function forgetYearCache(?string $year = null)
    {
        if ($year) {
            Cache::forget('map-points-year-' . $year);
        } else {
            Cache::forget('map-points-all');
        }
    }
}
