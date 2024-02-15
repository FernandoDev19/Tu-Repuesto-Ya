<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

//Modelos
use App\Models\Provider;
use App\Models\User;
use App\Models\Solicitude;
use App\Models\Answer;
use App\Models\Country_code;
use App\Models\Geolocation;

//Exportar excel
use App\Exports\ProveedorExport;
use App\Exports\SolicitudesExport;
use App\Exports\RespuestasExport;

use App\Mail\RegistroProveedorMail;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

use Carbon\Carbon;

use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

    function index(): view
    {
        // Nombre del usuario
        $name = auth()->user()->name;

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        $cantidad_proveedores = count(Provider::all());
        $proveedores_activos = count(Provider::all()->where('estado', 1));
        $cantidad_solicitudes = count(Solicitude::all()->where('estado', 1));
        $cantidad_respuestas = count(Answer::all());

        // Obtener las marcas más seleccionadas
        $marcas = Solicitude::select('marca')->groupBy('marca')->orderByDesc(\DB::raw('count(*)'))->limit(10)->pluck('marca')->toArray();

        // Obtener el conteo de solicitudes por marca
        $conteoPorMarca = Solicitude::whereIn('marca', $marcas)->groupBy('marca')->select(\DB::raw('count(*) as conteo'), 'marca')->get();

        // Crear el conjunto de datos para el gráfico
        $datasetMarcas = [];
        foreach ($conteoPorMarca as $item) {
            $datasetMarcas[] = [
                'name' => $item->marca,
                'value' => $item->conteo,
            ];
        }

        // Configuración del gráfico 1
        $chartOptionsMarcas = [
            'chart_title' => 'Marcas más elegidas (30 días)',
            'report_type' => 'group_by_string',
            'model' => Solicitude::class,
            'group_by_field' => 'marca',
            'aggregate_function' => 'count',
            'aggregate_field' => 'id',
            'filter_field' => 'marca',
            'filter_days' => 30,
            'chart_type' => 'bar',
            'chart_data' => $datasetMarcas,
            'chart_color' => "78,155,223",
        ];

        $chart1 = new LaravelChart($chartOptionsMarcas);

        // Obtener los repuestos más seleccionadas
        $repuesto = Solicitude::select('repuesto')->groupBy('repuesto')->orderByDesc(\DB::raw('count(*)'))->limit(10)->pluck('repuesto')->toArray();

        // Obtener el conteo de solicitudes por repuestos
        $conteoPorRepuesto = Solicitude::whereIn('repuesto', $repuesto)->groupBy('repuesto')->select(\DB::raw('count(*) as conteo'), 'repuesto')->get();

        // Crear el conjunto de datos para el gráfico
        $datasetRepuestos = [];
        foreach ($conteoPorRepuesto as $item) {
            $datasetRepuestos[] = [
                'name' => $item->repuesto,
                'value' => $item->conteo,
            ];
        }

        // Configuración del gráfico 2
        $chartOptionsRepuestos = [
            'chart_title' => 'Repuestos más pedidos (30 días)',
            'report_type' => 'group_by_string',
            'model' => Solicitude::class,
            'group_by_field' => 'repuesto',
            'aggregate_function' => 'count',
            'aggregate_field' => 'id',
            'filter_field' => 'repuesto',
            'filter_days' => 30,
            'chart_type' => 'line',
            'chart_data' => $datasetRepuestos,
            'chart_color' => "28,200,136",
        ];

        $chart2 = new LaravelChart($chartOptionsRepuestos);

        // Obtener los departamentos más populares
        $departamento = Solicitude::select('departamento')
            ->groupBy('departamento')
            ->orderByDesc(\DB::raw('count(*)'))
            ->limit(10)
            ->pluck('departamento')
            ->toArray();

        // Obtener el conteo de solicitudes por ciudad dentro de cada departamento
        $conteoPorCiudad = Solicitude::whereIn('departamento', $departamento)
            ->groupBy('municipio')
            ->select(\DB::raw('count(*) as conteo'), 'municipio')
            ->get();

        // Crear el conjunto de datos para el gráfico
        $datasetDepartamento = [];
        foreach ($conteoPorCiudad as $item) {
            $datasetDepartamento[] = [
                'name' => $item->municipio,
                'value' => $item->conteo,
            ];
        }

        // Configuración del gráfico para ciudades
        $chartOptionsDepartamentos = [
            'chart_title' => 'Departamentos más populares (30 días)',
            'report_type' => 'group_by_string',
            'model' => Solicitude::class,
            'group_by_field' => 'departamento',
            'aggregate_function' => 'count',
            'aggregate_field' => 'id',
            'filter_field' => 'departamento',
            'filter_days' => 30,
            'chart_type' => 'bar',
            'chart_data' => $datasetDepartamento,
            'chart_color' => "28,200,136",
        ];

        $chart3 = new LaravelChart($chartOptionsDepartamentos);

        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');

        // Obtener las ciudades más populares por departamento
        $ciudadesPorDepartamento = Solicitude::select('departamento', 'municipio')
            ->groupBy('departamento', 'municipio')
            ->orderByDesc(\DB::raw('count(*)'))
            ->limit(10)
            ->get();

        // Crear el conjunto de datos para el gráfico
        $datasetCiudades = $ciudadesPorDepartamento->map(function ($item) {
            return [
                'name' => $item->municipio,
                'value' => $item->count(),
            ];
        })->toArray();

        $chartOptionsCiudades = [
            'chart_title' => 'Ciudades más populares por departamento',
            'chart_type' => 'pie', // Puedes ajustar el tipo de gráfico según tus necesidades
            'report_type' => 'group_by_string',
            'model' => Solicitude::class,
            'group_by_field' => 'municipio',
            'aggregate_function' => 'count',
            'aggregate_field' => 'id',
            'filter_field' => 'municipio', // Ajustado al campo correcto
            'chart_data' => $datasetCiudades,
            'chart_color' => "28,200,136",
        ];

        $chart4 = new LaravelChart($chartOptionsCiudades);


        // Vista principal del administrador
        return view('admin.index', compact('name', 'ft', 'cantidad_proveedores', 'proveedores_activos', 'cantidad_solicitudes', 'cantidad_respuestas', 'departamentos', 'chart1', 'chart2', 'chart3', 'chart4'));
    }

    function profile(): view
    {
        // Nombre del usuario
        $name = auth()->user()->name;

        // Lista de codigos celulares
        $codigos = Country_code::all();

        $usuario = User::with('proveedor')->where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');

        // Lista de municipios
        $group = [];

        foreach ($departamentos as $departamento) {
            $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
            $group[$departamento] = $municipios;
        }

        if ($usuario) {
            return view('admin.profile', compact('name', 'usuario', 'ft', 'departamentos', 'group', 'codigos'));
        }
    }

    function profileUpdate(Request $request, $id_provider = null)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'nullable',
                'cel' => 'nullable|numeric|digits_between:7,11',
                'tel' => 'nullable|numeric|digits_between:8,10',
                'email' => 'nullable|email',
                'password' => [
                    'nullable',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d.@!¡?¿]{8,}$/',
                ],
                'confirm_password' => 'nullable|same:password',
                'nit' => 'nullable|numeric|digits_between:8,15',
            ],
            [
                'cel.numeric' => 'Este campo solo permite números',
                'cel.digits_between' => 'Este campo contiene muchos o pocos digitos',
                'tel.numeric' => 'Este campo solo permite números',
                'tel.digits_between' => 'Este campo contiene muchos o pocos digitos',
                'password.regex' => 'La contraseña no es segura. Debe incluir al menos 8 caracteres, 1 número, una mayúscula y una minúscula.',
                'confirm_password.same' => 'Las contraseñas no coinciden',

            ]
        );

        if (auth()->check() && auth()->user()->hasRole('Admin')) {
            // Validar si el name ya está registrado
            $validator->after(function ($validator) use ($request) {
                $name = $request->input('name');

                // Verificar si el nombre existe en la tabla de usuarios
                $userWithName = User::where('name', $name)->first();

                if ($userWithName) {
                    $validator->errors()->add('name', 'Este nombre de usuario ya está registrado.');
                }
            });

            // Validar si el celular ya está registrado
            $validator->after(function ($validator) use ($request) {
                $cel = $request->input('cel');

                // Verificar si el celular existe en la tabla de usuarios
                $userWithCel = User::where('cel', $cel)->first();

                // Verificar si el celular existe en la tabla de proveedores
                $providerWithCel = Provider::where('celular', $cel)->first();

                if ($userWithCel || $providerWithCel) {
                    $validator->errors()->add('cel', 'Este número de celular ya está registrado.');
                }
            });

            if($request->has('tel') && $request->filled('tel')){
                // Validar si el telefono ya está registrado
                $validator->after(function ($validator) use ($request) {
                    $tel = $request->input('tel');

                    // Verificar si el telefono existe en la tabla de usuarios
                    $userWithTel = User::where('tel', $tel)->first();

                    // Verificar si el telefono existe en la tabla de proveedores
                    $providerWithTel = Provider::where('telefono', $tel)->first();

                    if ($userWithTel || $providerWithTel) {
                        $validator->errors()->add('tel', 'Este número de telefono ya está registrado.');
                    }
                });
            }

            // Validar si el correo electronico ya está registrado
            $validator->after(function ($validator) use ($request) {
                $email = $request->input('email');

                // Verificar si el correo electrónico existe en la tabla de usuarios
                $userWithEmail = User::where('email', $email)->first();

                // Verificar si el correo electrónico existe en la tabla de proveedores
                $providerWithEmail = Provider::where('email', $email)->first();

                if ($userWithEmail || $providerWithEmail) {
                    $validator->errors()->add('email', 'Este correo electrónico ya está registrado.');
                }
            });

            $validator->after(function($validator) use ($request){
                $pass = bcrypt($request->password);
                $idUser = auth()->user()->id;

                $userWithPass = User::find($idUser);

                if($pass == $userWithPass->password){
                    $validator->errors()->add('password', 'Ya tienes en uso esta contraseña');
                }
            });
        }

        if(auth()->check() && auth()->user()->hasRole('Proveedor')){

        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'No se pudieron guardar los cambios');
        }

        if (auth()->check() && auth()->user()->hasRole('Admin')) {

            $id = auth()->user()->id;

            $userUpdate = User::findOrFail($id);

            if($request->has('name') && $request->filled('name')){
                $userUpdate->name = $request->input('name');
            }

            if($request->has('cel') && $request->filled('cel')){
                $userUpdate->cel = $request->input('cel');
            }

            if($request->has('tel') && $request->filled('tel')){
                $userUpdate->tel = $request->codigo_cel . $request->input('tel');
            }

            if($request->has('email') && $request->filled('email')){
                $userUpdate->email = $request->codigo_cel . $request->input('tel');
            }

            if($request->has('password') && $request->filled('password')){
                $userUpdate->password = bcrypt($request->password);
            }
            try{
                $userUpdate->save();
            }catch(\exception $e){
                return redirect()->back()->whithErrors($validator)->with('error', 'Error al guardar. '.$e->getMessage());
            }
        }

        if(auth()->check() && auth()->user()->hasRole('Proveedor')){

            $userUpdate = Provider::findOrFail($id_provider);

            $id = auth()->user()->id;

            $account = User::findOrFail($id);

            if($request->has('nit') && $request->filled('nit')){
                $userUpdate->nit = $request->input('nit');
            }

            if($request->has('nombre_establecimiento') && $request->filled('nombre_establecimiento')){
                $userUpdate->nombre_comercial = $request->input('nombre_establecimiento');
            }

            if($request->has('razon_social') && $request->filled('razon_social')){
                $userUpdate->razon_social = $request->input('tel');
            }

            if($request->has('departamento') && $request->filled('departamento')){
                $userUpdate->departamento = $request->input('departamento');
            }

            if($request->has('municipio') && $request->filled('municipio')){
                $userUpdate->municipio = $request->input('municipio');
            }

            if($request->has('pais') && $request->filled('pais')){
                $userUpdate->pais = $request->input('pais');
            }

            if($request->has('ciudad') && $request->filled('ciudad')){
                $userUpdate->municipio = $request->input('ciudad');
            }

            if($request->has('direccion') && $request->filled('direccion')){
                $userUpdate->direccion = $request->input('direccion');
            }

            if($request->has('cel') && $request->filled('cel')){
                $userUpdate->celular = $request->codigo_cel . $request->input('cel');
                $account->cel = $request->codigo_cel . $request->input('cel');
            }

            if($request->has('tel') && $request->filled('tel')){
                $userUpdate->telefono = $request->codigo_cel . $request->input('tel');
                $account->tel = $request->codigo_cel . $request->input('tel');
            }

            if($request->has('representante_legal') && $request->filled('representante_legal')){
                $userUpdate->representante_legal = $request->input('representante_legal');
            }

            if($request->has('contacto_principal') && $request->filled('contacto_principal')){
                $userUpdate->contacto_principal = $request->input('contacto_principal');
            }

            if($request->has('email') && $request->filled('email')){
                $userUpdate->email = $request->input('email');
                $account->email = $request->input('email');
            }

            if($request->has('email2') && $request->filled('email2')){
                $userUpdate->email_secundario = $request->input('email2');
            }

            if ($request->json_marcas) {
                $cleanedMarcas = str_replace(["×", "\n", "\r"], "", $request->json_marcas);
                $userUpdate->marcas_preferencias = $cleanedMarcas;
            }

            if ($request->json_categorias) {
                $cleanedCategorias = str_replace(["×", "\n", "\r"], "", $request->json_categorias);
                $userUpdate->especialidad = $cleanedCategorias;
            }

            if($request->has('password') && $request->filled('password')){
                $userUpdate->password = bcrypt($request->password);
                $account->password = bcrypt($request->password);
            }

            // if($request->has('password') && $request->filled('password')){
            //     $userUpdate->password = bcrypt($request->password);
            // }

            try{
                $userUpdate->save();
                $account->save();
            }catch(\exception $e){
                return redirect()->back()->withErrors($validator)->with('error', 'Error al guardar. '.$e->getMessage());
            }

        }

        return redirect()->back()->with('message', 'Los datos se han guardado correctamente');

    }

    function viewSolicitudes(): view
    {
        //Para hacer busquedas y filtrar la tabla, se usa when('name del campo buscar', function($variable){ return $variable->where()->orWhere() })
        $solicitudes = Solicitude::query()->when(request('search'), function ($query) {
            return $query->where('id', 'like', '%' . request('search') . '%')
                ->orWhere('respuestas', 'like', '%' . request('search') . '%')
                ->orWhere('marca', 'like', '%' . request('search') . '%')
                ->orWhere('referencia', 'like', '%' . request('search') . '%')
                ->orWhere('modelo', 'like', '%' . request('search') . '%')
                ->orWhere('tipo_de_transmision', 'like', '%' . request('search') . '%')
                ->orWhereJsonContains('repuesto', request('search'))
                ->orWhereJsonContains('categoria', request('search'))
                ->orWhere('nombre', 'like', '%' . request('search') . '%')
                ->orWhere('correo', 'like', '%' . request('search') . '%')
                ->orWhere('comentario', 'like', '%' . request('search') . '%')
                ->orWhere('numero', 'like', '%' . request('search') . '%')
                ->orWhere('pais', 'like', '%' . request('search') . '%')
                ->orWhere('departamento', 'like', '%' . request('search') . '%')
                ->orWhere('municipio', 'like', '%' . request('search') . '%');
        })
            ->paginate(15)->withQueryString();

        $name = auth()->user()->name;

        $id = auth()->user()->id;
        $user = User::find($id);
        $answers = [];

        if ($user) {
            $idP = $user->proveedor_id;

            if ($idP !== null) { // Verifica si $idP no es nulo
                // Iterar sobre cada solicitud y buscar respuestas
                foreach ($solicitudes as $solicitud) {
                    $answer = Answer::where('idProveedor', $idP)
                        ->where('idSolicitud', $solicitud->id)
                        ->get();
                    $answers[$solicitud->id] = $answer;
                }
            }
        }

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        return view('admin.solicitudes', compact('name', 'solicitudes', 'ft', 'answers'));
    }

    function viewAnswers(): view
    {
        $respuestas = Answer::query()->when(request('search'), function ($query){
            return $query->whereHas('solicitud', function ($subquery) {
                        $subquery->where('nombre', 'like', '%' . request('search') . '%');
                    })
                    ->orWhereHas('proveedor', function ($subquery) {
                        $subquery->where('razon_social', 'like', '%' . request('search') . '%');
                    })
                    ->orWhereJsonContains('repuesto', request('search'))
                    ->orWhereJsonContains('precio', request('search'));
            })
            ->with('proveedor', 'solicitud')
            ->paginate(15)
            ->withQueryString();

        $name = auth()->user()->name;

        $proveedores = Provider::all();
        $preferencias_de_marcas = [];

        foreach ($proveedores as $proveedor_m) {
            if (is_string($proveedor_m->marcas_preferencias)) {
                // Decodificar la cadena JSON y almacenar las preferencias de marcas en un array asociativo
                $preferencias_de_marcas[$proveedor_m->id] = json_decode($proveedor_m->marcas_preferencias, true);
            }
        }

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        return view('admin.respuestas', compact('name', 'respuestas', 'preferencias_de_marcas', 'ft'));
    }

    public function loadProviders(): view
    {
        // Lista de codigos celulares
        $codigos = Country_code::all();

        // Nombre del usuario
        $name = auth()->user()->name;

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        $proveedor = Provider::query()
            ->when(request('search'), function ($query) {
                return $query->where('nit_empresa', 'like', '%' . request('search') . '%')
                    ->orWhere('razon_social', 'like', '%' . request('search') . '%')
                    ->orWhere('pais', 'like', '%' . request('search') . '%')
                    ->orWhere('departamento', 'like', '%' . request('search') . '%')
                    ->orWhere('municipio', 'like', '%' . request('search') . '%')
                    ->orWhere('direccion', 'like', '%' . request('search') . '%')
                    ->orWhere('celular', 'like', '%' . request('search') . '%')
                    ->orWhere('telefono', 'like', '%' . request('search') . '%')
                    ->orWhere('representante_legal', 'like', '%' . request('search') . '%')
                    ->orWhere('contacto_principal', 'like', '%' . request('search') . '%')
                    ->orWhere('email', 'like', '%' . request('search') . '%')
                    ->orWhere('email_secundario', 'like', '%' . request('search') . '%')
                    ->orWhere('marcas_preferencias', 'like', '%' . request('search') . '%')
                    ->orWhere('especialidad', 'like', '%' . request('search') . '%');
            })
            ->paginate(15)->withQueryString();

        $proveedores = Provider::all();
        $preferencias_de_marcas = [];

        foreach ($proveedores as $proveedor_m) {
            if (is_string($proveedor_m->marcas_preferencias)) {
                // Decodificar la cadena JSON y almacenar las preferencias de marcas en un array asociativo
                $preferencias_de_marcas[$proveedor_m->id] = json_decode($proveedor_m->marcas_preferencias, true);
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

        // Retorna la vista de la lista de proveedores, usando compact para enviar los datos a la vista
        return view('livewire.admin.providers', compact('name', 'ft', 'proveedor', 'proveedor_m', 'preferencias_de_marcas', 'departamentos', 'group', 'codigos'));
    }

    public function verProveedor($nit, $notificationId)
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

            return view('admin.proveedorRegistrado', compact('name', 'ft', 'proveedores', 'preferencias_de_marcas', 'especialidades', 'departamentos', 'group', 'codigos'));
        } else {
            $notification = auth()->user()->unreadNotifications->find($notificationId);

            if ($notification) {
                $notification->markAsRead();
            }
            return redirect()->route('loadProviders')->with('error', 'El proveedor no existe o ha sido eliminado');
        }
    }

    public function createProvider(Request $request): RedirectResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nit_create' => 'required|numeric|digits_between:8,16',
                'nombre_comercial_create' => 'required',
                'razon_create' => 'required',
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
        if ($request->has('tel_create')) {
            $proveedor->telefono = $request->tel_create;
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
        $proveedor->save();

        $newUser = new User();
        $newUser->name = $proveedor->razon_social;
        $newUser->cel = $proveedor->celular;
        $newUser->tel = $proveedor->telefono;
        $newUser->email = $proveedor->email;
        $newUser->email_verified_at = Carbon::now();
        $newUser->password = 'demo12345';
        $newUser->role = 'Proveedor';
        $newUser->proveedor()->associate($proveedor);
        $newUser->assignRole('Proveedor');
        $newUser->save();

        // Redirigir a la página de inicio con un mensaje de éxito
        return redirect()->back()->with('message', '¡Registro exitoso!');
    }

    public function edit(Request $request): RedirectResponse
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

        $validator->after(function ($validator) use ($request, $id){
            $tel = $request->tel_edit;
            $providerId = $id;

            $existingUser = User::where('tel', $tel)->where('proveedor_id', '!=', $providerId)->first();
            $existingProvider = Provider::where('telefono', $tel)->where('id', '!=', $providerId)->first();

            if($existingUser || $existingProvider){
                $validator->errors()->add('tel_edit', 'Este número de celular ya está en uso');
            }
        });

        $validator->after(function ($validator) use ($request, $id) {
            $nombre_comercial = $request->input('nombre_comercial_edit');
            $providerId = $id;
            $existingProvider = Provider::where('nombre_comercial', $nombre_comercial)->where('id', '!=', $providerId)->first();

            if ($existingProvider) {
                $validator->errors()->add('nombre_comercial_edit', 'Esta Nombre de Establecimiento ya está en uso.');
            }
        });

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

        if($request->has('email_2_edit') && $request->filled('email_2_edit')){
            $validator->after(function ($validator) use ($request, $id){
                $email2 = $request->input('email_2_edit');
                $providerId = $id;

                $existingProvider = Provider::where('email_secundario', $email2)->where('id', '!=', $providerId)->first();

                if($existingProvider){
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
        $proveedor->save();


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
            $newUser->password = bcrypt($codigo);
            $newUser->role = 'Proveedor';
            $newUser->Proveedor_id = $proveedor->id;
            $newUser->assignRole('Proveedor');
            $newUser->save();
        }

        return redirect()->back()->with('message', 'Proveedor editado exitosamente');
    }

    public function delete(int $id): RedirectResponse
    {
        $proveedor = Provider::findOrFail($id);

        if ($proveedor) {

            // Obtener la ruta de los archivos asociados al proveedor
            $rutaArchivoRut = $proveedor->rut;
            $rutaArchivoCam = $proveedor->camara_comercio;

            $user = $proveedor->user;

            if ($user) {
                // Eliminar el usuario asociado al proveedor
                $user->delete();
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

    public function eliminarSolicitud(int $id): RedirectResponse
    {
        $solicitud = Solicitude::findOrFail($id);

        if ($solicitud) {

            // Obtener la ruta de los archivos
            $rutaArchivo = json_decode($solicitud->img_repuesto);

            $answer = Answer::where('idSolicitud', $id);

            $answer->delete();

            // Eliminar solicitud
            $solicitud->delete();

            // Eliminar los archivos desde el storage
            if ($rutaArchivo) {
                foreach ($rutaArchivo as $archivo) {
                    Storage::delete('public/' . $archivo);
                }
            }

            return redirect()->back()->with('message', 'Solicitud eliminada exitosamente');
        }

        return redirect()->back()->with('error', 'No se pudo encontrar la solicitud');
    }

    public function mostrarArchivo($filename)
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

    public function exportExcelSolicitudes()
    {
        // Exporta el archivo.xlsx (Excel) de todos los proveedores
        return Excel::download(new SolicitudesExport, 'Solicitudes.xlsx');
    }

    public function exportExcelRespuestas()
    {
        // Exporta el archivo.xlsx (Excel) de todos los proveedores
        return Excel::download(new RespuestasExport, 'Respuestas.xlsx');
    }

    public function logout(Request $request): RedirectResponse
    {
        //Cierra sesión del usuario

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
