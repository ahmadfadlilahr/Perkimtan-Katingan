<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule automatic cleanup of activity logs
Schedule::command('activity:cleanup --days=30 --force')
    ->daily()
    ->at('02:00')
    ->withoutOverlapping()
    ->runInBackground()
    ->appendOutputTo(storage_path('logs/activity-cleanup.log'));

// Optional: Weekly cleanup dengan lebih agresif (60 hari)
Schedule::command('activity:cleanup --days=60 --force')
    ->weekly()
    ->sundays()
    ->at('03:00')
    ->withoutOverlapping()
    ->runInBackground()
    ->appendOutputTo(storage_path('logs/activity-cleanup-weekly.log'));
