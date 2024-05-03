<?php
// /www2/app/Http/Controllers/WaController.php
namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Provider;
use App\Models\Solicitude;
use App\Models\Answer;

class WaController extends Controller
{
    public function index(){
        return view('admin.chatWhatsappView');
    }
    /*
  * VERIFICACION DEL WEBHOOK
  */
    public function webhook()
    {
        //TOQUEN QUE QUERRAMOS PONER
        $token = 'tur3pu35t0y4.w3bhook';
        //RETO QUE RECIBIREMOS DE FACEBOOK
        $hub_challenge = isset($_GET['hub_challenge']) ? $_GET['hub_challenge'] : '';
        //TOQUEN DE VERIFICACION QUE RECIBIREMOS DE FACEBOOK
        $hub_verify_token = isset($_GET['hub_verify_token']) ? $_GET['hub_verify_token'] : '';
        //SI EL TOKEN QUE GENERAMOS ES EL MISMO QUE NOS ENVIA FACEBOOK RETORNAMOS EL RETO PARA VALIDAR QUE SOMOS NOSOTROS
        if ($token === $hub_verify_token) {
            echo $hub_challenge;
            exit;
        }
    }
    /*
  * RECEPCION DE MENSAJES
  */
    public function recibe()
    {
        // Read the data sent by WhatsApp
        $response = file_get_contents("php://input");

        // If there's no data, exit
        if ($response === null) {
            exit;
        }

        // Convert JSON to PHP array
        $response = json_decode($response, true);

        // Extract phone number from the array
        $phone = '+' . $response['entry'][0]['changes'][0]['value']['messages'][0]['from'] . "\n";

        // Extract message from the array
        if (isset($response['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'])) {
            $message = $response['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];
            $message_content = '*Hola!* 👋
Te recuerdo que este número es solo para enviar y recibir cotizaciones.

Si necesitas comunicarte con servicio al cliente llama o escribe a esta línea: +573249216736

*Saludos!*
*Tu Repuesto Ya*';
$mensajeData = [
    'messaging_product' => 'whatsapp',
     'recipient_type' => 'individual',
     'to' => '+573163529832',
     'type' => 'text',
     'text' => [
        'preview_url' => false,
         'body' =>  "*Mensaje recibido*
Telefono:".  $phone .
"Mensaje: " . $message
     ],
];
            $this->sendToAdmin($message, $mensajeData);
            $this->send($phone, $message_content);

        }

        if(isset($response['entry'][0]['changes'][0]['value']['messages'][0]['button']['text'])){
            $message = $response['entry'][0]['changes'][0]['value']['messages'][0]['button']['payload'];
            if($response['entry'][0]['changes'][0]['value']['messages'][0]['button']['text'] == 'Agotado'){
                $message_table = message::where('id', $message)->first();

                $provider = Provider::where('id', $message_table->idUser)->first();
                $solicitud = Solicitude::where('id', $message_table->idSolicitud)->first();

                if($provider && $solicitud){
                    $agotadoArray = json_decode($solicitud->agotado, true);

                    $agotadoArray[0][] = $provider->id;

                    $agotadoArray = array_merge(...$agotadoArray);

                    $solicitud->agotado = json_encode($agotadoArray);

                    $solicitud->save();

                }

                $this->sendToClient($message);
            }else if($response['entry'][0]['changes'][0]['value']['messages'][0]['button']['text'] == 'No es de mi categoría'){
                $message_content = '*Hola!* 👋
Muchas gracias por responder.
Tomaremos tu respuesta y actualizaremos nuestra base de datos.

Si necesitas comunicarte con servicio al cliente llama o escribe a esta línea: +573249216736

*Saludos!*
*Tu Repuesto Ya*';
                $this->sendToProvider($phone, $message_content);
            }

            $mensajeData = [
                'messaging_product' => 'whatsapp',
                 'recipient_type' => 'individual',
                 'to' => '+573163529832',
                 'type' => 'text',
                 'text' => [
                     'preview_url' => false,
                     'body' =>  "*Respuesta de proveedor:*
Telefono:".  $phone .
"Mensaje: No es de mi categoría la solicitud con el codigo " . $message
                 ],
             ];

             $this->sendToAdmin($message, $mensajeData);
        }

        // Save to the database
        $messageModel = new Message();
        $messageModel->celular = $phone;
        $messageModel->mensaje = $message;
        $messageModel->save();
    }

    public function sendToAdmin($message, $mensajeData){
        $new_message = new message();
        $new_message->celular = 'API';
        $new_message->mensaje = $message;
        $new_message->tipo = 'enviado';
        $new_message->enviado_a = 'Administrador (Juan)';
        $new_message->save();

        $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
        $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';

        //Mensaje para el administrador

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

    public function sendToProvider($telefono, $message_content)
    {
        $new_message = new message();
        $new_message->celular = '+573053238666';
        $new_message->mensaje = $message_content;
        $new_message->tipo = 'enviado';
        $new_message->enviado_a = $telefono;
        $new_message->save();

        $token = env('TOKEN_VERIFICATION_API');
        $url = env('URL_API_WHATSAPP');

        $mensajeData = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $telefono,
            'type' => 'text',
            'text' => [
                'preview_url' => false,
                'body' =>  $message_content
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

    public function sendToClient($messageId){
        $token = env('TOKEN_VERIFICATION_API');
        $url = env('URL_API_WHATSAPP');

        $message_table = message::where('id', $messageId)->first();

        $provider = Provider::where('id', $message_table->idUser)->first();
        $solicitud = Solicitude::where('id', $message_table->idSolicitud)->first();

        $telefono_cliente = $solicitud->numero;
        $telefono = $provider->telefono ? $provider->telefono : 'No tiene';

        $mensajeData = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $telefono_cliente,
            'type' => 'template',
            'template' => [
                'name' => 'repuesto_agotado',
                'language' => [
                    'code' => 'es',
                ],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => $provider->razon_social,
                            ],
                            [
                                'type' => 'text',
                                'text' => $provider->pais,
                            ],
                            [
                                'type' => 'text',
                                'text' => $provider->municipio,
                            ],
                            [
                                'type' => 'text',
                                'text' => $provider->celular,
                            ],
                            [
                                'type' => 'text',
                                'text' => $telefono,
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

        Log::info('Detalles: ', $response);

    }

    public function send($phone, $message){
        $token = env('TOKEN_VERIFICATION_API');
        $url = env('URL_API_WHATSAPP');

        $mensajeData = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $phone,
            'type' => 'text',
            'text' => [
                'preview_url' => false,
                'body' =>  $message
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
