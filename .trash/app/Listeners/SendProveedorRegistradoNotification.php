<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\NuevoProveedorRegistrado;
use Illuminate\Support\Facades\Notification;

class SendProveedorRegistradoNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // Notificar al administrador
        $admin = User::where('role', 'Admin')->first();

        if ($admin) {
            Notification::send($admin, new NuevoProveedorRegistrado($event->provider));
        }
    }
}
