<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Provider;

class NoticiaWhatsappJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $proveedor;
    protected $celular;

    /**
     * Create a new job instance.
     * public string
     * @param Provider $proveedor
     * @param string $celular
     */

    public function __construct(Provider $proveedor, $celular)
    {
        $this->proveedor = $proveedor;
        $this->celular = $celular;
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
                'name' => 'noticia_proveedores',
                'language' => [
                    'code' => 'es',
                ],
                'components' => [
                    [
                        'type' => 'header',
                        'parameters' => [
                            [
                                'type' => 'video',
                                'video' => [
                                    'link' => 'https://turepuestoya.co/public/movies/video_trya.mp4',
                                ]
                            ],
                        ],
                    ],
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => $this->celular
                            ],
                            [
                                'type' => 'text',
                                'text' => $this->proveedor->email
                            ],
                            [
                                'type' => 'text',
                                'text' => 'demo12345 \nDemo12345 \n \nSi ninguna de las dos funciona, por favor restablece la contraseña: \nhttps://turepuestoya.co/restablecer'
                            ],
                            [
                                'type' => 'text',
                                'text' => $this->celular
                            ],
                        ],
                    ],
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
        Log::info('Mensaje estado:', $response);
    }
}
