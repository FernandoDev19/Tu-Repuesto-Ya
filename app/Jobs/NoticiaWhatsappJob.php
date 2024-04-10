<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Provider;
use App\Models\User;

class NoticiaWhatsappJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $proveedor;
    protected $celular;
    protected $user;

    /**
     * Create a new job instance.
     * public string
     * @param Provider $proveedor
     * @param string $celular
     * @param User $user
     */

    public function __construct(Provider $proveedor, $celular, User $user)
    {
        $this->proveedor = $proveedor;
        $this->celular = $celular;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
        $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';

        $mensajeData = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $this->celular,
            'type' => 'template',
            'template' => [
                'name' => 'bienvenida_proveedor',
                'language' => [
                    'code' => 'es',
                ],
            ],
        ];

        $mensaje = json_encode($mensajeData);

        $header = [
            "Authorization: Bearer " . $token,
            "Content-Type: application/json",
        ];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($curl), true);

        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        Log::info('Mensaje enviado:', $mensajeData);
    }
}
