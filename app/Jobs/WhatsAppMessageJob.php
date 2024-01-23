<?php

namespace App\Jobs;

use App\Models\Provider;
use App\Models\Solicitude;
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
    protected $json_repuestos;
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
     * @param array $json_repuestos
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
    public function __construct(Provider $proveedor, $celular, $json_repuestos, $marca, $referencia, $modelo, $comentario, $nombre, $departamento, $municipio, Solicitude $solicitud, $token, $url)
    {
        $this->proveedor = $proveedor;
        $this->celular = $celular;
        $this->json_repuestos = $json_repuestos;
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
    public function handle()
    {
        $proveedor = $this->proveedor;
        $celular = $this->celular;

        $repuesto = is_array($this->json_repuestos) ? implode(',', $this->json_repuestos) : $this->json_repuestos;
        $repuesto = str_replace(array("[", "]", "\"", ","), array("", "", "", ", "), $repuesto);



        $marca = $this->marca;
        $referencia = $this->referencia;
        $modelo = $this->modelo;
        $comentario = $this->comentario;
        $nombre = $this->nombre;
        $departamento = $this->departamento;
        $municipio = $this->municipio;
        $solicitud = $this->solicitud;
        $token = $this->token;
        $url = $this->url;

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
}
