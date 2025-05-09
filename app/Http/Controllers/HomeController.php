<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Console\Scheduling\Schedule;
use Carbon\Carbon;

//Modelos
use App\Models\Solicitude;
use App\Models\Provider;
use App\Models\User;
use App\Models\Answer;
use App\Models\Geolocation;
use App\Models\Country_code;

use App\Mail\SolicitudClienteMail;

use App\Jobs\WhatsAppMessageJob;

use App\Notifications\NuevaSolicitudRepuesto;

class HomeController extends Controller
{

    public function index()
    {
        // Lista de codigos
        $codigos = Country_code::all();

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
        return view("home.index", compact('name', 'departamentos', 'group', 'codigos'));
    }

    public function validation(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'marca' => 'required|max: 100',
                'referencia' => 'required|max: 50',
                'modelo' => 'required|numeric|digits: 4',
                'tipo' => 'required',
                'json_repuestos' => 'required',
                'json_categorias' => 'required',
                'img_repuesto.*' => 'file|mimes:png,jpg,jpeg|max:5024',
                'comentario' => 'max:500',
                'nombre' => 'required|max: 120',
                'cel' => 'required|numeric|digits_between:8,10',
                'email' => 'nullable|email|max: 200',
            ],
            [
                'cel.required' => 'El campo celular es obligatorio',
                'tipo.required' => 'El campo tipo de transmisión es obligatorio',
                'json_repuestos.required' => 'El campo repuesto(s) es obligatorio',
                'json_categorias.required' => 'El campo categoria es obligatorio',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', '¡Error! ¡No se pudo enviar la solicitud!, Revise sus datos y envie nuevamente');
        }

        $solicitudes_old = Solicitude::whereDate('created_at', '<', now()->subDays(25))->get();

            // Eliminar las imágenes de las solicitudes que tengan más de 25 días
            foreach ($solicitudes_old as $solicitud) {
                    // Llamar a la función eliminarImagenes()
                    $this->eliminarImagenes($solicitud->id);
            }

        $solicitud = new Solicitude();

        $request->marca_otro = 'otro';

        if ($request->marca === 'otro') {
            $solicitud->marca = 'otro';
        } else {
            $solicitud->marca = $request->marca;
        }
        $solicitud->referencia = $request->referencia;
        $solicitud->modelo = $request->modelo;
        $solicitud->tipo_de_transmision = $request->tipo;
        $solicitud->repuesto = $request->json_repuestos;

        $maximoImagenes = 3;

        if ($request->hasFile('img_repuesto')) {
            if (count($request->file('img_repuesto')) < 4) {
                // Obtener imágenes del repuesto
                $imagenes = $request->file('img_repuesto');

                $nombresArchivos = [];

                foreach ($imagenes as $imagen) {
                    // Verificar si el archivo es una imagen
                    $nombreArchivoOriginal = $imagen->getClientOriginalName();

                    // Definir una carpeta de destino (puedes personalizarla)
                    $carpetaDestino = 'public';

                    // Generar un nombre único para el archivo
                    $nombreArchivo = uniqid() . '_' . $nombreArchivoOriginal;

                    // Mover y guardar la imagen en la carpeta de destino
                    $imagen->storeAs($carpetaDestino, $nombreArchivo);

                    // Agregar el nombre del archivo al array
                    $nombresArchivos[] = $nombreArchivo;
                }

                if (!empty($nombresArchivos)) {
                    // Guardar los nombres de archivos en formato JSON en la base de datos
                    $solicitud->img_repuesto = json_encode($nombresArchivos);
                } else {
                    $solicitud->img_repuesto = json_encode(['No se subieron archivos válidos']);
                }
            } else {
                return back()->withErrors(['img_repuesto' => 'No puedes subir más de 3 imágenes'])->withInput()->with('error', '¡Error! ¡No se pudo enviar la solicitud!, Revise sus datos y envie nuevamente');;
            }
        } else {
            $solicitud->img_repuesto = json_encode(['No se subió ningun archivo']);
        }

        $solicitud->categoria = $request->json_categorias;
        $request->comentario = $request->comentario ?? 'No hay comentarios';
        $solicitud->comentario = $request->comentario ?? 'No hay comentarios';
        $solicitud->nombre = $request->nombre;
        $solicitud->correo = $request->email;
        $solicitud->numero = $request->codigo_cel . $request->cel;

