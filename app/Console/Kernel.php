<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return \DateTimeZone|string|null
     */
    protected function scheduleTimezone()
    {
        return 'Europe/Paris';
    }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // auth
        $schedule->command('auth:clear-resets')->dailyAt('02:00');
        // sitemap
        $schedule->command('sitemap:generate')->twiceDaily();
        // horizon
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
        // telescope
        $schedule->command('telescope:prune')->dailyAt('04:00');
        // stuck failed jobs notifier
        // https://github.com/Okipa/laravel-failed-jobs-notifier
        $schedule->command('queue:failed:notify')->everyFiveMinutes();
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
