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
        $postsJoomla = JoomlaTravelPosts::all();
        $created = 0;
        $updated = 0;
        $skipped = 0;
        foreach ($postsJoomla as $postJoomla) {
            //Ищем пост в Laravel
            $postLaravel = TravelPosts::where('joomla_id', $postJoomla->id)->first();
            //Если отсутсвует, то создаем
            if (!$postLaravel) {
                $postLaravel->create(
                    [
                        'joomla_id' => $postJoomla->id,
                        'title' => $postJoomla->title,
                        'alias' => $postJoomla->alias,
                        'introtext' => $postJoomla->introtext,
                        'value' => $postJoomla->value,
                        'images' => $postJoomla->images,
                        'publish_up' => $postJoomla->publish_up,
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
                    'title' => $postJoomla->title,
                    'alias' => $postJoomla->alias,
                    'introtext' => $postJoomla->introtext,
                    'value' => $postJoomla->value,
                    'images' => $postJoomla->images,
                    'publish_up' => $postJoomla->publish_up,
                    'joomla_modified' => $postJoomla->modified,
                ]
            );
            $updated++;
        }
        $this->info("Created: {$created}");
        $this->info("Updated: {$updated}");
        $this->info("Skipped: {$skipped}");
        return Command::SUCCESS;
    }
}