        $paises = [
            '+57' => 'Colombia',
            '+54' => 'Argentina',
            '+591' => 'Bolivia',
            '+55' => 'Brasil',
            '+56' => 'Chile',
            '+593' => 'Ecuador',
            '+594' => 'Guyana Francesa',
            '+592' => 'Guyana',
            '+595' => 'Paraguay',
            '+51' => 'Perú',
            '+597' => 'Surinam',
            '+598' => 'Uruguay',
            '+58' => 'Venezuela',
            '+1' => 'Estados Unidos',
            '+506' => 'Costa Rica',
            '+503' => 'El Salvador',
            '+502' => 'Guatemala',
            '+504' => 'Honduras',
            '+52' => 'México',
            '+505' => 'Nicaragua',
            '+507' => 'Panamá',
        ];

        $solicitud->pais = $paises[$request->codigo_cel];

        $request->departamento = $request->departamento ?? 'Indefinido';
        $request->municipio = $request->municipio ?? 'Indefinido';
        $solicitud->departamento = $request->departamento ?? 'Indefinido';
        $solicitud->municipio = $request->municipio ?? 'Indefinido';

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
            return redirect()->back()->withErrors($validator)
                ->withInput()->with('error', 'Error al guardar los datos: ' . $e->getMessage());
        }

        //Enviar comfirmacion al cliente de que su pedido ha sido recibido
        try {
            $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
            $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';

            $proveedores = Provider::all()->where('estado', 1);

            foreach ($proveedores as $proveedor) {
                $jsonMarcasGuardadas = $proveedor->marcas_preferencias;
                $jsonCategoriasGuardadas = $proveedor->especialidad;

                // Decodificar el JSON a un array asociativo
                $marcasGuardadasArray = json_decode($jsonMarcasGuardadas, true);
                $categoriasGuardadasArray = json_decode($jsonCategoriasGuardadas, true);

                // Obtener la marca del carro del cliente (ajusta según tu lógica, por ejemplo, mediante un formulario)
                $marcaCliente = $request->marca;
                $categoriaRepuesto = json_decode($request->json_categorias, true);

                if ((is_array($marcasGuardadasArray) && in_array('Todas las marcas', $marcasGuardadasArray) || in_array($marcaCliente, $marcasGuardadasArray) || in_array($request->marca_otro, $marcasGuardadasArray)) && (is_array($categoriasGuardadasArray) && in_array('Todas las especialidades', $categoriasGuardadasArray) || array_intersect($categoriaRepuesto, $categoriasGuardadasArray)) || $request->categoria_repuesto == 'No se') {
                    $celular = $proveedor->celular;
                    $telefono = $proveedor->telefono;

                    // Despachar un trabajo para enviar el mensaje de WhatsApp a los proveedores
                    if ($celular) {
                        WhatsAppMessageJob::dispatchAfterResponse(
                            $proveedor,
                            $celular,
                            $request->json_repuestos,
                            $request->marca,
                            $request->referencia,
                            $request->modelo,
                            $request->comentario,
                            $request->nombre,
                            $request->departamento,
                            $request->municipio,
                            $solicitud,
                            $token,
                            $url
                        );
                    }

                    if ($telefono) {
                        WhatsAppMessageJob::dispatchAfterResponse(
                            $proveedor,
                            $telefono,
                            $request->json_repuestos,
                            $request->marca,
                            $request->referencia,
                            $request->modelo,
                            $request->comentario,
                            $request->nombre,
                            $request->departamento,
                            $request->municipio,
                            $solicitud,
                            $token,
                            $url
                        );
                    }
                }
            }

            $numeroC = $request->codigo_cel . $request->cel;
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
                        [
                            'type' => 'header',
                            'parameters' => [
                                [
                                    'type' => 'image',
                                    'image' => [
                                        'link' => 'https://turepuestoya.co/public/img/logo_whatsapp.png',
                                    ]
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
        } catch (\Exception $e) {
            // Manejo de errores aquí
            Log::error('Error al enviar mensaje de WhatsApp: ' . $e->getMessage());
        }
        // Notificar al administrador
        $admin = User::where('role', 'Proveedor')->get();

        if ($admin) {
            Notification::send($admin, new NuevaSolicitudRepuesto($solicitud));
        }

        if ($solicitud->correo) {
            Mail::to($solicitud->correo)->send(new SolicitudClienteMail($solicitud->nombre));
        }

        return redirect()->back()->with('message', "¡Envío exitoso! \n Revise su Whatsapp o su Correo electrónico");
    }

    public function solicitudRepuesto($codigo, $id = null)
    {
        $solicitud = Solicitude::where('codigo', $codigo)->first();
        if ($solicitud && $solicitud->codigo == $codigo) {
            $marca = $solicitud->marca;
            $referencia = $solicitud->referencia;
            $modelo = $solicitud->modelo;
            $tipo = $solicitud->tipo_de_transmision;
            $repuesto = json_decode($solicitud->repuesto, true);

            $json_nombres = $solicitud->img_repuesto;
            $nombres = json_decode($json_nombres);

            $comentario = $solicitud->comentario;

            $user = User::find($id);
            $nit = null;

            if ($user) {
                $idP = $user->proveedor_id;
                $proveedor = Provider::where('id', $idP)->first();
                if ($proveedor) {
                    $nit = $proveedor->nit_empresa;
                }
            }

            return view('home.solicitud', compact('nit', 'codigo', 'marca', 'referencia', 'modelo', 'tipo', 'repuesto', 'nombres', 'comentario'));
        } else {
            return redirect()->route('servicios')->with('error', '!Código de solicitud inválido!');
        }
    }

    public function storeDP(Request $request, $codigo)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nit' => 'required|numeric|digits_between:8,16',
            // 'tipo_repuesto' => 'required',
            'precio' => 'required',

        ], [
            // 'tipo_repuesto.required' => 'El tipo de repuesto es obligatorio',
            'nit.max' => 'El campo NIT no puede contener mas de 16 digitos',
            'nit.min' => 'El campo NIT debe contener minimo 8 digitos',
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
            return redirect()->back()->withInput()->with('error', 'El nit ingresado no existe');
        }else{
            if(!$proveedor->estado){
                return redirect()->back()->withInput()->with('error', 'Actualmente su cuenta se encuentra inactiva');
            }
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
            return redirect()->back()->withInput()->with('error', 'Ya has respondido a esta solicitud previamente');
        }

        // Crear una nueva respuesta
        $answer = new Answer();
        $answer->idSolicitud = $solicitud->id;
        $answer->idProveedor = $proveedor->id;
        $answer->repuesto = $request->json_repuestos;
        // $answer->tipo_repuesto = json_encode($request->tipo_repuesto);
        $answer->precio = "$ $request->precio";

        // $datos_garantia = implode(" ", $request->input('garantia')) . " " . $request->garantiaSeleccion;
        // $answer->garantia = json_encode($datos_garantia);

        if ($request->comentarioP) {
            $answer->comentarios = 'Además, el proveedor ha compartido algunos comentarios: \n "*_' . $request->comentarioP . '_*"';
        } else {
            $answer->comentarios = '"No hay comentarios"';
        }
        $answer->save();

        // Verificar el estado de la solicitud
        if (!$solicitud->estado || $solicitud->respuestas >= 5) {

            $solicitud->codigo = null;
            $solicitud->estado = false;
            $solicitud->save();
            return redirect()->route('servicios')->with('error', 'Esta solicitud ya no acepta más respuestas.');
        } else if($answer->save()){
            $solicitud->respuestas = $solicitud->respuestas + 1;
            $solicitud->save();
        }

        // Enviar datos al cliente
        $precio = $answer->precio;
        // $garantia = $answer->garantia;
        $repuesto = is_array($answer->repuesto) ? implode(',', $answer->repuesto) : $answer->repuesto;
        $repuesto = str_replace(array("[", "]", "\"", ","), array("", "", "", ", "), $repuesto);
        // $tipo_repuesto = $answer->tipo_repuesto;
        $nombre_cliente = $solicitud->nombre;
        $almacen = $proveedor->razon_social;
        $pais = $proveedor->pais;
        $ciudad = $proveedor->municipio;
        $comentarios = $answer->comentarios;
        $numero_celular = $proveedor->celular;

        $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
        $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';
        $telefono = $solicitud->numero;

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
                                'text' => $repuesto,
                            ],
                            // [
                            //     'type' => 'text',
                            //     'text' => $tipo_repuesto,
                            // ],
                            [
                                'type' => 'text',
                                'text' => $precio,
                            ],
                            // [
                            //     'type' => 'text',
                            //     'text' => $garantia,
                            // ],
                            [
                                'type' => 'text',
                                'text' => $almacen,
                            ],
                            [
                                'type' => 'text',
                                'text' => $pais,
                            ],
                            [
                                'type' => 'text',
                                'text' => $ciudad,
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

        if (auth()->check()) {
            return redirect()->route('viewSolicitudes')->with('message', 'La respuesta se ha enviado exitosamente');
        }
        return redirect()->route('servicios')->with('message', 'La respuesta se ha enviado exitosamente');
    }

    private function eliminarImagenes(int $solicitudId)
    {
        // Obtener las imágenes de la solicitud
        $solicitudes = Solicitude::find($solicitudId);

        $imagenes = json_decode($solicitudes->img_repuesto);

        // Eliminar las imágenes del servidor
        foreach ($imagenes as $imagen) {
            $imagen->delete();
            Storage::delete($imagen);
        }
    }

}
