<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

//Modelos
use App\Models\Provider;
use App\Models\User;
use App\Models\Solicitude;
use App\Models\Answer;
use App\Models\Geolocation;

use App\Models\Session_log;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

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
        $repuesto = Solicitude::select('categoria')->groupBy('categoria')->orderByDesc(\DB::raw('count(*)'))->limit(10)->pluck('categoria')->toArray();

        // Obtener el conteo de solicitudes por repuestos
        $conteoPorRepuesto = Solicitude::whereIn('categoria', $repuesto)->groupBy('categoria')->select(\DB::raw('count(*) as conteo'), 'categoria')->get();

        // Crear el conjunto de datos para el gráfico
        $datasetRepuestos = [];
        foreach ($conteoPorRepuesto as $item) {
            $datasetRepuestos[] = [
                'name' => $item->categoria,
                'value' => $item->conteo,
            ];
        }

        // Configuración del gráfico 2
        $chartOptionsRepuestos = [
            'chart_title' => 'Repuestos más pedidos (30 días)',
            'report_type' => 'group_by_string',
            'model' => Solicitude::class,
            'group_by_field' => 'categoria',
            'aggregate_function' => 'count',
            'aggregate_field' => 'id',
            'filter_field' => 'categoria',
            'filter_days' => 30,
            'chart_type' => 'bar',
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
            'filter_days' => 30,
            'filter_field' => 'municipio', // Ajustado al campo correcto
            'chart_data' => $datasetCiudades,
            'chart_color' => "28,200,136",
        ];

        $chart4 = new LaravelChart($chartOptionsCiudades);

        $chart_options = [
            'chart_title' => 'Solicitudes por més',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Solicitude',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_color' => "28,200,136"
        ];

        $chartSoli = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Proveedores por més',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Provider',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_color' => "54,185,204"
        ];

        $chartProv = new LaravelChart($chart_options);

        // Vista principal del administrador
        return view('admin.index', compact('name', 'ft', 'cantidad_proveedores', 'proveedores_activos', 'cantidad_solicitudes', 'cantidad_respuestas', 'departamentos', 'chart1', 'chart2', 'chart3', 'chart4', 'chartSoli', 'chartProv'));
    }

    public function activityLogView(): view
    {
        return view('admin.activityLog');
    }

    public function logout(Request $request): RedirectResponse
    {
        $sesion_activa = Session_log::where('idProveedor', auth()->user()->proveedor_id)->first();

        if($sesion_activa){
            if($sesion_activa->sesiones <= 1){
                $sesion_activa->sesiones = 0;
                $sesion_activa->save();
            }else{
                $sesion_activa->sesiones -= 1;
                $sesion_activa->save();
            }
        }

        $provider = Provider::where('id', auth()->user()->proveedor_id)->first();

        if($sesion_activa){
            if($sesion_activa->sesiones > 0){
                $provider->sesion = true;
                $provider->save();
            }else{
                $provider->sesion = false;
                $provider->save();
            }
        }

        //Cierra sesión del usuario
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
