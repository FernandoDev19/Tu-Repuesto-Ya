@extends('layouts.baseAdmin')

@section('title', 'Solicitud | Tu Repuesto Ya')

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
                <a class="nav-link" href="{{ route('viewSolicitudes') }}" style="padding: 0 .50rem; color:#4e73df; gap: 3px;"><i
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

    <div class="container-fluid h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <h1 class="font-weight-bold text-primary">Nueva Solicitud</h1>
                                </div>
                            </div>

                        </div>
                        <div class="card-body" style="padding: 0;">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover" id="solicitudesTable">
                                    <thead>
                                        <tr>
                                            <th class="text-muted" style="padding:10px 5px; text-align:center;">Id
                                            </th>
                                            <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Respuestas
                                            </th>
                                            <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Marca</th>
                                            <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Referencia</th>
                                            <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Modelo</th>
                                            <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Repuestos</th>
                                            <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Fecha de Creación</th>
                                            <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Estado</th>
                                            <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Detalles</th>
                                        </tr>
                                            </thead>
                                            <tbody>
                                                    @php
                                                        $proveedor = auth()->user()->id;
                                                        $proveedorId = auth()->user()->proveedor_id;

                                                        // Verifica si $solicitudAnswers no es nulo antes de usar el método where()
                                                        $solicitudAnswers = $answers[$solicitud->id] ?? null;

                                                        $proveedorHaRespondido = false;

                                                        if ($solicitudAnswers) {
                                                            // Ahora puedes usar el método where() de manera segura
                                                            $proveedorHaRespondido = $solicitudAnswers->where('idProveedor', $proveedorId)->isNotEmpty();
                                                        }
                                                    @endphp
                                                    <tr class="@if ($proveedorHaRespondido) bg-green @endif">
                                                        <td style="padding:10px 10px; margin:0; text-align:center;"
                                                            data-campo="id" data-valor="{{ $solicitud->id }}">
                                                            <span style="font-size: 14;"
                                                            id="id_{{ $solicitud->id }}">{{ $solicitud->id }}</span>
                                                        </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="respuestas" data-valor="{{ $solicitud->respuestas }}">
                                                        <span style="font-size: 14;"
                                                            id="respuestas_{{ $solicitud->respuestas }}">{{ $solicitud->respuestas }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="marca" data-valor="{{ $solicitud->marca }}">
                                                        <span style="font-size: 14;"
                                                            id="marca_{{ $solicitud->marca }}">{{ $solicitud->marca }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="referencia"
                                                        data-valor="{{ $solicitud->referencia }}">
                                                        <span style="font-size: 14;"
                                                            id="referencia_{{ $solicitud->referencia }}">{{ $solicitud->referencia }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="modelo" data-valor="{{ $solicitud->modelo }}">
                                                        <span style="font-size: 14;"
                                                            id="modelo_{{ $solicitud->modelo }}">{{ $solicitud->modelo }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="repuesto" data-valor="{{ $solicitud->repuesto }}">
                                                        <span style="font-size: 14;"
                                                            id="repuesto_{{ $solicitud->repuesto }}">{{ $solicitud->repuesto }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="fecha" data-valor="{{ $solicitud->created_at }}">
                                                        <span style="font-size: 14;"
                                                            id="repuesto_{{ $solicitud->created_at }}">{{ $solicitud->created_at->diffForHumans() }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="estado" data-valor="{{ $solicitud->estado }}">
                                                        <span style="font-size: 14;"
                                                            id="estado_{{ $solicitud->estado }}">
                                                            @if ($solicitud->estado)
                                                               <i class="fas fa-circle" style="color:green;"></i>
                                                            @else
                                                                <i class="fas fa-circle" style="color:red;"></i>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td style="padding:10px; width: 6vw;" class="text-center">
                                                           <a title="Ver detalles"
                                                                href="{{ route('solicitud', [$solicitud->codigo, $proveedor]) }}"
                                                                class="btn btn-primary">Cotizar
                                                            </a>

                                                    </td>

                                                    <!-- Modal para eliminar -->
                                                    <div class="modal fade" id="eraseModal{{ $solicitud->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="eraseModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="eraseModalLabel{{ $solicitud->id }}">
                                                                        Eliminar solicitud</h5>
                                                                    <button class="close" type="button"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Seguro que deseas eliminar esta
                                                                    solicitud?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Cancelar</button>
                                                                    <form
                                                                        action="{{ route('eliminarSolicitud', $solicitud->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Eliminar</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
<script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#proveedoresTable').DataTable();
    });
</script>

