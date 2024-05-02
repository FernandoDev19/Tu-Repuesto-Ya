@extends('layouts.baseAdmin')

@section('title', 'Registro de actividades | Tu Repuesto Ya')

<style>
    .activity-logs-container{
        padding: .5rem 1.5rem;
        border-bottom: 1px solid lightgray;
        display: flex;
        gap: 1rem;
    }

    .activity-logs-container:hover{
        background-color: lightgray;
    }

    .item{
        border-right: 1px solid lightgray;
        width: 100%;
    }
</style>

@section('sidebar')
    <nav
    class="navbar navbar-expand navbar-light bg-white shadow topbar static-top d-flex justify-content-center">

    <!-- Topbar Navbar -->
    <ul id="lista-nav-items" class="navbar-nav" style="font-size: 1.3rem;">

        <li class="nav-item">
            <a class="nav-link" style="color: var(--gray); padding: 0 .50rem; gap: 3px;" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt icon-sidebar"> </i>
                <span class="nav-items-cel-small">Panel</span></a>
        </li>

        @can('providers.loadProviders')
            <li class="nav-item">
                <a href="{{ route('loadProviders') }}" class="nav-link" style="color: var(--gray); padding: 0 .50rem; gap: 3px;"><i
                        class="fas fa-users icon-sidebar"> </i><span class="nav-items-cel-small">Proveedores</span> </a>
            </li>
        @endcan

        @can('solicitudes.view')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('viewSolicitudes') }}" style="color: var(--gray); padding: 0 .50rem; gap: 3px;"><i
                        class="fas fa-file-alt icon-sidebar"> </i> <span class="nav-items-cel-small">Solicitudes</span></a>
            </li>
        @endcan

        @can('answers.view')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('viewRespuestas') }}" style="color: var(--gray); padding: 0 .50rem; gap: 3px;"><i
                        class="fas fa-reply icon-sidebar"> </i><span class="nav-items-cel-small">Respuestas</span> </a>
            </li>
        @endcan

    </ul>
    </nav>
@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <h1 class="font-weight-bold text-primary">Registro de actividades</h1>
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <a title="Descargar lista de respuestas" href="{{ route('respuestas.excel') }}"
                                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                            <i class="fas fa-download fa-sm text-white-50"></i> Descargar
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body" style="padding: 0;">
                            @livewire('activity-logs')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        setInterval(() => {
            Livewire.dispatch('refresh');
        }, 1000);
    </script>

@endsection
