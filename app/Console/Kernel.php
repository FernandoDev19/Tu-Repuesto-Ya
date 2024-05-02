<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Solicitude;
use App\Http\Controllers\HomeController;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('verify:solicitudes')->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected $commands = [
        \App\Console\Commands\verifySolicitudesCommand::class,
    ];
    protected function commands(): void
    {
    }
}
