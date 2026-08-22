<?php

namespace Tests\Feature;

use App\Models\TravelPosts;
use App\Services\TravelSyncService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/* $post - таблица Laravel
$postJoomla - таблица Joomla
*/

class TravelSyncTest extends TestCase
{
    use RefreshDatabase;

    /* Динамическое создание данных в таблице Joomla */
    private function joomlaPost(int $id, string $title, string $alias, string $introtext, string $country, string $city, string $coordinates, string $modified = '2026-08-20 10:00:00'): object
    {
        return (object) [
            'id' => $id,
            'title' => "{$title}-{$id}",
            'alias' => "{$alias}-{$id}",
            'introtext' => $introtext,
            'publish_up' => '2026-08-20 10:00:00',
            'images' => null,
            'country' => $country,
            'city' => $city,
            'coordinates' => $coordinates,
            'modified' => $modified,
        ];

    }
    

    /* Метод синхронизации таблиц */
    private function syncTable(object $postsJoomla)
    {
        $service = new TravelSyncService;
        $result = $service->sync($postsJoomla);
        return $result;
    }

    /* Тестирование на создание новой строки в таблице */
    public function test_sync_creates_new_post(): void
    {
        $postsJoomla = collect([
            (object)[
                'id' => 100,
                'title' => 'Тестовый пост',
                'alias' => 'test-post',
                'introtext' => 'Текст тестового поста',
                'publish_up' => '2026-08-17 10:00:00',
                'images' => null,
                'country' => 'Непал',
                'city' => 'Катманду',
                'coordinates' => '27.714955,85.290351',
                'modified' => '2026-08-17 10:00:00',
            ],
        ]);

        $service = new TravelSyncService;
        $service->sync($postsJoomla);
        $this->assertDatabaseHas('travel_posts', [
            'joomla_id' => 100,
            'title' => 'Тестовый пост',
            'country' => 'Непал',
            'city' => 'Катманду',
            'coordinates' => '27.714955,85.290351',
            'joomla_modified' => '2026-08-17 10:00:00',
        ]);

        $this->assertDatabaseCount('travel_posts', 1);
    }

    /* Тестирование на обновление данных после синхронизации если они были изменены */
    public function test_sync_update_post(): void
    {
        // Основной принцип кроется в сравнении на изменение даты публикации
        $post = TravelPosts::factory()->create([
            'joomla_id' => 100,
            'joomla_modified' => '2026-08-17 10:00:00',
        ]);

        $postsJoomla = collect([
            $this->joomlaPost(100, $post->title, $post->alias, $post->introtext, $post->country, $post->city, "{$post->coordinates}", '2026-08-17 11:00:00')
        ]);

        // Синхронизируем
        $this->syncTable($postsJoomla);

        $this->assertDatabaseHas('travel_posts', [
            'joomla_id' => 100,
            'joomla_modified' => '2026-08-17 11:00:00',
        ]);

        // Проверяем, что вместо второй записи была обновлена первая
        $this->assertDatabaseCount('travel_posts', 1);
    }

    /* Тестирование на проверку существующих данных после синхронизации */
    public function test_sync_skip_post(): void
    {
        // Если ID совпадает и дата публикации даже, то строку оставляем без изменений
        $post = TravelPosts::factory()->create([
            'joomla_id' => 100,
            'joomla_modified' => '2026-08-17 11:00:00',
        ]);

        $postsJoomla = collect([
            $this->joomlaPost(100, $post->title, $post->alias, $post->introtext, $post->country, $post->city, "{$post->coordinates}", '2026-08-17 11:00:00')
        ]);

        // Синхронизируем
        $this->syncTable($postsJoomla);

        $this->assertDatabaseHas('travel_posts', [
            'joomla_id' => 100,
            'title' => $post->title,
            'country' => $post->country,
            'city' => $post->city,
            'coordinates' => $post->coordinates,
            'joomla_modified' => '2026-08-17 11:00:00',
        ]);

        // Проверяем, что вместо второй записи была обновлена первая
        $this->assertDatabaseCount('travel_posts', 1);
    }

    /* Тестирование на удаление из таблицы при не совпадении данных на этапе синхронизации */
    public function test_sync_delete_post(): void
    {
        $modified = '2026-08-20 10:00:00';

        // Создаем множество экземпляров в таблице Laravel
        TravelPosts::factory()->createMany([
            [
                'joomla_id' => 100,
                'joomla_modified' => $modified,
            ],
            [
                'joomla_id' => 200,
                'joomla_modified' => $modified,
            ],
            [
                'joomla_id' => 300,
                'joomla_modified' => $modified,
            ],
            [
                'joomla_id' => 400,
                'joomla_modified' => $modified,
            ],
        ]);

        // Также создаем в таблице Joomla экземпляры, но убираем один ID
        $postsJoomla = collect([
            $this->joomlaPost(100, "Тестовый пост-1", "alias-1", "introtext-1", "Nepal", "Kathmandu", "23.3545, 90.8345", $modified),
            $this->joomlaPost(200, "Тестовый пост-2", "alias-2", "introtext-2", "Cambodia", "Pnompen", "46.4748, 56.4589", $modified),
            $this->joomlaPost(300, "Тестовый пост-3", "alias-3", "introtext-3", "Vietnam", "Hanoi", "36.2545, 75.3894", $modified),
        ]);

        // Синхронизируем
        $result = $this->syncTable($postsJoomla);

        // Проверяем что синхронизация была выполнена успешно и один элементов удален и 3 остались без изменений
        $this->assertTrue($result['success']);
        $this->assertSame(0, $result['created']);
        $this->assertSame(0, $result['updated']);
        $this->assertSame(3, $result['skipped']);
        $this->assertSame(1, $result['deleted']);

        $this->assertDatabaseMissing('travel_posts', [
            'joomla_id' => 400,
        ]);

        $this->assertDatabaseCount('travel_posts', 3);
    }

    /* Тестирование случая когда возвращается пустой массив после синхронизации с Joomla и данные в таблице Laravel никуда не исчезают */
    public function test_sync_empty_post(): void
    {
        
        $modified = '2026-08-20 10:00:00';

        // Создаем множество экземпляров в таблице Laravel
        TravelPosts::factory()->createMany([
            [
                'joomla_id' => 100,
                'joomla_modified' => $modified,
            ],
            [
                'joomla_id' => 200,
                'joomla_modified' => $modified,
            ],
            [
                'joomla_id' => 300,
                'joomla_modified' => $modified,
            ],
        ]);

        $postsJoomla = collect([]);

        // Синхронизируем
        $result = $this->syncTable($postsJoomla);

        $this->assertFalse($result['success']);

        $this->assertDatabaseCount('travel_posts', 3);
    }
}
