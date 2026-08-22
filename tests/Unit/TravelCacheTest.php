<?php

namespace Tests\Unit;

use App\Models\TravelPosts;
use App\Services\TravelService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class TravelCacheTest extends TestCase
{
    use RefreshDatabase;

    private $post;
    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();

        $this->post = TravelPosts::factory()->create();
        $this->service = new TravelService;
    }

    /* Тестирование метода кэширования всех точек на карте */
    public function test_cached_all_map_points(): void
    {
        TravelPosts::factory()->create([
            'title' => 'Пост про Непал',
            'country' => $this->post->country,
            'city' => $this->post->city,
            'coordinates' => $this->post->coordinates,
            'publish_up' => '2026-05-25 07:18:21',
        ]);

        $this->service->cacheMapPoints();

        $this->assertTrue(
            Cache::has('map-points-all')
        );
    }
    /* Тестирование метода кэширования точки привязанной к конкретному году */
    public function test_cached_year_map_points(): void
    {
        TravelPosts::factory()->create([
            'title' => 'Пост про Непал',
            'country' => $this->post->country,
            'city' => $this->post->city,
            'coordinates' => $this->post->coordinates,
            'publish_up' => '2026-05-25 07:18:21',
        ]);

        $this->service->cacheMapPoints('2026');

        $this->assertTrue(
            Cache::has('map-points-year-2026')
        );
    }
    /* Тестирование метода очистки кэша */
    public function test_cache_year_can_be_forgotten(): void
    {
        TravelPosts::factory()->create([
            'publish_up' => '2026-05-25 07:18:21',
        ]);

        $this->service->cacheMapPoints('2026');

        $this->assertTrue(
            Cache::has('map-points-year-2026')
        );

        $this->service->forgetYearCache('2026');

        $this->assertFalse(
            Cache::has('map-points-year-2026')
        );
    }
    /* Тестирование метода памяти кэша и последующей загрузки из него */
    public function test_cached_return_data_without_database_query(): void
    {
        Cache::forget('map-points-all');

        $this->post = TravelPosts::factory()->create();
        TravelPosts::factory()->create([
            'title' => 'Пост про Непал',
            'country' => $this->post->country,
            'city' => $this->post->city,
            'coordinates' => $this->post->coordinates,
            'publish_up' => '2026-05-25 07:18:21',
        ]);

        $firstQuery = $this->service->cacheMapPoints();

        TravelPosts::query()->delete();

        $secondQuery = $this->service->cacheMapPoints();
        $this->assertSame($firstQuery, $secondQuery);
    }
    /* Тестирование метода вывода все данных о метках без параметра года */
    public function test_filter_data_without_year_returns_all_points(): void
    {
        TravelPosts::factory()->createMany([
            [
                'title' => 'Пост про Непал в 2026 году',
                'publish_up' => '2026-05-25 07:18:21',
            ],
            [
                'title' => 'Пост про Непал в 2025 году',
                'publish_up' => '2025-03-10 10:00:00',
            ],
        ]);

        $response = $this->getJson('/api/filter-data');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'title' => 'Пост про Непал в 2026 году',
        ]);

        $response->assertJsonFragment([
            'title' => 'Пост про Непал в 2025 году',
        ]);
    }
    /* Тестирование валидации параметра года если в нем передавать литеры */
    public function test_filter_data_rejects_invalid_year(): void
    {
        $response = $this->getJson('/api/filter-data?year=abc');

        $response->assertStatus(422);
    }
    /* Тестирование валидации параметра года если в нем передавать числовые значения */
    public function test_filter_data_rejects_year_with_wrong_length(): void
    {
        $response = $this->getJson('/api/filter-data?year=26');

        $response->assertStatus(422);
    }
}
