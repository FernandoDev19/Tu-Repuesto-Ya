<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Provider;
use Carbon\Carbon;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevoProveedorRegistrado extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $proveedor;
    
    public function __construct(Provider $proveedor)
    {
        $this->proveedor = $proveedor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'Id' => $this->proveedor->id,
            'Nit' => $this->proveedor->nit_empresa,
            'Nombre' => $this->proveedor->razon_social,
            'Celular' => $this->proveedor->celular,
            'Email' => $this->proveedor->email,
            'Fecha de registro' => Carbon::now()->diffForHumans(),
        ];
    }
}
