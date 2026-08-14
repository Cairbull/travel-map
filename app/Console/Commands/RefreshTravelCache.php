<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TravelLocation;
use Illuminate\Support\Facades\Cache;

class RefreshTravelCache extends Command
{
    protected $signature = 'travel:refresh';
    protected $description = 'Refresh travel points';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Cache all points
        $points = TravelLocation::getFilterData(null);
        Cache::put(
            'map-points-all',
            $points,
            now()->addDay()
        );
        //Cache points with unique year
        $years = $points
            ->pluck('publish_up')
            ->map(fn($date) => date('Y', strtotime($date)))
            ->unique();
        foreach ($years as $year) {
            $points = TravelLocation::getFilterData($year);
            Cache::put(
                'map-points-year' . $year,
                $points,
                now()->addDay()
            );
            $this->info("Cache refreshed: {$year}");
        }
        return Command::SUCCESS;
    }
}
