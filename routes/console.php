<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Update cache data points every ten minutes
Schedule::command('travel:refresh')
    ->hourly();

// Sync posts table from Joomla with Laravel
Schedule::command('travel:sync')
    ->everyThirtyMinutes();