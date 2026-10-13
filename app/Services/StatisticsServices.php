<?php

namespace App\Services;

use App\Models\TravelLocation;

class StatisticsServices
{

/* Метод получения статистических данных по параметрам: страны, города, места и года */

    public function getStatistics(?int $year = null): array
    {
        $query = TravelLocation::query();

        if ($year) {
            $query->whereYear('publish_up', $year);
        }

        $locations = $query->get();

        return [
            'countries' => $locations
                ->whereNotNull('country')
                ->pluck('country')
                ->unique()
                ->count(),

            'cities' => $locations
                ->whereNotNull('city')
                ->pluck('city')
                ->unique()
                ->count(),

            'locations' => $locations->count(),

            'years' => $locations
                ->filter(fn($location) => $location->publish_up)
                ->map(fn($location) => $location->publish_up->year)
                ->unique()
                ->count(),

        ];
    }
}
