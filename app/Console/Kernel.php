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
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // Obtener todas las solicitudes
            $solicitudes = Solicitude::all();

            // Eliminar las imágenes de las solicitudes que tengan más de 25 días
            foreach ($solicitudes as $solicitud) {
                if ($solicitud->created_at < Carbon::now()->subDays(25)) {
                    $HomeController1 = new HomeController();
                    // Llamar a la función eliminarImagenes()
                    $HomeController1->eliminarImagenes($solicitud->id);
                }
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
