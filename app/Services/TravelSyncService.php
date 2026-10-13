<?php

namespace App\Services;

use App\Models\TravelPosts;

class TravelSyncService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function sync($postsJoomla): array
    {
        $joomlaIds = $postsJoomla->pluck('id');

        $created = 0;
        $updated = 0;
        $skipped = 0;

        foreach ($postsJoomla as $postJoomla) {
            //Ищем пост в Laravel
            $postLaravel = TravelPosts::where('joomla_id', $postJoomla->id)->first();
            //Если отсутсвует, то создаем
            if (!$postLaravel) {
                TravelPosts::create(
                    [
                        'joomla_id' => $postJoomla->id,
                        'title' => $postJoomla->title,
                        'alias' => $postJoomla->alias,
                        'introtext' => $postJoomla->introtext,
                        'publish_up' => $postJoomla->publish_up,
                        'images' => $postJoomla->images,
                        'country' => $postJoomla->country,
                        'city' => $postJoomla->city,
                        'coordinates' => $postJoomla->coordinates,
                        'group_stories' => $postJoomla->group_stories,
                        'joomla_modified' => $postJoomla->modified,
                    ]
                );
                $created++;
                continue;
            } elseif ($postLaravel->joomla_modified == $postJoomla->modified) {
                // Если пост есть ничего не делаем
                $skipped++;
                continue;
            }
            // Пост обновлен
            $postLaravel->update(
                [
                    'joomla_id' => $postJoomla->id,
                    'title' => $postJoomla->title,
                    'alias' => $postJoomla->alias,
                    'introtext' => $postJoomla->introtext,
                    'publish_up' => $postJoomla->publish_up,
                    'images' => $postJoomla->images,
                    'country' => $postJoomla->country,
                    'city' => $postJoomla->city,
                    'coordinates' => $postJoomla->coordinates,
                    'group_stories' => $postJoomla->group_stories,
                    'joomla_modified' => $postJoomla->modified,
                ]
            );
            $updated++;
        }

        // Если пришел пустой массив, то удаление будет отменено и посты не сотрутся
        if ($postsJoomla->isEmpty()) {
            return [
                'success' => false,
                'created' => $created,
                'updated' => $updated,
                'skipped' => $skipped,
                'deleted' => 0,
            ];
        }

        // Если в Joomla был удален пост, а тут остался, то после синхронизации он будет удален
        $deleted = TravelPosts::whereNotIn(
            'joomla_id',
            $joomlaIds
        )->delete();

        return [
            'success' => true,
            'created' => $created,
            'updated' => $updated,
            'skipped' => $skipped,
            'deleted' => $deleted,
        ];
    }
}
