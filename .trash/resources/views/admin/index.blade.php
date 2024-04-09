@extends('layouts.baseAdmin')

@section('title', 'Panel | Tu Repuesto Ya')

<style>
    .hide{
        display: none !important;
    }
</style>

<!-- Sidebar -->
@section('sidebar')
    <nav
    class="navbar navbar-expand navbar-light bg-white shadow topbar static-top d-flex justify-content-center">

    <!-- Topbar Navbar -->
    <ul class="navbar-nav" style="font-size: 1.3rem;  gap: 0.6rem;">

        <li class="nav-item active">
            <a class="nav-link" style="color:#4e73df; gap: 3px;" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"> </i>
                <span class="nav-items-cel-small"> Panel</span></a>
        </li>

        @can('providers.loadProviders')
            <li class="nav-item">
                <a href="{{ route('loadProviders') }}" class="nav-link" style="color: var(--gray); padding: 0 .50rem; gap: 3px;"><i
                        class="fas fa-users"> </i><span class="nav-items-cel-small">Proveedores</span> </a>
            </li>
        @endcan

        @can('solicitudes.view')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('viewSolicitudes') }}" style="color: var(--gray); padding: 0 .50rem; gap: 3px;"><i
                        class="fas fa-file-alt"> </i> <span class="nav-items-cel-small">Solicitudes</span></a>
            </li>
        @endcan

        @can('answers.view')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('viewRespuestas') }}" style="color: var(--gray); padding: 0 .50rem; gap: 3px;"><i
                        class="fas fa-reply"> </i><span class="nav-items-cel-small">Respuestas</span> </a>
            </li>
        @endcan

    </ul>
    </nav>
@endsection

