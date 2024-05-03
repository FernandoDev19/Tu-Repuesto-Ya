<?php

namespace App\Jobs;

use App\Models\Provider;
use App\Models\Solicitude;
use App\Models\message;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class WhatsAppMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $proveedor;
    protected $celular;
    protected $marca;
    protected $referencia;
    protected $modelo;
    protected $comentario;
    protected $nombre;
    protected $departamento;
    protected $municipio;
    protected $solicitud;
    protected $token;
    protected $url;

    /**
     * Create a new job instance.
     *
     * @param Provider $proveedor
     * @param string $celular
     * @param string $marca
     * @param string $referencia
     * @param string $modelo
     * @param string $comentario
     * @param string $nombre
     * @param string $departamento
     * @param string $municipio
     * @param Solicitude $solicitud
     * @param string $token
     * @param string $url
     */
    public function __construct(Provider $proveedor, $celular, $marca, $referencia, $modelo, $comentario, $nombre, $departamento, $municipio, Solicitude $solicitud, $token, $url)
    {
        $this->proveedor = $proveedor;
        $this->celular = $celular;
        $this->marca = $marca;
        $this->referencia = $referencia;
        $this->modelo = $modelo;
        $this->comentario = $comentario;
        $this->nombre = $nombre;
        $this->departamento = $departamento;
        $this->municipio = $municipio;
        $this->solicitud = $solicitud;
        $this->token = $token;
        $this->url = $url;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $proveedor = $this->proveedor;
        $celular = $this->celular;

        $repuesto = is_array($this->solicitud->repuesto) ? implode(',', $this->solicitud->repuesto) : $this->solicitud->repuesto;
        $repuesto = str_replace(array("[", "]", "\"", ","), array("", "", "", ", "), $repuesto);

        $marca = $this->marca;
        $referencia = $this->referencia;
        $modelo = $this->modelo;
        $comentario = $this->comentario;
        $nombre = $this->nombre;
        $departamento = $this->departamento;
        $municipio = $this->municipio;
        $solicitud = $this->solicitud;
        $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
        $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';

        $agotado = [
            'idProveedor' => $proveedor->id,
            'idSolicitud' => $solicitud->id
        ];

        if ($proveedor) {
            $numeroP = $celular;
            $nombre_proveedor = '*' . strtoupper($proveedor->razon_social) . '*';
            $pais = $solicitud->pais;
            $telefono = "$numeroP";

            /*$mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $telefono,
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
                                            'link' => 'https://turepuestoya.co/public/movies/video_auth.mp4',
                                        ]
                                    ],
                                ],
                            ],
                        ],
                    ],
            ]; */

            $new_message = new message();
            $new_message->celular = '+573053238666';
            $new_message->mensaje = '¡Hola '. $nombre_proveedor .'! 👋

            Tenemos un *nuevo pedido* para ti 🔔
            ¡Aquí están los detalles!

            🔩 *Datos del Repuesto:*
            *- Repuesto:* '. $repuesto .'
            *- Marca:* ' . $marca .'
            *- Referencia:* ' . $referencia . '
            *- Modelo (Año):* ' . $modelo .'
            *-Comentarios:* "'. $comentario .'"

            📝 *Datos del Cliente:*
            *-Nombre:* ' . $nombre . '
            *-País:* '. $pais .'
            *-Departamento:* '. $departamento .'
            *-Ciudad:* ' . $municipio . '

            *Gracias por ser parte de nuestro equipo* 👥

            *Con esta alianza le ofrecemos un EXCELENTE servicio a nuestros clientes* ✅

            Si tienes este repuesto disponible, puedes cotizarlo directamente al cliente utilizando el botón inferior ⬇

            Saludos,
            ⚙ *TU REPUESTO YA* ⚙';
            $new_message->tipo = 'enviado';
            $new_message->enviado_a = $celular;
            $new_message->idSolicitud = $solicitud->id;
            $new_message->idUser = $proveedor->id;
            $new_message->save();

            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $telefono,
                'type' => 'template',
                'template' => [
                    'name' => 'solicitud',
                    'language' => [
                        'code' => 'es',
                    ],
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => $nombre_proveedor,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $marca,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $referencia,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $modelo,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $solicitud->tipo_de_transmision,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $comentario,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $nombre,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $pais,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $departamento,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $municipio,
                                ],
                            ],
                        ],
                        [
                            'type' => 'button',
                            'sub_type' => 'url',
                            'index' => '0',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => $solicitud->codigo,
                                ],
                            ],
                        ],
                        [
                            "type" => "button",
                            "sub_type" => "quick_reply",
                            "index" => "1",
                            "parameters" => [
                              [
                                "type" => "payload",
                                "payload" => $new_message->id,
                              ]
                            ]
                        ],
                        [
                            "type" => "button",
                            "sub_type" => "quick_reply",
                            "index" => "2",
                            "parameters" => [
                              [
                                "type" => "payload",
                                "payload" => 'No es de mi categoria: ' . $solicitud->id,
                              ]
                            ]
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
            Log::info('Respuesta:', $response);
        }
    }
}
