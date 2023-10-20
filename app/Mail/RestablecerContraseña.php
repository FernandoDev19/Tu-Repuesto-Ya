<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RestablecerContraseña extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

        /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.restablecer_contraseña')
        ->subject('¡Restablecer contraseña!')
        ->with($this->email);
    }
}