<!-- Content Wrapper -->
@section('content')

    @if(auth()->user()->hasRole('Admin'))
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!--Cantidad de proveedores -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Proveedores (Cantidad)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cantidad_proveedores}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Proveedores activos -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Proveedores Activos (Cantidad)
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$proveedores_activos}}</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: {{($proveedores_activos / $cantidad_proveedores) * 100}}%"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cantidad de solicitudes -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Solicitudes (Cantidad)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cantidad_solicitudes}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Respuestas (Cantidad)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cantidad_respuestas}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-reply fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Solicitudes
                            </h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Otras Estadisticas:</div>
                                    <a id="marcas_est" class="dropdown-item" >Marcas</a>
                                    <a id="repuestos_est" class="dropdown-item">Repuestos</a>
                                    <a id="departamentos_est" class="dropdown-item" >Departamentos</a>
                                    <a id="ciudades_est" class="dropdown-item" >Ciudades</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div id="estadisticas_solicitud" class="card-body">
                            <div id="myChart1" class="hide">
                                <h1>{{ $chart1->options['chart_title'] }}</h1>
                            {!! $chart1->renderHtml() !!}
                            </div>
                            <div id="myChart2">
                                <h1>{{ $chart2->options['chart_title'] }}</h1>
                            {!! $chart2->renderHtml() !!}
                            </div>
                            <div id="myChart3">
                                <h1>{{ $chart3->options['chart_title'] }}</h1>
                            {!! $chart3->renderHtml() !!}
                            </div>
                            <div id="myChart4">
                                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                    <h1 style="width: 100%;">{{ $chart4->options['chart_title'] }}</h1>
                                    <select class="form-control" name="select_est_departamento" id="select_est_departamento"
                                            style="height: 2.8rem; width: 15rem;">
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento }}">{{ $departamento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $chart4->renderHtml() !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Solicitudes</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Otras estadísticas:</div>
                                    <a id="solicitudes_est" class="dropdown-item">Solicitudes</a>
                                    <a id="proveedores_est" class="dropdown-item">Proveedores</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div id="estadisticas_solicitud_2" class="card-body">
                                <div id="myChart5">
                                    <h1>{{ $chartSoli->options['chart_title'] }}</h1>
                                {!! $chartSoli->renderHtml() !!}
                                </div>
                                <div id="myChart6" class="hide">
                                    <h1>{{ $chartProv->options['chart_title'] }}</h1>
                                {!! $chartProv->renderHtml() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-6 mb-4">

                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span>
                            </h4>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Color System -->
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Primary
                                    <div class="text-white-50 small">#4e73df</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Success
                                    <div class="text-white-50 small">#1cc88a</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    Info
                                    <div class="text-white-50 small">#36b9cc</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-warning text-white shadow">
                                <div class="card-body">
                                    Warning
                                    <div class="text-white-50 small">#f6c23e</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-danger text-white shadow">
                                <div class="card-body">
                                    Danger
                                    <div class="text-white-50 small">#e74a3b</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-secondary text-white shadow">
                                <div class="card-body">
                                    Secondary
                                    <div class="text-white-50 small">#858796</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-light text-black shadow">
                                <div class="card-body">
                                    Light
                                    <div class="text-black-50 small">#f8f9fc</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card bg-dark text-white shadow">
                                <div class="card-body">
                                    Dark
                                    <div class="text-white-50 small">#5a5c69</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                    src="img/undraw_posting_photo.svg" alt="...">
                            </div>
                            <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank"
                                    rel="nofollow noopener noreferrer" href="https://undraw.co/">unDraw</a>, a
                                constantly updated collection of beautiful svg images that you can use
                                completely free and without attribution!</p>
                            <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations
                                on
                                unDraw &rarr;</a>
                        </div>
                    </div>

                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                        </div>
                        <div class="card-body">
                            <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                CSS bloat and poor page performance. Custom CSS classes are used to create
                                custom components and custom utility classes.</p>
                            <p class="mb-0">Before working with this theme, you should become familiar with
                                the
                                Bootstrap framework, especially the utility classes.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
        {!! $chart1->renderChartJsLibrary() !!}
        {!! $chart1->renderJs() !!}
        {!! $chart2->renderJs() !!}
        {!! $chart3->renderJs() !!}
        {!! $chart4->renderJs() !!}
        {!! $chartSoli->renderJs() !!}
        {!! $chartProv->renderJs() !!}
    @else
        <div class="h-100 w-100 d-flex justify-content-center" style="align-items: center;">
            <h1><strong>En Desarrollo</strong></h1>
        </div>
    @endif
    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let selectEstDepartamento = document.getElementById('select_est_departamento');

            // Event listener para cambios en el menú desplegable
            selectEstDepartamento.addEventListener('change', function () {
                // Obtener el valor seleccionado
                let selectedDepartamento = selectEstDepartamento.value;

                // Actualizar el gráfico según el departamento seleccionado
                // Esto puede requerir una llamada AJAX para obtener datos filtrados por departamento
                // y luego actualizar el gráfico dinámicamente.
            });
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        let marcas_est = document.getElementById('marcas_est');
        let repuestos_est = document.getElementById('repuestos_est');
        let departamentos_est = document.getElementById('departamentos_est');
        let ciudades_est = document.getElementById('ciudades_est');
        let solicitudes_est = document.getElementById('solicitudes_est');
        let proveedores_est = document.getElementById('proveedores_est');

        let myChart1 = document.getElementById('myChart1');
        let myChart2 = document.getElementById('myChart2');
        let myChart3 = document.getElementById('myChart3');
        let myChart4 = document.getElementById('myChart4');
        let myChart5 = document.getElementById('myChart5');
        let myChart6 = document.getElementById('myChart6');

        myChart1.classList.remove('hide');
        myChart2.classList.add('hide');
        myChart3.classList.add('hide');
        myChart4.classList.add('hide');
        myChart5.classList.remove('hide');
        myChart6.classList.add('hide');

       marcas_est.addEventListener('click', function(){
            myChart1.classList.remove('hide');
            myChart2.classList.add('hide');
            myChart3.classList.add('hide');
            myChart4.classList.add('hide');
       });

       repuestos_est.addEventListener('click', function(){
            myChart2.classList.remove('hide');
            myChart1.classList.add('hide');
            myChart3.classList.add('hide');
            myChart4.classList.add('hide');
       });

       departamentos_est.addEventListener('click', function(){
            myChart1.classList.add('hide');
            myChart2.classList.add('hide');
            myChart3.classList.remove('hide');
            myChart4.classList.add('hide');
       });

       ciudades_est.addEventListener('click', function(){
            myChart1.classList.add('hide');
            myChart2.classList.add('hide');
            myChart3.classList.add('hide');
            myChart4.classList.remove('hide');
       });

       solicitudes_est.addEventListener('click', function(){
            myChart5.classList.remove('hide');
            myChart6.classList.add('hide');
       });

       proveedores_est.addEventListener('click', function(){
            myChart5.classList.add('hide');
            myChart6.classList.remove('hide');
       });
    });
</script>
@endsection
