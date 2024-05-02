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
        $answerSave = false;

        // Extract message from the array
        if (isset($response['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'])) {
            $message = $response['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];
            $message_content = '*Hola!* 👋
Te recuerdo que este número es solo para enviar y recibir cotizaciones.

Si necesitas comunicarte con servicio al cliente llama o escribe a esta línea: +573249216736

*Saludos!*
*Tu Repuesto Ya*';
        }

        if(isset($response['entry'][0]['changes'][0]['value']['messages'][0]['button']['text'])){
            $message = $response['entry'][0]['changes'][0]['value']['messages'][0]['button']['payload'];
            $message_content = '*Hola!* 👋
Muchas gracias por responder.
Tomaremos tu respuesta y actualizaremos nuestra base de datos.

Si necesitas comunicarte con servicio al cliente llama o escribe a esta línea: +573249216736

*Saludos!*
*Tu Repuesto Ya*';

$answerSave = true;
            // try{
                    $provider = Provider::where('celular', $phone)->orWhere('telefono', $phone)->first();
                    $solicitud = Solicitude::where('id', $message)->first();
            // }catch(\exception $e){
            //     Log::error($e);
            // }

            // if($provider && $solicitud){
            //     $answer = new Answer();
            //     $answer->idSolicitud = $solicitud->id;
            //     $answer->idProveedor = $provider->id;
            //     $repuesto = is_array(json_decode($solicitud->repuesto)) ? implode(',', json_decode($solicitud->repuesto)) : json_decode($solicitud->repuesto);
            //     $repuesto = str_replace(array("[", "]", "\"", ","), array("", "", "", ", "), $repuesto);
            //     $answer->repuesto = $repuesto;
            //     if(in_array($solicitud->categoria, $provider->especialidad)){
            //         $answer->categorias = $solicitud->categoria;
            //     }else{
            //         $answer->categorias = 'Todas las especialidades';
            //     }
            //     $answer->precio = '$0';
            //     $answer->comentarios = $message;
            //     try{
            //         $answer->save();
            //     }catch(\exception $e){
            //         Log::error($e);
            //     }
            //     if($answer->save()){
            //         $answerSave = true;
            //     }
            // }
        }

            // Save to the database
            $messageModel = new Message();
            $messageModel->celular = $phone;
            $messageModel->mensaje = $message;
            $messageModel->save();

            $new_message = new message();
            $new_message->celular = '+573053238666';
            $new_message->mensaje = $message;
            $new_message->tipo = 'enviado';
            $new_message->enviado_a = '+573163529832';
            $new_message->save();

            $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
            $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';

            //Mensaje para el administrador
            if($answerSave){
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
            }else{
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
            }

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

            //Mensaje para el que escriba

            $this->send($phone, $message_content);

    }

    public function send($telefono, $message_content)
    {
        $new_message = new message();
        $new_message->celular = '+573053238666';
        $new_message->mensaje = $message_content;
        $new_message->tipo = 'enviado';
        $new_message->enviado_a = $telefono;
        $new_message->save();

        $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
        $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';

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

        return 'Mensaje enviado';

    }
}
