<?php

namespace App\Console;

use App\Console\Commands\JobNeuvoo;
use App\Console\Commands\JobCantalop;
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
        JobNeuvoo::class,
        JobCantalop::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('job:wuzzuf')->dailyAt('13:00');
        $schedule->command('job:cantalop')->dailyAt('14:00');
        $schedule->command('job:careerjet egypt --hour=15  --minute=4')->everyFiveMinutes();
        $schedule->command('job:careerjet uae --hour=15  --minute=4')->everyFiveMinutes();
        $schedule->command('job:careerjet kuwait --hour=15  --minute=4')->everyFiveMinutes();
        $schedule->command('job:careerjet qatar --hour=15  --minute=4')->everyFiveMinutes();
        $schedule->command('job:careerjet oman --hour=15  --minute=4')->everyFiveMinutes();
        $schedule->command('job:careerjet algérie --hour=15  --minute=4')->everyFiveMinutes();
        $schedule->command('job:careerjet saudi --hour=15  --minute=4')->everyFiveMinutes();
        $schedule->command('job:careerjet morocco --hour=15  --minute=4')->everyFiveMinutes();
        $schedule->command('job:careerjet libya --hour=15  --minute=4')->everyTenMinutes();
        $schedule->command('job:careerjet tunisia --hour=15  --minute=4')->everyTenMinutes();


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
