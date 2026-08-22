<?php

namespace Tests\Feature;

use App\Models\TravelPosts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TravelApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_travel_map_return_points(): void
    {
        $modified = '2026-08-20 10:00:00';
        $post = TravelPosts::factory()->create();
        // Создаем множество экземпляров в таблице Laravel
        for ($i = 0; $i <= 3; $i++) {
            TravelPosts::factory()->createMany([
                [
                    'joomla_id' => $i,
                    'title' => "Путешествие в Непал-{$i}",
                    'country' => "Непал-{$i}",
                    'city' => 'Катманду',
                    'coordinates' => '27.714955,85.290351',
                    'joomla_modified' => $modified,
                ],
                [
                    'joomla_id' => $i,
                    'joomla_modified' => $modified,
                ],
                [
                    'joomla_id' => $i,
                    'joomla_modified' => $modified,
                ],
                [
                    'joomla_id' => $i,
                    'joomla_modified' => $modified,
                ],
            ]);
        }
        $response = $this->getJson('api/travel-maps');
        $response->assertStatus(200);
    }
}
