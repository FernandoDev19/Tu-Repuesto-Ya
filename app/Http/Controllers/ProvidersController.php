<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

//Modelos
use App\Models\User;
use App\Models\Provider;
use App\Models\Country_code;
use App\Models\Geolocation;
use App\Models\Session_log;
use App\Models\Activity_log;
use App\Models\Answer;
use App\Models\Category;

//Exportar
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProveedorExport;

use Carbon\Carbon;

class ProvidersController extends Controller
{
    public function index(Request $request): view
    {
        // Nombre del usuario
        $name = auth()->user()->name;

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        // Lista de codigos celulares
        $codigos = Country_code::all();

        $tieneRespuesta = Answer::all();
        $sesion = Session_log::all();

        $estado = null;
        $session = null;
        $cotizado = null;
        $paginacion = 15;

        if ($request->paginacion) {
            $paginacion = $request->paginacion;
        }

        if (strtolower($request->search) == 'estado 1') {
            $estado = true;
        } else if (strtolower($request->search) == 'estado 0') {
            $estado = false;
        }

        if (strtolower($request->search) == 'sesion 1') {
            $session = true;
        } else if (strtolower($request->search) == 'sesion 0') {
            $session = false;
        }

        if (strtolower($request->search) == 'ha cotizado 1') {
            $cotizado = true;
        } else if (strtolower($request->search) == 'ha cotizado 0') {
            $cotizado = false;
        }
        $proveedor = Provider::where('estado', $estado)
            ->orWhere('sesion', $session)
            ->orWhere('ha_cotizado', $cotizado)
            ->orWhere('nit_empresa', 'like', '%' . $request->search . '%')
            ->orWhere('razon_social', 'like', '%' . $request->search . '%')
            ->orWhere('pais', 'like', '%' . $request->search . '%')
            ->orWhere('departamento', 'like', '%' . $request->search . '%')
            ->orWhere('municipio', 'like', '%' . $request->search . '%')
            ->orWhere('direccion', 'like', '%' . $request->search . '%')
            ->orWhere('celular', 'like', '%' . $request->search . '%')
            ->orWhere('telefono', 'like', '%' . $request->search . '%')
            ->orWhere('representante_legal', 'like', '%' . $request->search . '%')
            ->orWhere('contacto_principal', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%')
            ->orWhere('email_secundario', 'like', '%' . $request->search . '%')
            ->orWhereJsonContains('marcas_preferencias', ucfirst($request->search))
            ->orWhere('especialidad', 'like', '%' . $request->search . '%')
            ->latest()
            ->paginate($paginacion)
            ->withQueryString();

        $proveedores_all = Provider::all();
        $preferencias_de_marcas = [];

        foreach ($proveedores_all as $proveedor_m) {
            if (is_string($proveedor_m->marcas_preferencias)) {
                $preferencias_de_marcas[$proveedor_m->id] = json_decode($proveedor_m->marcas_preferencias, true);
            }
        }

        foreach ($proveedores_all as $provider) {
            $sesions = $sesion->where('idProveedor', $provider->id)->first();
            if ($sesions) {
                if ($sesions->sesiones > 0) {
                    $provider->sesion = true;
                    $provider->save();
                } else {
                    $provider->sesion = false;
                    $provider->save();
                }
            }
        }

        foreach ($proveedores_all as $provider) {
            $tieneRespuestas = $tieneRespuesta->where('idProveedor', $provider->id)->first();
            if ($tieneRespuestas) {
                $provider->ha_cotizado = true;
                $provider->save();
            } else {
                $provider->ha_cotizado = false;
                $provider->save();
            }
        }

        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');

        // Lista de municipios
        $group = [];

        foreach ($departamentos as $departamento) {
            $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
            $group[$departamento] = $municipios;
        }

        $categorias = Category::where('nombre_categoria', '!=', 'Prueba')->get();

        // Retorna la vista de la lista de proveedores, usando compact para enviar los datos a la vista
        return view('admin.providers', compact('proveedor', 'proveedor_m', 'proveedores_all', 'preferencias_de_marcas', 'departamentos', 'group', 'codigos', 'categorias', 'tieneRespuesta', 'sesion', 'paginacion'));
    }

    public function show($nit, $notificationId)
    {
        // Lista de codigos celulares
        $codigos = Country_code::all();

        // Nombre del usuario
        $name = auth()->user()->name;

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        if ($nit) {
            $proveedores = Provider::where('nit_empresa', $nit)->first();

            $proveedor = Provider::all();
            $preferencias_de_marcas = [];
            $especialidades = [];

            foreach ($proveedor as $proveedor_m) {
                if (is_string($proveedor_m->marcas_preferencias) && is_string($proveedor_m->especialidad)) {
                    // Decodificar la cadena JSON y almacenar las preferencias en un array asociativo
                    $preferencias_de_marcas[$proveedor_m->id] = json_decode($proveedor_m->marcas_preferencias, true);
                    $especialidades[$proveedor_m->id] = json_decode($proveedor_m->especialidad, true);
                }
            }

            // Lista de departamentos
            $departamentos = Geolocation::distinct()->pluck('departamento');

            // Lista de municipios
            $group = [];

            foreach ($departamentos as $departamento) {
                $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
                $group[$departamento] = $municipios;
            }

            $notification = auth()->user()->unreadNotifications->find($notificationId);

            if ($notification) {
                $notification->markAsRead();
            } else {
                if ($proveedores) {
                    return redirect()->route('loadProviders')->with('message', 'Proveedor editado exitosamente');
                }
                return redirect()->route('loadProviders')->with('message', 'Proveedor eliminado exitosamente');
            }

            $categorias = Category::where('nombre_categoria', '!=', 'Prueba')->get();

            return view('admin.proveedorRegistrado', compact('name', 'ft', 'proveedores', 'preferencias_de_marcas', 'especialidades', 'departamentos', 'group', 'codigos', 'categorias'));
        } else {
            $notification = auth()->user()->unreadNotifications->find($notificationId);

            if ($notification) {
                $notification->markAsRead();
            }
            return redirect()->route('loadProviders')->with('error', 'El proveedor no existe o ha sido eliminado');
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nit_create' => 'required|numeric|digits_between:8,16',
                'nombre_comercial_create' => 'required',
                'razon_create' => 'required',
                'gerente_create' => 'required',
                'administrador_create' => 'required',
                'departamento_create' => 'required',
                'municipio_create' => 'required',
                'direccion_create' => 'required',
                'cel_create' => 'required|numeric',
                'email_create' => 'required|email',
                'rut_create' => 'nullable|file|mimes:pdf',
                'cam_create' => 'nullable|file|mimes:pdf',

            ]
        );

        $validator->after(function ($validator) use ($request) {
            $nit = $request->input('nit_create');

            $provider = Provider::where('nit_empresa', $nit)->first();

            if ($provider) {
                $validator->errors()->add('nit_create', 'Este NIT ya está registrado.');
            }
        });

        $validator->after(function ($validator) use ($request) {
            $nombre_comercial = $request->input('nombre_comercial_create');

            $existingProvider = Provider::where('nombre_comercial', $nombre_comercial)->first();

            if ($existingProvider) {
                $validator->errors()->add('nombre_comercial_create', 'El Nombre de Establecimiento ya está en uso.');
            }
        });

        $validator->after(function ($validator) use ($request) {
            $razon = $request->input('razon_create');

            $provider = Provider::where('razon_social', $razon)->first();

            if ($provider) {
                $validator->errors()->add('razon_create', 'Esta Razón Social ya está registrada.');
            }
        });

        $validator->after(function ($validator) use ($request) {
            $cel = $request->input('cel_create');

            $user = User::where('cel', $cel)->first();

            $provider = Provider::where('celular', $cel)->first();

            if ($user || $provider) {
                $validator->errors()->add('cel_create', 'Este número de contacto ya está registrado.');
            }
        });

        $validator->after(function ($validator) use ($request) {
            $email = $request->input('email_create');

            $user = User::where('email', $email)->first();

            $provider = Provider::where('email', $email)->first();

            if ($user || $provider) {
                $validator->errors()->add('email_create', 'Este correo electrónico ya está registrado.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Hubo un error, Revise nuevamente los datos');
        }

        // Crear un nuevo proveedor
        $proveedor = new Provider();
        $proveedor->nit_empresa = $request->nit_create;
        $proveedor->nombre_comercial = $request->nombre_comercial_create;
        $proveedor->razon_social = $request->razon_create;
        $proveedor->gerente = $request->gerente_create;
        $proveedor->administrador = $request->administrador_create;
        $proveedor->departamento = $request->departamento_create;
        $proveedor->municipio = $request->municipio_create;
        $proveedor->direccion = $request->direccion_create;

        if ($request->has('representante_legal_create')) {
            $proveedor->representante_legal = $request->representante_legal_create;
        }
        if ($request->has('contacto_principal_create')) {
            $proveedor->contacto_principal = $request->contacto_principal_create;
        }

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

        $proveedor->pais = $paises[$request->codigo_cel_create];
        $proveedor->celular = $request->codigo_cel_create . $request->cel_create;
        if ($request->has('tel_create') && $request->has('codigo_cel_create')) {
            $proveedor->telefono = $request->codigo_cel_create . $request->tel_create;
        }

        $proveedor->email = $request->email_create;
        if ($request->has('email_2_create')) {
            $proveedor->email_secundario = $request->email_2_create;
        }

        if ($request->input('json_marcas_create')) {
            $jsonMarcas = $request->json_marcas_create;
            $proveedor->marcas_preferencias = $jsonMarcas;
        }

        if ($request->input('json_categorias_create')) {
            $jsonCategorias = $request->json_categorias_create;
            $proveedor->especialidad = $jsonCategorias;
        }

        if ($request->has('estado_create')) {
            $proveedor->estado = $request->estado_create;
        } else {
            $proveedor->estado = 0;
        }

        // Obtener los archivos RUT y Cámara de Comercio
        $archivoRut = $request->file('rut_create');
        $archivoCam = $request->file('cam_create');

        // Guardar los archivos con nombres personalizados
        $nit = $proveedor->nit_empresa;

        if ($archivoRut) {
            $rutNombreActual = $proveedor->rut;
            if ($rutNombreActual) {
                Storage::delete('uploads/' . $rutNombreActual);
            }
            $nombreRutPersonalizado = 'RUT_' . $nit . '.pdf';
            $archivoRut->storeAs('uploads', $nombreRutPersonalizado);
            $proveedor->rut = $nombreRutPersonalizado;
        } else {
            $proveedor->rut = 'Pendiente';
        }

        if ($archivoCam) {
            $camNombreActual = $proveedor->cam;
            if ($camNombreActual) {
                Storage::delete('uploads/' . $camNombreActual);
            }
            $nombreCamPersonalizado = 'Camara_de_comercio_' . $nit . '.pdf';
            $archivoCam->storeAs('uploads', $nombreCamPersonalizado);
            $proveedor->camara_comercio = $nombreCamPersonalizado;
        } else {
            $proveedor->camara_comercio = 'Pendiente';
        }

        $proveedor->password = 'demo12345';

        // Guardar el proveedor en la base de datos
        try {
            $proveedor->save();

            $new_log = new Activity_log();
            $new_log->fecha = Carbon::now();
            if(auth()->check()){
                $new_log->usuario = auth()->user()->name;
            }else{
                $new_log->usuario = 'Desconocido';
            }
            $new_log->actividad = 'Registró un nuevo proveedor.';
            $new_log->descripcion = 'Se registró un nuevo proveedor (' . $proveedor->razon_social . ') desde el administrador';
            $new_log->navegador = request()->header('user-agent');
            $new_log->direccion_ip = request()->ip();
            $new_log->role = auth()->user()->role;

            try{
                $new_log->save();
            }catch(\exception $e){
                Log::error('Error al registrar la nueva actividad: ' . $e->getMessage());
            }

        } catch (\exception $e) {
            $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
            $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';
            $admin = auth()->user()->cel;

            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $admin,
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
                                    'text' => 'https://turepuestoya.co/administrador/proveedores',
                                ],
                                [
                                    'type' => 'text',
                                    'text' => 'Error al crear un nuevo proveedor desde el administrador. ' . $e->getMessage(),
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

            return redirect()->back()->withErrors($validator)->withInput()->with('error', '¡Ha ocurrido un error!' . $e->getMessage());
        }

        $newUser = new User();
        $newUser->name = $proveedor->razon_social;
        $newUser->cel = $proveedor->celular;

        $newUser->tel = $proveedor->telefono;
        $newUser->email = $proveedor->email;
        if ($request->has('email_2_create')) {
            $newUser->email_secundario = $proveedor->email_secundario;
        }
        $newUser->email_verified_at = Carbon::now();
        $newUser->password = 'demo12345';
        $newUser->role = 'Proveedor';
        $newUser->proveedor()->associate($proveedor);
        $newUser->assignRole('Proveedor');
        try {
            $newUser->save();
        } catch (\exception $e) {
            $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
            $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';
            $admin = auth()->user()->cel;

            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $admin,
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
                                    'text' => 'https://turepuestoya.co/administrador/proveedores',
                                ],
                                [
                                    'type' => 'text',
                                    'text' => 'Error al crear un nuevo proveedor desde el administrador. ' . $e->getMessage(),
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

            return redirect()->back()->withErrors($validator)->withInput()->with('error', '¡Ha ocurrido un error!' . $e->getMessage());
        }

        // Redirigir a la página de inicio con un mensaje de éxito
        return redirect()->back()->with('message', '¡Registro exitoso!');
    }

    public function update(Request $request): RedirectResponse
    {
        // Obtiene el id
        $id = $request->input('id');

        // Se busca al proveedor por el id obtenido
        $proveedor = Provider::find($id);

        // Validacion de datos a editar
        $validator = Validator::make(
            $request->all(),
            [
                'nit_edit' => 'nullable|numeric|digits_between:8,16',
                'nombre_comercial_edit' => 'nullable',
                'cel_edit' => 'nullable|numeric',
                'tel_edit' => 'nullable|numeric',
                'email_edit' => 'nullable|email',
                'email_2_edit' => 'nullable|email',
            ],
            [
                'cel_edit.numeric' => 'El campo celular debe ser un número.',
                'tel_edit.numeric' => 'El campo telefono debe ser un número.',
            ]
        );

        // Valida si el valor agregado en el campo ya existe en la base de datos
        $validator->after(function ($validator) use ($request, $id) {
            $nit = $request->nit_edit;
            $providerId = $id;
            $existingProvider = Provider::where('nit_empresa', $nit)->where('id', '!=', $providerId)->first();

            if ($existingProvider) {
                $validator->errors()->add('nit_edit', 'Este NIT ya está en uso.');
            }
        });


        // Valida si el valor agregado en el campo ya existe en la base de datos
        $validator->after(function ($validator) use ($request, $id) {
            $cel = $request->cel_edit;
            $providerId = $id;
            $existingUser = User::where('cel', $cel)->where('proveedor_id', '!=', $providerId)->first();
            $existingProvider = Provider::where('celular', $cel)->where('id', '!=', $providerId)->first();

            if ($existingUser || $existingProvider) {
                $validator->errors()->add('cel_edit', 'Este número de celular ya está en uso.');
            }
        });

        if ($request->has('tel_edit') && $request->filled('tel_edit')) {
            $validator->after(function ($validator) use ($request, $id) {
                $tel = $request->tel_edit;
                $providerId = $id;

                $existingUser = User::where('tel', $tel)->where('proveedor_id', '!=', $providerId)->where('tel', '!=', "")->first();
                $existingProvider = Provider::where('telefono', $tel)->where('id', '!=', $providerId)->where('telefono', '!=', "")->first();

                if ($existingUser || $existingProvider) {
                    $validator->errors()->add('tel_edit', 'Este número de celular ya está en uso');
                }
            });
        }

        if ($request->has('nombre_comercial_edit' && $request->filled('nombre_comercial_edit'))) {
            $validator->after(function ($validator) use ($request, $id) {
                $nombre_comercial = $request->input('nombre_comercial_edit');
                $providerId = $id;
                $existingProvider = Provider::where('nombre_comercial', $nombre_comercial)->where('id', '!=', $providerId)->where('nombre_comercial', '!=', '')->first();

                if ($existingProvider) {
                    $validator->errors()->add('nombre_comercial_edit', 'Esta Nombre de Establecimiento ya está en uso.');
                }
            });
        }

        $validator->after(function ($validator) use ($request, $id) {
            $razon = $request->input('razon_social_edit');
            $providerId = $id;
            $existingProvider = Provider::where('razon_social', $razon)->where('id', '!=', $providerId)->first();

            if ($existingProvider) {
                $validator->errors()->add('razon_social_edit', 'Esta razón social ya está en uso.');
            }
        });

        $validator->after(function ($validator) use ($request, $id) {
            $email = $request->input('email_edit');
            $providerId = $id;
            $existingUser = User::where('email', $email)->where('proveedor_id', '!=', $providerId)->first();
            $existingProvider = Provider::where('email', $email)->where('id', '!=', $providerId)->first();

            if ($existingUser || $existingProvider) {
                $validator->errors()->add('email_edit', 'El correo electrónico ingresado se encuentra en uso.');
            }
        });

        if ($request->has('email_2_edit') && $request->filled('email_2_edit')) {
            $validator->after(function ($validator) use ($request, $id) {
                $email2 = $request->input('email_2_edit');
                $providerId = $id;

                $existingProvider = Provider::where('email_secundario', $email2)->where('id', '!=', $providerId)->first();

                if ($existingProvider) {
                    $validator->errors()->add('email_2_edit', 'El correo electrónico ingresado se encuentra en uso.');
                }
            });
        }

        // Si hay algun fallo, retorna la misma vista pero con los errores y un mensaje de error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', "¡No se pudieron actualizar los datos del proveedor $proveedor->razon_social! Revise nuevamente");
        }

        // Cambia los datos que se encuentran en la base de datos, solo si hay algo escrito en el campo
        if ($request->has('nit_edit') && $request->filled('nit_edit')) {
            $proveedor->nit_empresa = $request->input('nit_edit');
        }

        if ($request->has('nombre_comercial_edit') && $request->filled('nombre_comercial_edit')) {
            $proveedor->nombre_comercial = $request->nombre_comercial_edit;
        }

        if ($request->has('razon_social_edit') && $request->filled('razon_social_edit')) {
            $proveedor->razon_social = $request->input('razon_social_edit');
        }

        if ($request->has('gerente_edit') && $request->filled('gerente_edit')) {
            $proveedor->gerente = $request->gerente_edit;
        }

        if ($request->has('administrador_edit') && $request->filled('administrador_edit')) {
            $proveedor->administrador = $request->administrador_edit;
        }

        if ($request->has('ciudad_edit') && $request->filled('ciudad_edit')) {
            $proveedor->municipio = $request->input('ciudad_edit');
        }

        if ($request->has('departamento_edit') && $request->filled('departamento_edit')) {
            $proveedor->departamento = $request->input('departamento_edit');
        }

        if ($request->has('municipio_edit') && $request->filled('municipio_edit')) {
            $proveedor->municipio = $request->input('municipio_edit');
        }

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

        $proveedor->pais = $paises[$request->codigo_cel];

        if ($request->has('direccion_edit') && $request->filled('direccion_edit')) {
            $proveedor->direccion = $request->input('direccion_edit');
        }

        if ($request->has('cel_edit') && $request->filled('cel_edit')) {
            $proveedor->celular = $request->codigo_cel . $request->cel_edit;
        }

        if ($request->has('tel_edit') && $request->filled('tel_edit')) {
            $proveedor->telefono = $request->codigo_cel . $request->input('tel_edit');
        }

        if ($request->has('representante_legal') && $request->filled('representante_legal')) {
            $proveedor->representante_legal = $request->input('representante_legal');
        }

        if ($request->has('contacto_principal') && $request->filled('contacto_principal')) {
            $proveedor->contacto_principal = $request->input('contacto_principal');
        }

        if ($request->has('email_edit') && $request->filled('email_edit')) {
            $proveedor->email = $request->input('email_edit');
        }

        if ($request->has('email_2_edit') && $request->filled('email_2_edit')) {
            $proveedor->email_secundario = $request->input('email_2_edit');
        }

        if ($request->has('estado_edit') && $request->filled('estado_edit')) {
            $proveedor->estado = $request->input('estado_edit');
        }

        if ($request->json_marcas) {
            $cleanedMarcas = str_replace(["×", "\n", "\r"], "", $request->json_marcas);
            $proveedor->marcas_preferencias = $cleanedMarcas;
        }

        if ($request->json_categorias) {
            $cleanedCategorias = str_replace(["×", "\n", "\r"], "", $request->json_categorias);
            $proveedor->especialidad = $cleanedCategorias;
        }

        if ($request->has('observaciones') && $request->filled('observaciones')) {
            $proveedor->observaciones = $request->input('observaciones');
        }


        // Obtener los archivos RUT y Cámara de Comercio
        $archivoRut = $request->file('rut');
        $archivoCam = $request->file('cam');

        // Guardar los archivos con nombres personalizados
        $nit = $proveedor->nit_empresa;

        if ($archivoRut) {
            $rutNombreActual = $proveedor->rut;
            if ($rutNombreActual) {
                Storage::delete('uploads/' . $rutNombreActual);
            }
            $nombreRutPersonalizado = 'RUT_' . $nit . '.pdf';
            $archivoRut->storeAs('uploads', $nombreRutPersonalizado);
            $proveedor->rut = $nombreRutPersonalizado;
        }

        if ($archivoCam) {
            $camNombreActual = $proveedor->cam;
            if ($camNombreActual) {
                Storage::delete('uploads/' . $camNombreActual);
            }
            $nombreCamPersonalizado = 'Camara_de_comercio_' . $nit . '.pdf';
            $archivoCam->storeAs('uploads', $nombreCamPersonalizado);
            $proveedor->camara_comercio = $nombreCamPersonalizado;
        }

        // Guardar el proveedor en la base de datos
        try {
            $proveedor->save();

            $new_log = new Activity_log();
            $new_log->fecha = Carbon::now();
            if (auth()->check()) {
                $new_log->usuario = auth()->user()->name;
            } else {
                $new_log->usuario = 'Desconocido';
            }
            $new_log->actividad = 'Editó a un proveedor.';
            $new_log->descripcion = 'Se editó al proveedor ' . $proveedor->razon_social . ' desde el administrador';
            $new_log->navegador = request()->header('user-agent');
            $new_log->direccion_ip = request()->ip();
            $new_log->role = auth()->user()->role;

            try {
                $new_log->save();
            } catch (\exception $e) {
                Log::error('Error al registrar la nueva actividad: ' . $e->getMessage());
            }
        } catch (\exception $e) {
            $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
            $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';
            $admin = auth()->user()->cel;

            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $admin,
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
                                    'text' => 'https://turepuestoya.co/administrador/proveedores',
                                ],
                                [
                                    'type' => 'text',
                                    'text' => 'Error al editar al proveedor ' . $proveedor->razon_social . ' desde el administrador. ' . $e->getMessage(),
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

            return redirect()->back()->withErrors($validator)->withInput()->with('error', '¡Ha ocurrido un error!' . $e->getMessage());
        }

        // Obtiene el usuario por id
        $user = User::where('proveedor_id', $id)->first();

        // si el usuario existe se hacen las condicionales if, identicas a las condicionales anteriores
        if ($user) {
            if ($request->has('razon_social_edit') && $request->filled('razon_social_edit')) {
                $user->name = $request->input('razon_social_edit');
            }

            if ($request->has('cel_edit') && $request->filled('cel_edit')) {
                $user->cel = $request->codigo_cel . $request->cel_edit;
            }

            if ($request->has('tel_edit') && $request->filled('tel_edit')) {
                $user->tel = $request->input('tel_edit');
            }

            if ($request->has('email_edit') && $request->filled('email_edit')) {
                $user->email = $request->input('email_edit');
            }

            if ($request->has('email_2_edit') && $request->filled('email_2_edit')) {
                $user->email_secundario = $request->input('email_2_edit');
            }

            // Obtiene la hora actual
            $user->email_verified_at = Carbon::now();
            $user->save();
        } else {
            //Crear usuario para el proveedor
            $longitudCodigo = 11;
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $codigo = '';

            for ($i = 0; $i < $longitudCodigo; $i++) {
                $indice = rand(0, strlen($caracteres) - 1);
                $codigo .= $caracteres[$indice];
            }

            $newUser = new User();
            $newUser->name = $proveedor->razon_social;
            $newUser->cel = $proveedor->celular;
            $newUser->tel = $proveedor->telefono;
            $newUser->email = $proveedor->email;
            $newUser->email_verified_at = Carbon::now();
            $newUser->password = 'demo12345';
            $newUser->role = 'Proveedor';
            $newUser->Proveedor_id = $proveedor->id;
            $newUser->assignRole('Proveedor');
            $newUser->save();
        }

        return redirect()->back()->with('message', 'Proveedor editado exitosamente');
    }

    public function destroy(int $id): RedirectResponse
    {
        $proveedor = Provider::findOrFail($id);
        $answers = Answer::where('idProveedor', $id)->get();

        if ($proveedor) {

            // Obtener la ruta de los archivos asociados al proveedor
            $rutaArchivoRut = $proveedor->rut;
            $rutaArchivoCam = $proveedor->camara_comercio;

            $users = $proveedor->user;

            if ($users) {
                foreach ($users as $user) {
                    $user->delete();
                }
            }

            if ($answers) {
                foreach ($answers as $answer) {
                    $answer->delete();
                }
            }

            $new_log = new Activity_log();
            $new_log->fecha = Carbon::now();
            if(auth()->check()){
                $new_log->usuario = auth()->user()->name;
            }else{
                $new_log->usuario = 'Desconocido';
            }
            $new_log->actividad = 'Eliminó a un proveedor.';
            $new_log->descripcion = 'Se eliminó al proveedor ' . $proveedor->razon_social . ' desde el administrador';
            $new_log->navegador = request()->header('user-agent');
            $new_log->direccion_ip = request()->ip();
            $new_log->role = 'Admin';

            try{
                $new_log->save();
            }catch(\exception $e){
                Log::error('Error al registrar la nueva actividad: ' . $e->getMessage());
            }

            // Eliminar el proveedor
            $proveedor->delete();

            // Eliminar los archivos asociados al proveedor desde el storage
            if ($rutaArchivoRut and $rutaArchivoCam) {
                Storage::delete('uploads/' . $rutaArchivoRut);
                Storage::delete('uploads/' . $rutaArchivoCam);
            }

            return redirect()->back()->with('message', 'Proveedor eliminado exitosamente');
        }

        return redirect()->back()->with('error', 'No se pudo encontrar el proveedor');
    }

    public function viewFiles($filename)
    {
        // Ruta del archivo a mostrar
        $rutaArchivo = storage_path('app/uploads/' . $filename);

        // Verificar si el archivo existe
        if (Storage::disk('local')->exists('uploads/' . $filename)) {
            $contenido = file_get_contents($rutaArchivo);

            // Obtener el tipo MIME del archivo
            $tipoMIME = mime_content_type($rutaArchivo);

            return response($contenido)
                ->header('Content-Type', $tipoMIME) // Usar el tipo MIME detectado
                ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
        } else {
            return redirect()->back()->with('error', 'El archivo no existe');
        }
    }

    public function exportExcel()
    {
        // Exporta el archivo.xlsx (Excel) de todos los proveedores
        return Excel::download(new ProveedorExport, 'Proveedores.xlsx');
    }
}
