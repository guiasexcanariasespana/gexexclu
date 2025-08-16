<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        

        $schedule->command('anuncio:finalizar')->dailyAt('00:00')
            ->runInBackground()
            ->emailOutputOnFailure('devproyectote@gmail.com');
        $schedule->command('anuncio:vence3')->dailyAt('11:30')
            ->runInBackground()
            ->emailOutputOnFailure('devproyectote@gmail.com');
        $schedule->command('anuncio:vence_tomorrow')->dailyAt('12:00')
            ->runInBackground()
            ->emailOutputOnFailure('devproyectote@gmail.com');
        $schedule->command('anuncio:vence_hoy')->dailyAt('10:30')
            ->runInBackground()
            ->emailOutputOnFailure('devproyectote@gmail.com');
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
