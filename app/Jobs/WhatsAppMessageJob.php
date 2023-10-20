<?php

namespace App\Jobs;

use App\Models\Provider;
use App\Models\Solicitude;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WhatsAppMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $proveedor;
    protected $repuesto;
    protected $marca;
    protected $referencia;
    protected $modelo;
    protected $solicitud;
    protected $token;
    protected $url;

    /**
     * Create a new job instance.
     *
     * @param Provider $proveedor
     * @param string $repuesto
     * @param string $marca
     * @param string $referencia
     * @param string $modelo
     * @param Solicitude $solicitud
     * @param string $token
     * @param string $url
     */
    public function __construct(Provider $proveedor, $repuesto, $marca, $referencia, $modelo, Solicitude $solicitud, $token, $url)
    {
        $this->proveedor = $proveedor;
        $this->repuesto = $repuesto;
        $this->marca = $marca;
        $this->referencia = $referencia;
        $this->modelo = $modelo;
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
        $repuesto = $this->repuesto;
        $marca = $this->marca;
        $referencia = $this->referencia;
        $modelo = $this->modelo;
        $solicitud = $this->solicitud;
        $token = $this->token;
        $url = $this->url;
    
        if ($proveedor) {
            $numeroP = $proveedor->celular;

            $telefono = "$numeroP";
    
            $enlace = "http://127.0.0.1:8000/solicitud/{$solicitud->codigo}";
    
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
                                    'text' => $enlace,
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
        }
    }
    
}
