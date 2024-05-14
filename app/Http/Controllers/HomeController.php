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
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

//Modelos
use App\Models\Solicitude;
use App\Models\Provider;
use App\Models\User;
use App\Models\Answer;
use App\Models\Geolocation;
use App\Models\Country_code;
use App\Models\Category;
use App\Models\message;

use App\Mail\SolicitudClienteMail;
use App\Mail\SolicitudRepuestoMail;

use App\Jobs\WhatsAppMessageJob;

use App\Notifications\NuevaSolicitudRepuesto;

class HomeController extends Controller
{

    public function index(): view
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

    public function modalUrlView(): view
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
        return view("home.indexModal", compact('name', 'departamentos', 'group', 'codigos'));
    }

    public function validation(Request $request): redirectResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'marca' => 'required|max: 100',
                'referencia' => 'required|max: 50',
                'modelo' => 'required|numeric|digits: 4',
                'tipo' => 'required',
                // 'json_repuestos' => 'required',
                // 'json_categorias' => 'required',
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
                // 'json_categorias.required' => 'El campo categoria es obligatorio',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', '¡Error! ¡No se pudo enviar la solicitud!, Revise sus datos y envie nuevamente');
        }

        $solicitudes_old = Solicitude::whereDate('created_at', '<', now()->subDays(10))->get();

        // Eliminar las imágenes de las solicitudes que tengan más de 25 días
        foreach ($solicitudes_old as $solicitud) {
            // Llamar a la función eliminarImagenes()
            $this->eliminarImagenes($solicitud->id);
            // $solicitud->estado = false;
            // $solicitud->codigo = null;
            // $solicitud->save();
        }

        $solicitud = new Solicitude();

        $categories = Category::with('keyword')->get();
        if ($request->filled('json_repuestos')) {
            $repuestos_array = json_decode($request->json_repuestos, true);
        } else {
            if ($request->filled('repuesto') && $request->filled('cantidad')) {
                $repuestos_array = [$request->cantidad . ' ' . $request->repuesto];
            } else {
                $repuestos_array = [];
            }
        }

        foreach ($categories as $categoria) {
            $palabras = $categoria->keyword->pluck('palabra_clave');

            // Reemplazar las palabras clave en el array
            $palabrasClave[$categoria->nombre_categoria] =  array_map('strtolower', $palabras->toArray());
        }

        // Inicializar un array para almacenar categorías
        $categoriasEncontradas = [];

        foreach ($repuestos_array as $repuestoSeleccionado) {
            // Convertir elementos del subarray y el repuesto a minúsculas y quitar tildes
            $repuestoSeleccionado = strtolower($repuestoSeleccionado);

            // Variable booleana para indicar si se encontró coincidencia en alguna categoría
            $encontrado = false;

            foreach ($palabrasClave as $categoria => $palabras) {
                // Convertir elementos del subarray a minúsculas y quitar tildes
                $palabras = array_map('strtolower', $palabras);

                foreach ($palabras as $palabra) {
                    if (stripos($repuestoSeleccionado, $palabra) !== false) {
                        // Agregar la categoría al array si no existe
                        if (!in_array($categoria, $categoriasEncontradas)) {
                            $categoriasEncontradas[] = $categoria;
                        }
                        $encontrado = true;
                    }
                }
            }

            // Si no se encuentra en ninguna categoría, agregar 'No sé'
            if (!$encontrado) {
                $categoriasEncontradas[] = 'No sé';
            }
        }

        // Asignar el array de categorías encontradas a la solicitud
        $solicitud->categoria = json_encode($categoriasEncontradas);


        $request->marca_otro = 'otro';

        if ($request->marca === 'otro') {
            $solicitud->marca = 'otro';
        } else {
            $solicitud->marca = $request->marca;
        }
        $solicitud->referencia = $request->referencia;
        $solicitud->modelo = $request->modelo;
        $solicitud->tipo_de_transmision = $request->tipo;
        if ($request->has('json_repuestos') && $request->filled('json_repuestos')) {
            $repuestos = json_decode($request->json_repuestos, true);

            if ($request->filled('repuesto') && $request->filled('cantidad')) {
                $definicion = [];

                if ($request->filled('check_izquierdo') && $request->check_izquierdo === 'on') {
                    $definicion[] = 'izquierdo';
                }

                if ($request->filled('check_derecho') && $request->check_derecho === 'on') {
                    $definicion[] = 'derecho';
                }

                if ($request->filled('check_trasero') && $request->check_trasero === 'on') {
                    $definicion[] = 'trasero';
                }

                if ($request->filled('check_delantero') && $request->check_delantero === 'on') {
                    $definicion[] = 'delantero';
                }

                $nuevoRepuesto = $request->cantidad . ' ' . $request->repuesto;

                if (!empty($definicion)) {
                    $nuevoRepuesto .= ' ' . implode(', ', $definicion);
                }

                $repuestos[] = $nuevoRepuesto;
                $jsonActualizado = json_encode($repuestos);
                $request->merge(['json_repuestos' => $jsonActualizado]);
                $solicitud->repuesto = $jsonActualizado;
            } else {
                $solicitud->repuesto = $request->json_repuestos;
            }
        } else {
            if ($request->has('repuesto') && $request->has('cantidad') && $request->filled('repuesto') && $request->filled('cantidad')) {
                $definicion = [];

                if ($request->filled('check_izquierdo') && $request->check_izquierdo === 'on') {
                    $definicion[] = 'izquierdo';
                }

                if ($request->filled('check_derecho') && $request->check_derecho === 'on') {
                    $definicion[] = 'derecho';
                }

                if ($request->filled('check_trasero') && $request->check_trasero === 'on') {
                    $definicion[] = 'trasero';
                }

                if ($request->filled('check_delantero') && $request->check_delantero === 'on') {
                    $definicion[] = 'delantero';
                }

                $nuevoRepuesto = $request->cantidad . ' ' . $request->repuesto;

                if (!empty($definicion)) {
                    $nuevoRepuesto .= ' ' . implode(', ', $definicion);
                }

                $solicitud->repuesto = json_encode($nuevoRepuesto);
            } else {
                $solicitud->repuesto = $request->json_repuestos;
            }
        }


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
                return redirect()->back()->withErrors(['img_repuesto' => 'No puedes subir más de 3 imágenes'])->with('error', '¡Error! ¡No se pudo enviar la solicitud!, Revise sus datos y envie nuevamente')->withInput();
            }
        } else {
            $solicitud->img_repuesto = json_encode(['No se subió ningun archivo']);
        }

        $request->comentario = $request->comentario ?? 'No hay comentarios';
        $solicitud->comentario = $request->comentario ?? 'No hay comentarios';
        $solicitud->nombre = $request->nombre;
        if($request->has('email') && $request->filled('email')){
            $solicitud->correo = $request->email;
        }else{
            $solicitud->correo = null;
        }

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
            $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
            $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';
            $admin = User::where('role', 'Admin')->first();
            $celular = $admin->cel;

            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $celular,
                'type' => 'template',
                'template' => [
                    'name' => 'errors_reports',
                    'language' => [
                        'code' => 'es',
                    ],
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => 'https://turepuestoya.co/formulario-cliente',
                                ],
                                [
                                    'type' => 'text',
                                    'text' => 'Error al enviar una solicitud. ' . $e->getMessage(),
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

            return redirect()->back()->withErrors($validator)
                ->withInput()->with('error', 'Error al guardar los datos: ' . $e->getMessage());
        }

        //Enviar comfirmacion al cliente de que su pedido ha sido recibido
        try {
            $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
            $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';

            $numeroC = $request->codigo_cel . $request->cel;
            $nombre_cliente = $request->nombre;

            $telefono = $numeroC;

            $new_message = new message();
            $new_message->celular = '+573053238666';
            $new_message->mensaje = '*HOLA '. $nombre_cliente .'*👋

¡Gracias por hacer tu solicitud en *TU REPUESTO YA!* 🛒

Vas a recibir cotizaciones de diferentes proveedores. Tendrás la libertad de elegir.

*No olvides revisar tus mensajes* 📥

Si tienes alguna pregunta o necesitas asistencia adicional, comunícate con nuestro equipo de soporte 📲

http://bit.ly/3NWN2Sr

*¡Estamos aquí para ayudarte!* 🙌

Saludos,
⚙ *TU REPUESTO YA* ⚙';
            $new_message->tipo = 'enviado';
            $new_message->enviado_a = $telefono;
            $new_message->save();

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

            $proveedores = Provider::all()->where('estado', 1);

            if (is_array($categoriasEncontradas) && in_array('No sé', $categoriasEncontradas)) {
                $message = 'No se encuentran todas las categorias para los repuestos';
                $user = User::where('role', 'Admin')->first();
                $celular = $user->cel;

                $repuesto = is_array($solicitud->repuesto) ? implode(',', $solicitud->repuesto) : $solicitud->repuesto;
                $repuesto = str_replace(array("[", "]", "\"", ","), array("", "", "", ", "), $repuesto);

                $new_message = new message();
                $new_message->celular = '+573053238666';
                $new_message->mensaje = $message . ': ' . $repuesto;
                $new_message->tipo = 'enviado';
                $new_message->enviado_a = $celular;
                $new_message->save();

                $mensajeData = [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'to' => $celular,
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
                                        'text' => $message,
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $repuesto,
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $request->marca,
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $request->referencia,
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $request->modelo,
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $request->comentario,
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $request->nombre,
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $solicitud->pais,
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $request->departamento,
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => $request->municipio,
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
            } else {
                foreach ($proveedores as $proveedor) {
                    $jsonMarcasGuardadas = $proveedor->marcas_preferencias;
                    $jsonCategoriasGuardadas = $proveedor->especialidad;

                    // Decodificar el JSON a un array asociativo
                    $marcasGuardadasArray = json_decode($jsonMarcasGuardadas, true);
                    $categoriasGuardadasArray = json_decode($jsonCategoriasGuardadas, true);

                    // Obtener la marca del carro del cliente (ajusta según tu lógica, por ejemplo, mediante un formulario)
                    $marcaCliente = $solicitud->marca;
                    $categoriaRepuesto = $categoriasEncontradas;

                    if (is_array($marcasGuardadasArray) && is_array($categoriasGuardadasArray)) {
                        if ((in_array($marcaCliente, $marcasGuardadasArray) || in_array('Todas las marcas', $marcasGuardadasArray) || in_array($request->marca_otro, $marcasGuardadasArray)) && (array_intersect($categoriaRepuesto, $categoriasGuardadasArray) || in_array('Todas las especialidades', $categoriasGuardadasArray))) {
                            $celular = $proveedor->celular;
                            $telefono = $proveedor->telefono;

                            // Despachar un trabajo para enviar el mensaje de WhatsApp a los proveedores
                            if ($celular) {
                                WhatsAppMessageJob::dispatch(
                                    $proveedor,
                                    $celular,
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
                                WhatsAppMessageJob::dispatch(
                                    $proveedor,
                                    $telefono,
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

                            $data = [
                                'repuesto' => $request->json_repuestos,
                                'marca' => $request->marca,
                                'referencia' => $request->referencia,
                                'modelo' => $request->modelo,
                                'comentarios' => $request->comentario,
                                'nombre' => $request->nombre,
                                'pais' => $solicitud->pais,
                                'departamento' => $request->departamento,
                                'municipio' => $request->municipio,
                                'codigo' => $solicitud->codigo
                            ];

                            if ($proveedor->email || $proveedor->email_secundario) {
                                Mail::to($proveedor->email)->cc($proveedor->email_secundario)->queue(new SolicitudRepuestoMail($data));
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
            $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';
            $admin = User::where('role', 'Admin')->first();
            $celular = $admin->cel;

            $new_message = new message();
            $new_message->celular = '+573053238666';
            $new_message->mensaje = 'Error al enviar una solicitud. ' . $e->getMessage();
            $new_message->tipo = 'enviado';
            $new_message->enviado_a = $celular;
            $new_message->save();

            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $celular,
                'type' => 'template',
                'template' => [
                    'name' => 'errors_reports',
                    'language' => [
                        'code' => 'es',
                    ],
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => 'https://turepuestoya.co/formulario-cliente',
                                ],
                                [
                                    'type' => 'text',
                                    'text' => 'Error al enviar una solicitud. ' . $e->getMessage(),
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

            // Manejo de errores aquí
            Log::error('Error al enviar mensaje de WhatsApp: ' . $e->getMessage());
        }
        // Notificar al administrador
        $admin = User::where('role', 'Proveedor')->get();

          if ($admin) {
            Notification::send($admin, new NuevaSolicitudRepuesto($solicitud));
        }

        if ($solicitud->correo) {
            Mail::to($solicitud->correo)->queue(new SolicitudClienteMail($solicitud->nombre));
        }

        return redirect()->route('graciasView');
    }

    public function graciasView(): view
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
        return view("gracias", compact('name', 'departamentos', 'group', 'codigos'));
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

    public function storeDP(Request $request, $codigo): redirectResponse
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nit' => 'required|numeric|digits_between:8,16',
            'json_repuestos' => 'required',
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
                ->with('error', '¡No se pudo enviar! Seleccione un repuesto o llene todos los campos');
        }

        // Obtener el proveedor y verificar si existe
        $nit = $request->input('nit');
        $proveedor = Provider::where('nit_empresa', $nit)->first();

        if (!$proveedor) {
            return redirect()->back()->withInput()->with('error', 'El nit ingresado no existe');
        } else {
            if (!$proveedor->estado) {
                return redirect()->back()->withInput()->with('error', 'Actualmente su cuenta se encuentra inactiva');
            }
        }

        // Obtener la solicitud y verificar si existe
        $solicitud = Solicitude::where('codigo', $codigo)->first();

        if (!$solicitud) {
            return redirect()->route('servicios')->with('error', '¡UPS! ¡Lo siento, has llegado tarde!<br/> El sistema toma las 5 primeras cotizaciones. Te esperamos en una próxima.');
        }

        // Verificar si el proveedor ya ha respondido a esta solicitud
        $respuestaExistente = Answer::where('idProveedor', $proveedor->id)
            ->where('idSolicitud', $solicitud->id)
            ->exists();

        if ($respuestaExistente) {
            return redirect()->back()->withInput()->with('error', 'Ya has respondido a esta solicitud previamente');
        }

        $tieneRespuestas = Answer::where('idProveedor', $proveedor->id)->exists();
        if($tieneRespuestas){
            $proveedor->ha_cotizado = true;
            $proveedor->save();
        }else{
            $proveedor->ha_cotizado = false;
            $proveedor->save();
        }

        // Crear una nueva respuesta
        $answer = new Answer();
        $answer->idSolicitud = $solicitud->id;
        $answer->idProveedor = $proveedor->id;
        $repuestos = $request->json_repuestos;
        $answer->repuesto = $repuestos;
        $preciosArray = $request->precio;

        // Agrega el símbolo a cada elemento del array
        $preciosConSimbolo = array_map(function ($precio) {
            return "$" . $precio;
        }, $preciosArray);

        $json_answer = [];

        for ($i = 0; $i < count($preciosArray); $i++) {

            if($request->has('tiempo_entrega') && $request->filled('tiempo_entrega')){
                if($request->has('descripcion') && $request->filled('descripcion')){
                    $json_answer['r' . ($i + 1)] = [
                        'requerimiento' => $repuestos[$i],
                        'precio' => $preciosArray[$i], 
                        'tipo_repuesto' => $request->tipo_repuesto[$i], 
                        'tiempo_entrega' => $request->tiempo_entrega[$i],
                        'descripcion' => $request->descripcion[$i]
                    ];
                }else{
                    $json_answer['r' . ($i + 1)] = [
                        'requerimiento' => $repuestos[$i],
                        'precio' => $preciosArray[$i], 
                        'tipo_repuesto' => $request->tipo_repuesto[$i], 
                        'tiempo_entrega' => $request->tiempo_entrega[$i]
                    ];
                }
                
            }else{
                if($request->has('descripcion') && $request->filled('descripcion')){
                    $json_answer['r' . ($i + 1)] = [
                        'requerimiento' => $repuestos[$i], 
                        'precio' => $preciosArray[$i], 
                        'tipo_repuesto' => $request->tipo_repuesto[$i],
                        'descripcion' => $request->descripcion[$i]
                    ];
                }else{
                    $json_answer['r' . ($i + 1)] = [
                        'requerimiento' => $repuestos[$i], 
                        'precio' => $preciosArray[$i], 
                        'tipo_repuesto' => $request->tipo_repuesto[$i]
                    ];
                }
            }
            
        }
        
        // Guarda el array con símbolos en formato JSON
        $answer->precio = json_encode($json_answer);

        if ($request->comentarioP) {
            $answer->comentarios = 'Además, el proveedor ha compartido algunos comentarios: \n "*_' . $request->comentarioP . '_*"';
        } else {
            $answer->comentarios = '"No hay comentarios"';
        }
        $answer->save();

        // Verificar si la solicitud está cerrada o si ya ha alcanzado el límite de respuestas
        // if (!$solicitud->estado || $solicitud->respuestas >= 5) {
        //     $solicitud->codigo = null;
        //     $solicitud->estado = false;
        //     $solicitud->save();
        //     return redirect()->route('servicios')->with('error', '¡UPS! ¡Lo siento, has llegado tarde!<br/> El sistema toma las 5 primeras cotizaciones. Te esperamos en una próxima.');
        // } else {
        //     // Guardar la respuesta y verificar si se ha guardado correctamente
        //     if ($answer->save()) {
        //         // Incrementar el contador de respuestas de la solicitud
        //         $solicitud->respuestas += 1;
        //         $solicitud->save();
        //     } else {
        //         // Manejar el caso en que la respuesta no se haya guardado correctamente
        //         return redirect()->back()->with('error', 'Hubo un error al guardar la respuesta.');
        //     }
        // }

        // Verificar el estado de la solicitud
        if ($answer->save()) {
            $solicitud->respuestas = $solicitud->respuestas + 1;
            $solicitud->save();
        }

        // Enviar datos al cliente
        $nombre_cliente = $solicitud->nombre;
        $almacen = $proveedor->razon_social;
        $pais = $proveedor->pais;
        $ciudad = $proveedor->municipio;
        $comentarios = $answer->comentarios;
        $numero_celular = $proveedor->celular;
                $numero_celular2 = 'No tiene';
        if($proveedor->telefono){
            $numero_celular2 = $proveedor->telefono;
        }

        $repuesto = json_decode($answer->repuesto, true);
        $precio = json_decode($answer->precio, true);
        // $garantia = json_decode($answer->garantia, true);
        // $tipo_repuesto = json_decode($answer->tipo_repuesto, true);

        $token = env('TOKEN_VERIFICATION_API');
        $url = env('URL_API_WHATSAPP');
        $telefono = $solicitud->numero;

        if (count(json_decode($answer->repuesto)) == 1) {
            $new_message = new message();
            $new_message->celular = '+573053238666';
            $new_message->mensaje = '*¡'. $nombre_cliente .'!*

            Te llegó la *cotización N°'.$solicitud->respuestas.'* de parte de uno de nuestros proveedores, por favor revísala y ponte en contacto con el proveedor.

            Aquí tienes todos los detalles:

            📝 *REPUESTO:*
            *-Repuesto:* '. $repuesto[0] .' 🔩
            *-Precio:* ' . $precio[0] . ' (COP)

            📍 *INFORMACIÓN DEL PROVEEDOR:*
            *-Nombre:* '. $almacen .'
            *-País:* '.$pais.'
            *-Ciudad:* '.$ciudad.'
            *-Número 1:* '.$numero_celular.' 📞
            *-Número 2:* '.$numero_celular2.' 📞

            '.$comentarios.'

            Recuerda contactar al proveedor para aclarar dudas o realizar la compra de *Tu Repuesto*.

            Estamos aquí para ayudarte en todo momento.';
            $new_message->tipo = 'enviado';
            $new_message->enviado_a = $telefono;
            $new_message->save();

            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $telefono,
                'type' => 'template',
                'template' => [
                    'name' => 'respuesta_proveedor1',
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
                                    'text' => $solicitud->respuestas,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[0],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[0],
                                ],
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
                                    'text' => $numero_celular2,
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
        } else if (count(json_decode($answer->repuesto)) == 2) {
            $new_message = new message();
            $new_message->celular = '+573053238666';
            $new_message->mensaje = '*¡'. $nombre_cliente .'!*

            Te llegó la *cotización N°'.$solicitud->respuestas.'* de parte de uno de nuestros proveedores, por favor revísala y ponte en contacto con el proveedor.

            Aquí tienes todos los detalles:

            📝 *REPUESTO 1:*
            *-Repuesto:* '. $repuesto[0] .' 🔩
            *-Precio:* ' . $precio[0] . ' (COP)

            📝 *REPUESTO 2:*
            *-Repuesto:* '. $repuesto[1] .' 🔩
            *-Precio:* ' . $precio[1] . ' (COP)

            📍 *INFORMACIÓN DEL PROVEEDOR:*
            *-Nombre:* '. $almacen .'
            *-País:* '.$pais.'
            *-Ciudad:* '.$ciudad.'
            *-Número 1:* '.$numero_celular.' 📞
            *-Número 2:* '.$numero_celular2.' 📞

            '.$comentarios.'

            Recuerda contactar al proveedor para aclarar dudas o realizar la compra de *Tu Repuesto*.

            Estamos aquí para ayudarte en todo momento.';
            $new_message->tipo = 'enviado';
            $new_message->enviado_a = $telefono;
            $new_message->save();
            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $telefono,
                'type' => 'template',
                'template' => [
                    'name' => 'respuesta_proveedor2',
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
                                    'text' => $solicitud->respuestas,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[0],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[0],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[1],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[1],
                                ],
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
                                    'text' => $numero_celular2,
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
        } else if (count(json_decode($answer->repuesto)) == 3) {
            $new_message = new message();
            $new_message->celular = '+573053238666';
            $new_message->mensaje = '*¡'. $nombre_cliente .'!*

            Te llegó la *cotización N°'.$solicitud->respuestas.'* de parte de uno de nuestros proveedores, por favor revísala y ponte en contacto con el proveedor.

            Aquí tienes todos los detalles:

            📝 *REPUESTO 1:*
            *-Repuesto:* '. $repuesto[0] .' 🔩
            *-Precio:* ' . $precio[0] . ' (COP)

            📝 *REPUESTO 2:*
            *-Repuesto:* '. $repuesto[1] .' 🔩
            *-Precio:* ' . $precio[1] . ' (COP)

            📝 *REPUESTO 3:*
            *-Repuesto:* '. $repuesto[2] .' 🔩
            *-Precio:* ' . $precio[2] . ' (COP)

            📍 *INFORMACIÓN DEL PROVEEDOR:*
            *-Nombre:* '. $almacen .'
            *-País:* '.$pais.'
            *-Ciudad:* '.$ciudad.'
            *-Número 1:* '.$numero_celular.' 📞
            *-Número 2:* '.$numero_celular2.' 📞

            '.$comentarios.'

            Recuerda contactar al proveedor para aclarar dudas o realizar la compra de *Tu Repuesto*.

            Estamos aquí para ayudarte en todo momento.';
            $new_message->tipo = 'enviado';
            $new_message->enviado_a = $telefono;
            $new_message->save();
            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $telefono,
                'type' => 'template',
                'template' => [
                    'name' => 'respuesta_proveedor3',
                    'language' => [
                        'code' => 'es',
                    ],
                    'components' => [
                        // [
                        //     'type' => 'header',
                        //     'parameters' => [
                        //         [
                        //             'type' => 'image',
                        //             'image' => [
                        //                 'link' => 'https://turepuestoya.co/public/profile/' . $proveedor->id,
                        //             ]
                        //         ],
                        //     ],
                        // ],
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => $nombre_cliente,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $solicitud->respuestas,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[0],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[0],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[1],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[1],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[2],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[2],
                                ],
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
                                    'text' => $numero_celular2,
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
        } else if (count(json_decode($answer->repuesto)) == 4) {
            $new_message = new message();
            $new_message->celular = '+573053238666';
            $new_message->mensaje = '*¡'. $nombre_cliente .'!*

            Te llegó la *cotización N°'.$solicitud->respuestas.'* de parte de uno de nuestros proveedores, por favor revísala y ponte en contacto con el proveedor.

            Aquí tienes todos los detalles:

            📝 *REPUESTO 1:*
            *-Repuesto:* '. $repuesto[0] .' 🔩
            *-Precio:* ' . $precio[0] . ' (COP)

            📝 *REPUESTO 2:*
            *-Repuesto:* '. $repuesto[1] .' 🔩
            *-Precio:* ' . $precio[1] . ' (COP)

            📝 *REPUESTO 3:*
            *-Repuesto:* '. $repuesto[2] .' 🔩
            *-Precio:* ' . $precio[2] . ' (COP)

            📝 *REPUESTO 4:*
            *-Repuesto:* '. $repuesto[3] .' 🔩
            *-Precio:* ' . $precio[3] . ' (COP)

            📍 *INFORMACIÓN DEL PROVEEDOR:*
            *-Nombre:* '. $almacen .'
            *-País:* '.$pais.'
            *-Ciudad:* '.$ciudad.'
            *-Número 1:* '.$numero_celular.' 📞
            *-Número 2:* '.$numero_celular2.' 📞

            '.$comentarios.'

            Recuerda contactar al proveedor para aclarar dudas o realizar la compra de *Tu Repuesto*.

            Estamos aquí para ayudarte en todo momento.';
            $new_message->tipo = 'enviado';
            $new_message->enviado_a = $telefono;
            $new_message->save();
            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $telefono,
                'type' => 'template',
                'template' => [
                    'name' => 'respuesta_proveedor4',
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
                                    'text' => $solicitud->respuestas,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[0],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[0],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[1],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[1],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[2],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[2],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[3],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[3],
                                ],
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
                                    'text' => $numero_celular2,
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
        } else if (count(json_decode($answer->repuesto)) == 5) {
            $new_message = new message();
            $new_message->celular = '+573053238666';
            $new_message->mensaje = '*¡'. $nombre_cliente .'!*

            Te llegó la *cotización N°'.$solicitud->respuestas.'* de parte de uno de nuestros proveedores, por favor revísala y ponte en contacto con el proveedor.

            Aquí tienes todos los detalles:

            📝 *REPUESTO 1:*
            *-Repuesto:* '. $repuesto[0] .' 🔩
            *-Precio:* ' . $precio[0] . ' (COP)

            📝 *REPUESTO 2:*
            *-Repuesto:* '. $repuesto[1] .' 🔩
            *-Precio:* ' . $precio[1] . ' (COP)

            📝 *REPUESTO 3:*
            *-Repuesto:* '. $repuesto[2] .' 🔩
            *-Precio:* ' . $precio[2] . ' (COP)

            📝 *REPUESTO 4:*
            *-Repuesto:* '. $repuesto[3] .' 🔩
            *-Precio:* ' . $precio[3] . ' (COP)

            📝 *REPUESTO 5:*
            *-Repuesto:* '. $repuesto[4] .' 🔩
            *-Precio:* ' . $precio[4] . ' (COP)

            📍 *INFORMACIÓN DEL PROVEEDOR:*
            *-Nombre:* '. $almacen .'
            *-País:* '.$pais.'
            *-Ciudad:* '.$ciudad.'
            *-Número 1:* '.$numero_celular.' 📞
            *-Número 2:* '.$numero_celular2.' 📞

            '.$comentarios.'

            Recuerda contactar al proveedor para aclarar dudas o realizar la compra de *Tu Repuesto*.

            Estamos aquí para ayudarte en todo momento.';
            $new_message->tipo = 'enviado';
            $new_message->enviado_a = $telefono;
            $new_message->save();
            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $telefono,
                'type' => 'template',
                'template' => [
                    'name' => 'respuesta_proveedor5',
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
                                    'text' => $solicitud->respuestas,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[0],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[0],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[1],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[1],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[2],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[2],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[3],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[3],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $repuesto[4],
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $precio[4],
                                ],
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
                                    'text' => $numero_celular2,
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

        if (auth()->check()) {
            return redirect()->route('viewSolicitudes')->with('message', 'La respuesta se ha enviado exitosamente');
        }
        return redirect()->route('servicios')->with('message', 'La respuesta se ha enviado exitosamente');
    }

    public function eliminarImagenes(int $solicitudId)
    {
        // Obtener las imágenes de la solicitud
        $solicitudes = Solicitude::find($solicitudId);

        $imagenes = json_decode($solicitudes->img_repuesto);

        // Eliminar las imágenes del servidor
        foreach ($imagenes as $imagen) {
            Storage::delete('public/' . $imagen);
        }
    }
}
