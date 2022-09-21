<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
// use redis
use Illuminate\Support\Facades\Redis;
// use guzzlehttp
use GuzzleHttp\Client;
// use telebot controller
use App\Http\Controllers\TelebotController;

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
        $schedule->call(function () {
            $reps = 5;
            for ($i = 0; $i < $reps; $i++) {
                TelebotController::toBot();
                // wait 10 secs
                sleep(5);
            }
        })
        ->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
