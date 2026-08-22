<?php

namespace Tests\Feature;

use App\Models\TravelPosts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TravelApiTest extends TestCase
{
    use RefreshDatabase;

    private $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post = TravelPosts::factory()->create();
    }

    /* Тестирование метода вывода всех точек на карте */
    public function test_travel_map_return_all_points(): void
    {
        TravelPosts::factory()->createMany([
            [
                'joomla_id' => 100,
                'title' => 'Пост про Непал',
                'country' => $this->post->country,
                'city' => $this->post->city,
                'coordinates' => $this->post->coordinates,
                'publish_up' => '2026-05-25 07:18:21',
            ],
            [
                'joomla_id' => 200,
                'title' => 'Пост про Вьетнам',
                'country' => $this->post->country,
                'city' => $this->post->city,
                'coordinates' => $this->post->coordinates,
                'publish_up' => '2025-03-10 10:00:00',
            ],

        ]);

        $response = $this->getJson('/api/map-points');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'title' => 'Пост про Непал',
        ]);

        $response->assertJsonFragment([
            'title' => 'Пост про Вьетнам',
        ]);
    }

    /* Тестирование метода фильтра постов по годам */
    public function test_travel_map_filter_years(): void
    {
        TravelPosts::factory()->createMany([
            [
                'joomla_id' => 100,
                'title' => 'Пост про Непал 2026',
                'country' => $this->post->country,
                'city' => $this->post->city,
                'coordinates' => $this->post->coordinates,
                'publish_up' => '2026-05-25 07:18:21',
            ],
            [
                'joomla_id' => 200,
                'title' => 'Пост про Вьетнам 2026',
                'country' => $this->post->country,
                'city' => $this->post->city,
                'coordinates' => $this->post->coordinates,
                'publish_up' => '2026-08-10 10:00:00',
            ],
            [
                'joomla_id' => 300,
                'title' => 'Пост про Францию 2025',
                'country' => $this->post->country,
                'city' => $this->post->city,
                'coordinates' => $this->post->coordinates,
                'publish_up' => '2025-03-10 10:00:00',
            ],

        ]);

        $response = $this->getJson('/api/filter-data?year=2026');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'title' => 'Пост про Непал 2026',
        ]);

        $response->assertJsonFragment([
            'title' => 'Пост про Вьетнам 2026',
        ]);

        $response->assertJsonMissing([
            'title' => 'Пост про Францию 2025',
        ]);
    }

    /* Тестирование метода фильтра на отсутствующий год */
    public function test_travel_map_missing_year(): void
    {
        TravelPosts::factory()->createMany([
            [
                'joomla_id' => 100,
                'title' => 'Пост про Непал 2026',
                'country' => $this->post->country,
                'city' => $this->post->city,
                'coordinates' => $this->post->coordinates,
                'publish_up' => '2026-05-25 07:18:21',
            ],
            [
                'joomla_id' => 200,
                'title' => 'Пост про Вьетнам 2026',
                'country' => $this->post->country,
                'city' => $this->post->city,
                'coordinates' => $this->post->coordinates,
                'publish_up' => '2026-08-10 10:00:00',
            ],
            [
                'joomla_id' => 300,
                'title' => 'Пост про Францию 2025',
                'country' => $this->post->country,
                'city' => $this->post->city,
                'coordinates' => $this->post->coordinates,
                'publish_up' => '2025-03-10 10:00:00',
            ],

        ]);

        $response = $this->getJson('/api/filter-data?year=2030');

        $response->assertStatus(200);
        $response->assertJsonCount(0);
    }
}
