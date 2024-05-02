<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Solicitude;
use Carbon\Carbon;

class verifySolicitudesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:solicitudes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica cada 10 minutos si una solicitud no tiene respuestas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $solicitudes = Solicitude::where('verificado_a_las', null)->get();
        foreach($solicitudes as $solicitud){
            $solicitud->where('created_at', '<', now()->subMinutes(10))->first();
            if($solicitud->respuestas == 0){
                $token = env('TOKEN_VERIFICATION_API');
                $url = env('URL_API_WHATSAPP');

                $mensajeData = [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'to' => '+573005442580',
                    'type' => 'text',
                    'text' => [
                        'preview_url' => false,
                        'body' =>  'La solicitud N°'.$solicitud->id.' aún no tiene respuestas'
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

                $solicitud->verificado_a_las = Carbon::now();
                $solicitud->save();

            }

        }
    }
}
