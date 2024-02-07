@extends('layouts.baseAdmin')

@section('title', 'Tu Repuesto Ya - Solicitudes')

<style>
    .bg-green {
        background-color: rgb(157, 232, 157);
    }
</style>

@section('sidebar')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de control</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @can('solicitudes.view')
        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Componentes</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item active" href="{{ route('viewSolicitudes') }}">Solicitudes</a>
                    @can('answers.view')
                        <a class="collapse-item" href="{{ route('viewRespuestas') }}">Respuestas</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan

    <!-- Nav Item - Proveedores -->
    @can('providers.loadProviders')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('loadProviders') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Proveedores</span></a>
        </li>
    @endcan


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <!-- End of Sidebar -->
    </div>

    </ul>
@endsection

@section('content')
    <div class="container-fluid h-100">
        <div class="row h-100 justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between;">
                            <div>
                                <h1 class="font-weight-bold text-primary">Lista de solicitudes</h1>
                                <form method="GET" class="form-inline">
                                    <div class="form-group mb-2">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Buscar...">
                                            <button class="btn btn-outline-primary" type="submit"
                                                id="btn_search">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <a title="Descargar lista de solicitudes" href="{{ route('solicitudes.excel') }}"
                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                        <i class="fas fa-download fa-sm text-white-50"></i> Descargar
                                    </a>
                                </div>
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
                                            Repuestas
                                        </th>
                                        <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                            Marca</th>
                                        <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                            Referencia</th>
                                        <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                            Modelo</th>
                                        <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                            Repuesto</th>
                                        <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                            Fecha de Creación</th>
                                        <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                            Estado</th>
                                        <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                            Detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($solicitudes->isEmpty())
                                        <tr>
                                            <td style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                No hay registros
                                            </td>
                                            <td style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                No hay registros
                                            </td>
                                            <td style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                No hay registros
                                            </td>
                                            <td style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                No hay registros
                                            </td>
                                            <td style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                No hay registros
                                            </td>
                                            <td style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                No hay registros
                                            </td>
                                            <td style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                No hay registros
                                            </td>
                                        </tr>
                                    @else
                                        @if (auth()->user()->hasRole('Admin'))
                                            @foreach ($solicitudes as $solicitud)
                                                @php
                                                    $json_nombres = $solicitud->img_repuesto;
                                                    $nombres = json_decode($json_nombres);
                                                @endphp
                                                <tr>
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
                                                    <?php
                                                    $array_de_repuestos = json_decode($solicitud->repuesto, true);

                                                    $repuesto_for_soli = is_array($array_de_repuestos) ? implode(', ', $array_de_repuestos) : $array_de_repuestos;

                                                    ?>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="repuesto" data-valor="{{ $repuesto_for_soli }}">
                                                        <span style="font-size: 14;"
                                                            id="repuesto_{{ $repuesto_for_soli }}">{{ $repuesto_for_soli }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="fecha"
                                                        data-valor="{{ $solicitud->created_at->diffForHumans() }}">
                                                        <span style="font-size: 14;"
                                                            id="fecha_{{ $solicitud->id }}">{{ $solicitud->created_at->diffForHumans() }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="estado" data-valor="{{ $solicitud->estado }}">
                                                        <span style="font-size: 14;"
                                                            id="estado_{{ $solicitud->estado }}">
                                                            @if ($solicitud->estado)
                                                                <i class="fas fa-circle" style="color:#12e912;;"></i>
                                                            @else
                                                                <i class="fas fa-circle" style="color:#ff5a51;"></i>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td style="padding:10px; width: 6vw;" class="text-center">
                                                        <a title="Ver detalles" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#infoModal{{ $solicitud->id }}"
                                                            style="font-size: 14; padding: 5%;">
                                                            <i class="fas fa-info-circle"></i>
                                                        </a>

                                                    </td>

                                                    <!-- Modal de Información -->
                                                    <div class="modal fade" id="infoModal{{ $solicitud->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="infoModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="infoModalLabel">
                                                                        <strong>Información
                                                                            de la solicitud</strong>
                                                                    </h5>
                                                                    <button class="close" type="button"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body d-flex justify-content-between">
                                                                    <div class="text-wrap w-100">
                                                                        <ul style="padding-left: 2rem;">
                                                                            <fieldset>
                                                                                <legend style="text-align: center;">
                                                                                    <strong>Información General:</strong>
                                                                                </legend>
                                                                                <li><strong>ID:
                                                                                    </strong>{{ $solicitud->id }}</li>

                                                                                <li><strong>Estado de solicitud:</strong>
                                                                                    @if ($solicitud->estado)
                                                                                        Activa
                                                                                    @else
                                                                                        Inactiva
                                                                                    @endif
                                                                                </li>
                                                                                <li><strong>Respuestas:</strong>
                                                                                    {{ $solicitud->respuestas }}</li>
                                                                            </fieldset>

                                                                            <hr>

                                                                            <fieldset>
                                                                                <legend style="text-align: center;">
                                                                                    <strong>Detalles de la
                                                                                        Solicitud:</strong></legend>
                                                                                <li><strong>Marca:
                                                                                    </strong>{{ $solicitud->marca }}</li>

                                                                                <li><strong>Referencia:
                                                                                    </strong>{{ $solicitud->referencia }}
                                                                                </li>

                                                                                <li><strong>Modelo:
                                                                                    </strong>{{ $solicitud->modelo }}</li>

                                                                                <li><strong>Transmisión:
                                                                                    </strong>{{ $solicitud->tipo_de_transmision }}
                                                                                </li>

                                                                                <li><strong>Repuesto:
                                                                                    </strong>{{ $repuesto_for_soli }}</li>

                                                                                <li><strong>Imagen del repuesto: </strong>
                                                                                    @if (is_array($nombres) && in_array('No se subió ningun archivo', $nombres))
                                                                                        No hay imagen
                                                                                    @else
                                                                                        <a title="Ver imagen del repuesto"
                                                                                            data-toggle="modal"
                                                                                            data-target="#imgModal{{ $solicitud->id }}"
                                                                                            href="#">Ver
                                                                                            Imagen</a>
                                                                                    @endif
                                                                                </li>
                                                                                <li><strong>Comentarios del cliente:
                                                                                    </strong>
                                                                                    @if ($solicitud->comentario)
                                                                                        {{ $solicitud->comentario }}
                                                                                    @else
                                                                                        No hay comentarios
                                                                                    @endif
                                                                                </li>
                                                                            </fieldset>

                                                                            <hr>

                                                                            <fieldset>
                                                                                <legend style="text-align: center;">
                                                                                    <strong>Información de
                                                                                        Contacto:</strong></legend>
                                                                                <li><strong>Nombre:</strong>
                                                                                    {{ $solicitud->nombre }} </li>

                                                                                <li><strong>Correo electronico:</strong>
                                                                                    {{ $solicitud->correo }} </li>

                                                                                <li><strong>Celular:</strong>
                                                                                    {{ $solicitud->numero }} </li>
                                                                            </fieldset>

                                                                            <hr>

                                                                            <fieldset>
                                                                                <legend style="text-align: center;">
                                                                                    <strong>Ubicación:</strong></legend>
                                                                                <li><strong>Departamento:</strong>
                                                                                    {{ $solicitud->departamento }} </li>

                                                                                <li><strong>Municipio:</strong>
                                                                                    {{ $solicitud->municipio }} </li>
                                                                            </fieldset>

                                                                        </ul>

                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    @can('solicitudes.delete')
                                                                        <button class="btn btn-danger"
                                                                            data-id="{{ $solicitud->id }}"
                                                                            data-toggle="modal"
                                                                            data-target="#eraseModal{{ $solicitud->id }}"
                                                                            onclick="resaltarBotonActivo(this)">
                                                                            Eliminar
                                                                        </button>
                                                                    @endcan
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal de Imagen -->
                                                    <div class="modal" id="imgModal{{ $solicitud->id }}" tabindex="-1"
                                                        role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Imágenes del repuesto</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @if (!empty($nombres))
                                                                        <div id="carouselModal{{ $solicitud->id }}"
                                                                            class="carousel slide" data-ride="carousel">
                                                                            <ol class="carousel-indicators">
                                                                                @foreach ($nombres as $i => $imagen)
                                                                                    <li data-target="#carouselModal{{ $solicitud->id }}"
                                                                                        data-slide-to="{{ $i }}"
                                                                                        class="{{ $i == 0 ? 'active' : '' }}">
                                                                                    </li>
                                                                                @endforeach
                                                                            </ol>
                                                                            <div class="carousel-inner">
                                                                                @foreach ($nombres as $i => $imagen)
                                                                                    <div
                                                                                        class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                                                                        <img src='{{ asset("storage/$imagen") }}'
                                                                                            alt="{{ $imagen }}"
                                                                                            class="img-fluid">
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                            <a class="carousel-control-prev"
                                                                                href="#carouselModal{{ $solicitud->id }}"
                                                                                role="button" data-slide="prev">
                                                                                <span class="carousel-control-prev-icon"
                                                                                    aria-hidden="true"></span>
                                                                                <span class="sr-only">Anterior</span>
                                                                            </a>
                                                                            <a class="carousel-control-next"
                                                                                href="#carouselModal{{ $solicitud->id }}"
                                                                                role="button" data-slide="next">
                                                                                <span class="carousel-control-next-icon"
                                                                                    aria-hidden="true"></span>
                                                                                <span class="sr-only">Siguiente</span>
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <p>No hay imágenes disponibles.</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


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
                                            @endforeach
                                        @else
                                            @foreach ($solicitudes as $solicitud)
                                                @php
                                                    $proveedor = auth()->user()->id;
                                                    $proveedorId = auth()->user()->proveedor_id;

                                                    $solicitudAnswers = $answers[$solicitud->id] ?? null;

                                                    $proveedorHaRespondido = false;

                                                    if ($solicitudAnswers) {
                                                        $proveedorHaRespondido = $solicitudAnswers->where('idProveedor', $proveedorId)->isNotEmpty();
                                                    }

                                                    $json_nombres = $solicitud->img_repuesto;
                                                    $nombres = json_decode($json_nombres);
                                                @endphp
                                                <tr class="@if ($proveedorHaRespondido) bg-green @endif">
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="id" data-valor="{{ $solicitud->id }}">
                                                        <span style="font-size: 14;"
                                                            id="id_{{ $solicitud->id }}">{{ $solicitud->id }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="respuestas"
                                                        data-valor="{{ $solicitud->respuestas }}">
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
                                                    <?php
                                                    $array_de_repuestos = json_decode($solicitud->repuesto, true);

                                                    $repuesto_for_soli = is_array($array_de_repuestos) ? implode(', ', $array_de_repuestos) : $array_de_repuestos;

                                                    ?>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="repuesto" data-valor="{{ $repuesto_for_soli }}">
                                                        <span style="font-size: 14;"
                                                            id="repuesto_{{ $repuesto_for_soli }}">{{ $repuesto_for_soli }}</span>
                                                    </td>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="fecha"
                                                        data-valor="{{ $solicitud->created_at->diffForHumans() }}">
                                                        <span style="font-size: 14;"
                                                            id="fecha_{{ $solicitud->id }}">{{ $solicitud->created_at->diffForHumans() }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="estado" data-valor="{{ $solicitud->estado }}">
                                                        <span style="font-size: 14;"
                                                            id="estado_{{ $solicitud->estado }}">
                                                            @if ($solicitud->estado)
                                                                <i class="fas fa-circle" style="color:#12e912;;"></i>
                                                            @else
                                                                <i class="fas fa-circle" style="color:#ff5a51;"></i>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td style="padding:10px; width: 6vw;" class="text-center">
                                                        @if ($proveedorHaRespondido)
                                                            <a title="Ver detalles" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#infoModal{{ $solicitud->id }}"
                                                                style="font-size: 14; padding: 5%;">
                                                                <i class="fas fa-info-circle"></i>
                                                            </a>
                                                        @else
                                                            @if (!$solicitud->estado)
                                                                <a title="Ver detalles" class="btn btn-primary"
                                                                    data-toggle="modal"
                                                                    data-target="#infoModal{{ $solicitud->id }}"
                                                                    style="font-size: 14; padding: 5%;">
                                                                    <i class="fas fa-info-circle"></i>
                                                                </a>
                                                            @else
                                                                <a title="Ver detalles"
                                                                    href="{{ route('solicitud', [$solicitud->codigo, $proveedor]) }}"
                                                                    class="btn btn-primary">
                                                                    Cotizar
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>

                                                    <!-- Modal de Información -->
                                                    <div class="modal fade" id="infoModal{{ $solicitud->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="infoModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="infoModalLabel">
                                                                        Información
                                                                        de la solicitud</h5>
                                                                    <button class="close" type="button"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body d-flex justify-content-between">
                                                                    <div class="text-wrap w-100">
                                                                        <ul style="padding-left: 2rem;">
                                                                            <fieldset>
                                                                                <legend style="text-align: center;">
                                                                                    <strong>Información General:</strong>
                                                                                </legend>
                                                                                <li><strong>ID:
                                                                                    </strong>{{ $solicitud->id }}</li>

                                                                                <li><strong>Estado de solicitud:</strong>
                                                                                    @if ($solicitud->estado)
                                                                                        Activa
                                                                                    @else
                                                                                        Inactiva
                                                                                    @endif
                                                                                </li>
                                                                                <li><strong>Respuestas:</strong>
                                                                                    {{ $solicitud->respuestas }}</li>
                                                                            </fieldset>

                                                                            <hr>

                                                                            <fieldset>
                                                                                <legend style="text-align: center;">
                                                                                    <strong>Detalles de la
                                                                                        Solicitud:</strong></legend>
                                                                                <li><strong>Marca:</strong>{{ $solicitud->marca }}
                                                                                </li>

                                                                                <li><strong>Referencia:</strong>{{ $solicitud->referencia }}
                                                                                </li>

                                                                                <li><strong>Modelo:</strong>{{ $solicitud->modelo }}
                                                                                </li>

                                                                                <li><strong>Transmisión:</strong>{{ $solicitud->tipo_de_transmision }}
                                                                                </li>

                                                                                <li><strong>Repuesto:
                                                                                    </strong>{{ $repuesto_for_soli }}</li>

                                                                                <li><strong>Imagen del repuesto:</strong>
                                                                                    @if (is_array($nombres) && in_array('No se subió ningun archivo', $nombres))
                                                                                        No hay imagen
                                                                                    @else
                                                                                        <a title="Ver imagen del repuesto"
                                                                                            data-toggle="modal"
                                                                                            data-target="#imgModal{{ $solicitud->id }}"
                                                                                            href="#">Ver
                                                                                            Imagen</a>
                                                                                    @endif
                                                                                </li>
                                                                                <li><strong>Comentarios del
                                                                                        cliente:</strong>
                                                                                    @if ($solicitud->comentario)
                                                                                        {{ $solicitud->comentario }}
                                                                                    @else
                                                                                        No hay comentarios
                                                                                    @endif
                                                                                </li>
                                                                            </fieldset>

                                                                            <hr>

                                                                            <fieldset>
                                                                                <legend style="text-align: center;">
                                                                                    <strong>Información de
                                                                                        Contacto:</strong></legend>
                                                                                <li><strong>Nombre:</strong>
                                                                                    {{ $solicitud->nombre }} </li>

                                                                                <li><strong>Celular:</strong>
                                                                                    {{ $solicitud->numero }} </li>
                                                                            </fieldset>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    @can('solicitudes.delete')
                                                                        <button class="btn btn-primary"
                                                                            data-id="{{ $solicitud->id }}"
                                                                            data-toggle="modal"
                                                                            data-target="#eraseModal{{ $solicitud->id }}"
                                                                            onclick="resaltarBotonActivo(this)">
                                                                            Eliminar
                                                                        </button>
                                                                    @endcan
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal de Imagen -->
                                                    <div class="modal" id="imgModal{{ $solicitud->id }}" tabindex="-1"
                                                        role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Imágenes del repuesto</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @if (!empty($nombres))
                                                                        <div id="carouselModal{{ $solicitud->id }}"
                                                                            class="carousel slide" data-ride="carousel">
                                                                            <ol class="carousel-indicators">
                                                                                @foreach ($nombres as $i => $imagen)
                                                                                    <li data-target="#carouselModal{{ $solicitud->id }}"
                                                                                        data-slide-to="{{ $i }}"
                                                                                        class="{{ $i == 0 ? 'active' : '' }}">
                                                                                    </li>
                                                                                @endforeach
                                                                            </ol>
                                                                            <div class="carousel-inner">
                                                                                @foreach ($nombres as $i => $imagen)
                                                                                    <div
                                                                                        class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                                                                        <img src='{{ asset("storage/$imagen") }}'
                                                                                            alt="{{ $imagen }}"
                                                                                            class="img-fluid">
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                            <a class="carousel-control-prev"
                                                                                href="#carouselModal{{ $solicitud->id }}"
                                                                                role="button" data-slide="prev">
                                                                                <span class="carousel-control-prev-icon"
                                                                                    aria-hidden="true"></span>
                                                                                <span class="sr-only">Anterior</span>
                                                                            </a>
                                                                            <a class="carousel-control-next"
                                                                                href="#carouselModal{{ $solicitud->id }}"
                                                                                role="button" data-slide="next">
                                                                                <span class="carousel-control-next-icon"
                                                                                    aria-hidden="true"></span>
                                                                                <span class="sr-only">Siguiente</span>
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <p>No hay imágenes disponibles.</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


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
                                            @endforeach
                                        @endif
                                    @endif

                                </tbody>
                            </table>
                            <!-- Botones de paginación -->
                            <div class="text-center" style="display: flex;">
                                <ul class="pagination">
                                    <!-- Botón "Anterior" -->
                                    @if ($solicitudes->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item"><a href="{{ $solicitudes->previousPageUrl() }}"
                                                class="page-link" rel="prev">&laquo;</a>
                                        </li>
                                    @endif

                                    <!-- Números de página -->
                                    @foreach ($solicitudes->getUrlRange(1, $solicitudes->lastPage()) as $page => $url)
                                        @if ($page == $solicitudes->currentPage())
                                            <li class="page-item active"><span
                                                    class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item"><a href="{{ $url }}"
                                                    class="page-link">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    <!-- Botón "Siguiente" -->
                                    @if ($solicitudes->hasMorePages())
                                        <li class="page-item"><a href="{{ $solicitudes->nextPageUrl() }}"
                                                class="page-link" rel="next">&raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

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
@endsection

<script>
    $(document).ready(function() {
        $('#proveedoresTable').DataTable();
    });
</script>
