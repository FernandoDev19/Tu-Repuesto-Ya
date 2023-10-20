<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitude;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Answer;
use App\Models\Geolocation;
use Illuminate\Support\Facades\Validator;
use App\Jobs\WhatsAppMessageJob;
use App\Notifications\NuevaSolicitudRepuesto;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{

    public function index()
    {
        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');

        // Lista de municipios
        $group = [];

        foreach ($departamentos as $departamento) {
            $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
            $group[$departamento] = $municipios;
        }

        $name = null;

        // Si existe una sesión activa se obtiene el nombre para pasarlo a la vista
        if (auth()->check()) {
            $name = auth()->user()->name;
        }
        return view("home.index", compact('name', 'departamentos', 'group'));
    }

    public function validation(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'marca' => 'required',
                'referencia' => 'required',
                'modelo' => 'required|numeric',
                'tipo' => 'required',
                'repuesto' => 'required',
                'img_repuesto' => 'file|mimes:png,jpg,jpeg|max:5024',
                'comentario' => 'max:500',
                'nombre' => 'required',
                'cel' => 'required|numeric|digits: 10',
                'email' => 'required|email',
                'departamento' => 'required',
                'municipio' => 'required',
            ],
            [
                'tipo.required' => 'El campo tipo de transmisión es obligatorio'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', '¡No se pudo enviar! Revise nuevamente sus datos');
        }

        $solicitud = new Solicitude();

        $solicitud->marca = $request->marca;
        $solicitud->referencia = $request->referencia;
        $solicitud->modelo = $request->modelo;
        $solicitud->tipo_de_transmision = $request->tipo;
        $solicitud->repuesto = $request->repuesto;

        // Obtener imagen del repuesto
        $imagen = $request->file('img_repuesto');

        if ($imagen !== null) {
            $nombreArchivoOriginal = $imagen->getClientOriginalName();

            // Definir una carpeta de destino (puedes personalizarla)
            $carpetaDestino = 'public';

            // Generar un nombre único para el archivo
            $nombreArchivo = uniqid() . '_' . $nombreArchivoOriginal;

            // Mover y guardar la imagen en la carpeta de destino
            $imagen->storeAs($carpetaDestino, $nombreArchivo);

            // Guardar el nombre del archivo en la base de datos
            $solicitud->img_repuesto = $nombreArchivo;
        } else {
            $solicitud->img_repuesto = 'No se subió ningun archivo';
        }

        $solicitud->comentario = $request->comentario;
        $solicitud->nombre = $request->nombre;
        $solicitud->correo = $request->email;
        $solicitud->numero = "57" . $request->cel;
        $solicitud->departamento = $request->departamento;
        $solicitud->municipio = $request->municipio;

        $longitudCodigo = 11;
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';

        for ($i = 0; $i < $longitudCodigo; $i++) {
            $indice = rand(0, strlen($caracteres) - 1);
            $codigo .= $caracteres[$indice];
        }

        $solicitud->codigo = $codigo;

        try {
            $solicitud->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar los datos: ' . $e->getMessage());
        }


        $proveedores = Provider::all()->where('estado', 1);

        $token = env('WHATSAPP_API_TOKEN');
        $url = env('WHATSAPP_API_URL');

        foreach ($proveedores as $proveedor) {
            // Despachar un trabajo para enviar el mensaje de WhatsApp a los proveedores
            WhatsAppMessageJob::dispatchAfterResponse(
                $proveedor,
                $request->repuesto,
                $request->marca,
                $request->referencia,
                $request->modelo,
                $solicitud,
                $token,
                $url
            )->onQueue('redis');
        }

        //Enviar comfirmacion al cliente de que su pedido ha sido recibido

        $numeroC = "57$request->cel";
        $nombre_cliente = $request->nombre;

        $telefono = $numeroC;

        $mensajeData = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $telefono,
            'type' => 'template',
            'template' => [
                'name' => 'confirmacion_solicitud',
                'language' => [
                    'code' => 'es',
                ],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => $nombre_cliente,
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

         // Notificar al administrador
         $admin = User::where('role', 'Proveedor')->get();

         if ($admin) {
             Notification::send($admin, new NuevaSolicitudRepuesto($solicitud));
         }

        return redirect()->back()->with('message', "¡Envío exitoso!");
    }

    public function solicitudRepuesto($codigo, $id = null)
    {
        $solicitud = Solicitude::where('codigo', $codigo)->first();
        if ($solicitud && $solicitud->codigo == $codigo) {
            $marca = $solicitud->marca;
            $referencia = $solicitud->referencia;
            $modelo = $solicitud->modelo;
            $tipo = $solicitud->tipo_de_transmision;
            $repuesto = $solicitud->repuesto;
            $img_repuesto = $solicitud->img_repuesto;
            $comentario = $solicitud->comentario;

            $user = User::find($id);
            $nit = null;

            if($user){
                $idP = $user->proveedor_id;
                $proveedor = Provider::where('id', $idP)->first();
                if($proveedor){
                    $nit = $proveedor->nit_empresa;
                }
            }

            return view('solicitud.index', compact('nit', 'codigo', 'marca', 'referencia', 'modelo', 'tipo', 'repuesto', 'img_repuesto', 'comentario'));
        } else {
            return redirect()->route('servicios')->with('error', '!Código de solicitud inválido!');
        }
    }

    public function storeDP(Request $request, $codigo)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nit' => [
                'required',
                'alpha_dash',
                'min:8',
                'max:16',
                'regex:/^[a-zA-Z0-9]+$/',
                'not_regex:/[.\-_+!@#$%^&*()=]/',
            ],
            'repuesto' => 'required',
            'tipo_repuesto' => 'required',
            'precio' => 'required',
            'garantia' => [
                'required',
                'numeric',
                'regex:/^[0-9]+$/',
            ],
        ], [
            'tipo_repuesto.required' => 'El tipo de repuesto es obligatorio',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', '¡No se pudo enviar!');
        }

        // Obtener el proveedor y verificar si existe
        $nit = $request->input('nit');
        $proveedor = Provider::where('nit_empresa', $nit)->first();

        if (!$proveedor) {
            return redirect()->back()->with('error', 'El nit ingresado no existe');
        }

        // Obtener la solicitud y verificar si existe
        $solicitud = Solicitude::where('codigo', $codigo)->first();

        if (!$solicitud) {
            return redirect()->route('servicios')->with('error', '!Código de solicitud inválido!');
        }

        // Verificar si el proveedor ya ha respondido a esta solicitud
        $respuestaExistente = Answer::where('idProveedor', $proveedor->id)
            ->where('idSolicitud', $solicitud->id)
            ->exists();

        if ($respuestaExistente) {
            return redirect()->back()->with('error', 'Ya has respondido a esta solicitud previamente');
        }

        // Verificar el estado de la solicitud
        if (!$solicitud->estado || $solicitud->respuestas >= 5) {
            $rutaArchivo = $solicitud->img_repuesto;
            // Eliminar los archivos asociados al proveedor desde el storage
            if ($rutaArchivo) {
                Storage::delete('public/' . $rutaArchivo);
            }
            $solicitud->img_repuesto = 'No se subió ningun archivo';
            $solicitud->codigo = null;
            $solicitud->estado = false;
            $solicitud->save();
            return redirect()->route('servicios')->with('error', 'Esta solicitud ya no acepta más respuestas.');
        } else {
            $solicitud->respuestas = $solicitud->respuestas + 1;
            $solicitud->save();
        }

        // Crear una nueva respuesta
        $answer = new Answer();
        $answer->idSolicitud = $solicitud->id;
        $answer->idProveedor = $proveedor->id;
        $answer->repuesto = $request->repuesto;
        $answer->tipo_repuesto = $request->tipo_repuesto;
        $answer->precio = "$$request->precio";
        $answer->garantia = "$request->garantia $request->garantiaSeleccion";
        if ($request->comentarioP) {
            $answer->comentarios = $request->comentarioP;
        } else {
            $answer->comentarios = 'No hay comentarios';
        }
        $answer->save();

        // Enviar datos al cliente
        $precio = $answer->precio;
        $garantia = $answer->garantia;
        $repuesto = $answer->repuesto;
        $tipo_repuesto = $answer->tipo_repuesto;
        $nombre_cliente = $solicitud->nombre;
        $almacen = $proveedor->razon_social;
        $ciudad = $proveedor->municipio;
        $comentarios = $answer->comentarios;
        $numero_celular = $proveedor->celular;

        $token = env('WHATSAPP_API_TOKEN');
        $telefono = $solicitud->numero;
        $url = env('WHATSAPP_API_URL');

        $mensajeData = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $telefono,
            'type' => 'template',
            'template' => [
                'name' => 'respuesta_proveedor',
                'language' => [
                    'code' => 'es',
                ],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => $nombre_cliente,
                            ],
                            [
                                'type' => 'text',
                                'text' => $almacen,
                            ],
                            [
                                'type' => 'text',
                                'text' => $ciudad,
                            ],
                            [
                                'type' => 'text',
                                'text' => $repuesto,
                            ],
                            [
                                'type' => 'text',
                                'text' => $tipo_repuesto,
                            ],
                            [
                                'type' => 'text',
                                'text' => $precio,
                            ],
                            [
                                'type' => 'text',
                                'text' => $garantia,
                            ],
                            [
                                'type' => 'text',
                                'text' => $numero_celular,
                            ],
                            [
                                'type' => 'text',
                                'text' => $comentarios,
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

        if(auth()->check()){
            return redirect()->route('viewSolicitudes')->with('message', 'La respuesta se ha enviado exitosamente');
        }
        return redirect()->route('servicios')->with('message', 'La respuesta se ha enviado exitosamente');
    }

    public function index2()
    {
        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');

        // Lista de municipios
        $group = [];

        foreach ($departamentos as $departamento) {
            $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
            $group[$departamento] = $municipios;
        }

        $name = null;

        if (auth()->check()) {
            $name = auth()->user()->name;
        }
        return view("home.miempresa", compact('name', 'departamentos', 'group'));
    }

    public function index3()
    {

        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');

        // Lista de municipios
        $group = [];

        foreach ($departamentos as $departamento) {
            $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
            $group[$departamento] = $municipios;
        }

        $name = null;

        if (auth()->check()) {
            $name = auth()->user()->name;
        }
        return view("home.proveedor", compact('name', 'departamentos', 'group'));
    }
}
