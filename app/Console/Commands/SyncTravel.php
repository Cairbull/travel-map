<?php

namespace App\Console\Commands;

use App\Models\TravelPosts;
use App\Models\JoomlaTravelPosts;
use Illuminate\Console\Command;

class SyncTravel extends Command
{
    protected $signature = 'travel:sync';
    protected $description = 'Synchronize travel posts from Joomla';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $postsJoomla = JoomlaTravelPosts::getForSync();
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
            $this->error('Joomla returned no posts. Deletion skipped.');

            return Command::FAILURE;
        }

        // Если в Joomla был удален пост, а тут остался, то после синхронизации он будет удален
        $deleted = TravelPosts::whereNotIn(
            'joomla_id',
            $joomlaIds
        )->delete();

        $this->info("Created: {$created}");
        $this->info("Updated: {$updated}");
        $this->info("Skipped: {$skipped}");
        $this->info("Deleted: {$deleted}");
        return Command::SUCCESS;
    }
}
