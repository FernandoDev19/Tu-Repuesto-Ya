<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SolicitudClienteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
     public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    
    public function build(){
        return $this->view('mail.solicitud_cliente_mail')->subject('¡Confirmación de Solicitud!')->with($this->name);
    }
}
