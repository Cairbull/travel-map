<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TravelPosts;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class JourneysController extends Controller
{
    public function index(): JsonResponse
    {
        $journeys = TravelPosts::query()
            ->whereNotNull('group_stories')
            ->get()
            ->groupBy('group_stories')
            ->map(function ($stories) {
                $first = $stories->first();
                return [
                    'group_stories' => $first->group_stories,
                    'slug' => Str::slug($first->group_stories),
                    'country' => $first->country,
                    'preview_image_journey' => $first->preview_image_journey,
                    'flag_country' => $first->flag_country,
                    'year' => $first->publish_up?->year,
                    'stories_count' => $stories->count(),
                ];
            })
            ->values();

            return response()->json($journeys);
    }
}
