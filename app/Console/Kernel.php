<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Functions\Fetch;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // schedule the caching articles data function every 10 minutes
        $schedule->call(function () {
            $articlesJSONPath = storage_path() . '/json/articles-data.json';

            if ($articlesJSONPath) {
                // fetching articles from API
                $articles = (new Fetch())->fetch_articles();

                // caching articles to JSON file
                file_put_contents($articlesJSONPath, json_encode($articles));
            } else
                throw new \Exception('Articles JSON file not found');

            error_log('Articles data cached successfully');
        })->everyMinute();

        // scheduling the caching mars photo data everyday
        $schedule->call(function () {
            $marsPhotoJSONPath = storage_path() . '/json/mars-photo-data.json';

            if ($marsPhotoJSONPath) {
                // fetching mars photos from API
                $marsPhotos = (new Fetch())->fetch_mars_photos();

                // caching mars photos to JSON file
                file_put_contents($marsPhotoJSONPath, json_encode($marsPhotos));
            } else
                throw new \Exception('Mars photos JSON file not found');

            error_log('Mars photos data cached successfully');
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
