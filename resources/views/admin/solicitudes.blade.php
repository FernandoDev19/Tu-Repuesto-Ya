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
                <span>Components</span>
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
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="container-fluid h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <h1 class="font-weight-bold text-primary">Lista de solicitudes</h1>
                                    <form class="form-inline">
                                        <div class="form-group mb-2">
                                            <label for="ordenarPor" class="mr-2">Ordenar por:</label>
                                            <select name="ordenarPor" id="ordenarPor" class="form-control"
                                                onchange="ordenarTabla(this.value)">
                                                <option value="">Seleccionar</option>
                                                <option value="id">Id</option>
                                                <option value="respuestas">Respuestas</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="numero">Celular</option>
                                                <option value="marca">Marca</option>
                                                <option value="referencia">Referencia</option>
                                                <option value="modelo">Modelo</option>
                                                <option value="repuesto">Repuesto</option>
                                                <option value="estado">Estado</option>
                                            </select>
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
                        <div class="card-body">
                            <div class="card shadow mb-4 contenedor-lista">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="solicitudesTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">Id
                                                    </th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Respuestas
                                                    </th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Repuesto</th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Marca</th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Referencia</th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Modelo</th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($solicitudes->isEmpty())
                                                    <tr>
                                                        <td
                                                            style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                    </tr>
                                                @else
                                                    @if (auth()->user()->hasRole('Admin'))
                                                        @foreach ($solicitudes as $solicitud)
                                                            <tr>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="id" data-valor="{{ $solicitud->id }}">
                                                                    <span style="font-size: 14;"
                                                                        id="id_{{ $solicitud->id }}">{{ $solicitud->id }}</span>
                                                                </td>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="respuestas"
                                                                    data-valor="{{ $solicitud->respuestas }}">
                                                                    <span style="font-size: 14;"
                                                                        id="respuestas_{{ $solicitud->respuestas }}">{{ $solicitud->respuestas }}</span>
                                                                </td>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="marca"
                                                                    data-valor="{{ $solicitud->marca }}">
                                                                    <span style="font-size: 14;"
                                                                        id="marca_{{ $solicitud->marca }}">{{ $solicitud->marca }}</span>
                                                                </td>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="referencia"
                                                                    data-valor="{{ $solicitud->referencia }}">
                                                                    <span style="font-size: 14;"
                                                                        id="referencia_{{ $solicitud->referencia }}">{{ $solicitud->referencia }}</span>
                                                                </td>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="modelo"
                                                                    data-valor="{{ $solicitud->modelo }}">
                                                                    <span style="font-size: 14;"
                                                                        id="modelo_{{ $solicitud->modelo }}">{{ $solicitud->modelo }}</span>
                                                                </td>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="repuesto"
                                                                    data-valor="{{ $solicitud->repuesto }}">
                                                                    <span style="font-size: 14;"
                                                                        id="repuesto_{{ $solicitud->repuesto }}">{{ $solicitud->repuesto }}</span>
                                                                </td>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="estado"
                                                                    data-valor="{{ $solicitud->estado }}">
                                                                    <span style="font-size: 14;"
                                                                        id="estado_{{ $solicitud->estado }}">
                                                                        @if ($solicitud->estado)
                                                                            Activa
                                                                        @else
                                                                            Inactiva
                                                                        @endif
                                                                    </span>
                                                                </td>
                                                                <td style="padding:0px; width: 6vw;" class="text-center">
                                                                    <a title="Ver detalles" class="btn btn-primary"
                                                                        data-toggle="modal"
                                                                        data-target="#infoModal{{ $solicitud->id }}"
                                                                        style="font-size: 12; padding: 5%;">
                                                                        <i class="fas fa-info-circle"></i>
                                                                        Detalles</a>

                                                                </td>

                                                                <!-- Modal de Información -->
                                                                <div class="modal fade"
                                                                    id="infoModal{{ $solicitud->id }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="infoModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="infoModalLabel">
                                                                                    Información
                                                                                    de la solicitud</h5>
                                                                                <button class="close" type="button"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>

                                                                            <div
                                                                                class="modal-body d-flex justify-content-between">
                                                                                <div class="text-wrap">
                                                                                    <strong>ID:</strong>
                                                                                    {{ $solicitud->id }}<br>
                                                                                    <strong>Respuestas:</strong>
                                                                                    {{ $solicitud->respuestas }}<br>
                                                                                    <strong>Marca:</strong>
                                                                                    {{ $solicitud->marca }}<br>
                                                                                    <strong>Referencia:</strong>
                                                                                    {{ $solicitud->referencia }}
                                                                                    <br>
                                                                                    <strong>Modelo:</strong>
                                                                                    {{ $solicitud->modelo }}
                                                                                    <br>
                                                                                    <strong>Transmisión:</strong>
                                                                                    {{ $solicitud->tipo_de_transmision }}
                                                                                    <br>
                                                                                    <strong>Repuesto:</strong>
                                                                                    {{ $solicitud->repuesto }}
                                                                                    <br>
                                                                                    <strong>Imagen del repuesto:</strong>
                                                                                    @if ($solicitud->img_repuesto == 'No se subió ningun archivo')
                                                                                        No hay imagen
                                                                                    @elseif($solicitud->img_repuesto)
                                                                                        <a title="Ver imagen del repuesto"
                                                                                            data-toggle="modal"
                                                                                            data-target="#imgModal{{ $solicitud->id }}"
                                                                                            href="#">Ver
                                                                                            Imagen</a>
                                                                                    @else
                                                                                        No hay imagen
                                                                                    @endif
                                                                                    <br>
                                                                                    <strong>Comentarios del
                                                                                        cliente:</strong>
                                                                                    @if ($solicitud->comentario)
                                                                                        {{ $solicitud->comentario }}
                                                                                    @else
                                                                                        No hay comentarios
                                                                                    @endif
                                                                                    <br>
                                                                                    <strong>Nombre:</strong>
                                                                                    {{ $solicitud->nombre }} <br>
                                                                                    <strong>Correo electronico:</strong>
                                                                                    {{ $solicitud->correo }} <br>
                                                                                    <strong>Celular:</strong>
                                                                                    {{ $solicitud->numero }} <br>
                                                                                    <strong>Departamento:</strong>
                                                                                    {{ $solicitud->departamento }} <br>
                                                                                    <strong>Municipio:</strong>
                                                                                    {{ $solicitud->municipio }} <br>
                                                                                    <strong>Estado de solicitud:</strong>
                                                                                    @if ($solicitud->estado)
                                                                                        Activa
                                                                                    @else
                                                                                        Inactiva
                                                                                    @endif
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
                                                                                <button class="btn btn-secondary"
                                                                                    type="button"
                                                                                    data-dismiss="modal">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Modal de Imagen -->
                                                                <div style="max-height: 100vh; max-width: 100vw;"
                                                                    class="modal fade" id="imgModal{{ $solicitud->id }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="imgModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document"
                                                                        style="max-width: 1000px !important;">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="imgModalLabel">
                                                                                    Imagen del repuesto</h5>
                                                                                <button class="close" type="button"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>

                                                                            <div
                                                                                class="modal-body d-flex justify-content-center">
                                                                                <div class="text-wrap">
                                                                                    <div
                                                                                        style="display: flex; justify-content: center; box-sizing: border-box">
                                                                                        <img src="{{ asset("storage/$solicitud->img_repuesto") }}"
                                                                                            alt="imagen"
                                                                                            style="height: 100%; width: 100%;">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-secondary"
                                                                                    type="button"
                                                                                    data-dismiss="modal">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <!-- Modal para eliminar -->
                                                                <div class="modal fade"
                                                                    id="eraseModal{{ $solicitud->id }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="eraseModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="eraseModalLabel{{ $solicitud->id }}">
                                                                                    Eliminar solicitud</h5>
                                                                                <button class="close" type="button"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Seguro que deseas eliminar esta
                                                                                solicitud?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-secondary"
                                                                                    type="button"
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
                                                                
                                                                // Verifica si $solicitudAnswers no es nulo antes de usar el método where()
                                                                $solicitudAnswers = $answers[$solicitud->id] ?? null;
                                                                
                                                                $proveedorHaRespondido = false;
                                                                
                                                                if ($solicitudAnswers) {
                                                                    // Ahora puedes usar el método where() de manera segura
                                                                    $proveedorHaRespondido = $solicitudAnswers->where('idProveedor', $proveedorId)->isNotEmpty();
                                                                }
                                                            @endphp
                                                            <tr class="@if ($proveedorHaRespondido) bg-green @endif">
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="id" data-valor="{{ $solicitud->id }}">
                                                                    <span style="font-size: 14;"
                                                                        id="id_{{ $solicitud->id }}">{{ $solicitud->id }}</span>
                                                                </td>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="respuestas"
                                                                    data-valor="{{ $solicitud->respuestas }}">
                                                                    <span style="font-size: 14;"
                                                                        id="respuestas_{{ $solicitud->respuestas }}">{{ $solicitud->respuestas }}</span>
                                                                </td>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="marca"
                                                                    data-valor="{{ $solicitud->marca }}">
                                                                    <span style="font-size: 14;"
                                                                        id="marca_{{ $solicitud->marca }}">{{ $solicitud->marca }}</span>
                                                                </td>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="referencia"
                                                                    data-valor="{{ $solicitud->referencia }}">
                                                                    <span style="font-size: 14;"
                                                                        id="referencia_{{ $solicitud->referencia }}">{{ $solicitud->referencia }}</span>
                                                                </td>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="modelo"
                                                                    data-valor="{{ $solicitud->modelo }}">
                                                                    <span style="font-size: 14;"
                                                                        id="modelo_{{ $solicitud->modelo }}">{{ $solicitud->modelo }}</span>
                                                                </td>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="repuesto"
                                                                    data-valor="{{ $solicitud->repuesto }}">
                                                                    <span style="font-size: 14;"
                                                                        id="repuesto_{{ $solicitud->repuesto }}">{{ $solicitud->repuesto }}</span>
                                                                </td>
                                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                    data-campo="estado"
                                                                    data-valor="{{ $solicitud->estado }}">
                                                                    <span style="font-size: 14;"
                                                                        id="estado_{{ $solicitud->estado }}">
                                                                        @if ($solicitud->estado)
                                                                            Activa
                                                                        @else
                                                                            Inactiva
                                                                        @endif
                                                                    </span>
                                                                </td>
                                                                <td style="padding:0px; width: 6vw;" class="text-center">
                                                                    @if (auth()->user()->hasRole('Proveedor'))
                                                                        <a title="Ver detalles"
                                                                            href="{{ route('solicitud', [$solicitud->codigo, $proveedor]) }}"
                                                                            class="btn btn-primary">
                                                                            Detalles
                                                                        </a>
                                                                    @else
                                                                        <a title="Ver detalles" class="btn btn-primary"
                                                                            data-toggle="modal"
                                                                            data-target="#infoModal{{ $solicitud->id }}"
                                                                            style="font-size: 12; padding: 5%;">
                                                                            <i class="fas fa-info-circle"></i>
                                                                            Detalles</a>
                                                                    @endif
                                                                </td>

                                                                <!-- Modal de Información -->
                                                                <div class="modal fade"
                                                                    id="infoModal{{ $solicitud->id }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="infoModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="infoModalLabel">
                                                                                    Información
                                                                                    de la solicitud</h5>
                                                                                <button class="close" type="button"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>

                                                                            <div
                                                                                class="modal-body d-flex justify-content-between">
                                                                                <div class="text-wrap">
                                                                                    <strong>ID:</strong>
                                                                                    {{ $solicitud->id }}<br>
                                                                                    <strong>Respuestas:</strong>
                                                                                    {{ $solicitud->respuestas }}<br>
                                                                                    <strong>Marca:</strong>
                                                                                    {{ $solicitud->marca }}<br>
                                                                                    <strong>Referencia:</strong>
                                                                                    {{ $solicitud->referencia }}
                                                                                    <br>
                                                                                    <strong>Modelo:</strong>
                                                                                    {{ $solicitud->modelo }}
                                                                                    <br>
                                                                                    <strong>Transmisión:</strong>
                                                                                    {{ $solicitud->tipo_de_transmision }}
                                                                                    <br>
                                                                                    <strong>Repuesto:</strong>
                                                                                    {{ $solicitud->repuesto }}
                                                                                    <br>
                                                                                    <strong>Imagen del repuesto:</strong>
                                                                                    @if ($solicitud->img_repuesto == 'No se subió ningun archivo')
                                                                                        No hay imagen
                                                                                    @elseif($solicitud->img_repuesto)
                                                                                        <a title="Ver imagen del repuesto"
                                                                                            data-toggle="modal"
                                                                                            data-target="#imgModal{{ $solicitud->id }}"
                                                                                            href="#">Ver
                                                                                            Imagen</a>
                                                                                    @else
                                                                                        No hay imagen
                                                                                    @endif
                                                                                    <br>
                                                                                    <strong>Comentarios del
                                                                                        cliente:</strong>
                                                                                    @if ($solicitud->comentario)
                                                                                        {{ $solicitud->comentario }}
                                                                                    @else
                                                                                        No hay comentarios
                                                                                    @endif
                                                                                    <br>
                                                                                    <strong>Nombre:</strong>
                                                                                    {{ $solicitud->nombre }} <br>
                                                                                    <strong>Correo electronico:</strong>
                                                                                    {{ $solicitud->correo }} <br>
                                                                                    <strong>Celular:</strong>
                                                                                    {{ $solicitud->numero }} <br>
                                                                                    <strong>Departamento:</strong>
                                                                                    {{ $solicitud->departamento }} <br>
                                                                                    <strong>Municipio:</strong>
                                                                                    {{ $solicitud->municipio }} <br>
                                                                                    <strong>Estado de solicitud:</strong>
                                                                                    @if ($solicitud->estado)
                                                                                        Activa
                                                                                    @else
                                                                                        Inactiva
                                                                                    @endif
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
                                                                                <button class="btn btn-secondary"
                                                                                    type="button"
                                                                                    data-dismiss="modal">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Modal de Imagen -->
                                                                <div style="min-height: 100vh; min-width: 100vw;"
                                                                    class="modal fade" id="imgModal{{ $solicitud->id }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="imgModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document"
                                                                        style="max-width: 1000px !important;">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="imgModalLabel">
                                                                                    Imagen del repuesto</h5>
                                                                                <button class="close" type="button"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>

                                                                            <div
                                                                                class="modal-body d-flex justify-content-center">
                                                                                <div class="text-wrap">
                                                                                    <div
                                                                                        style="display: flex; justify-content: center; box-sizing: border-box">
                                                                                        <img src="{{ asset("storage/$solicitud->img_repuesto") }}"
                                                                                            alt="imagen"
                                                                                            style="height: 100%; width: 100%;">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-secondary"
                                                                                    type="button"
                                                                                    data-dismiss="modal">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <!-- Modal para eliminar -->
                                                                <div class="modal fade"
                                                                    id="eraseModal{{ $solicitud->id }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="eraseModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="eraseModalLabel{{ $solicitud->id }}">
                                                                                    Eliminar solicitud</h5>
                                                                                <button class="close" type="button"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Seguro que deseas eliminar esta
                                                                                solicitud?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-secondary"
                                                                                    type="button"
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
                                        <div class="text-center" style="display: flex; justify-content: flex-end;">
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
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

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

<script>
    function ordenarTabla(campo) {
        var table = document.getElementById("solicitudesTable");
        var rows = Array.from(table.getElementsByTagName("tr"));

        // Remover la primera fila (encabezado) de la lista de filas
        rows.shift();

        // Ordenar las filas según el campo seleccionado
        rows.sort(function(a, b) {
            var valueA = obtenerValorCampo(a, campo);
            var valueB = obtenerValorCampo(b, campo);

            if (valueA < valueB) {
                return -1;
            } else if (valueA > valueB) {
                return 1;
            } else {
                return 0;
            }
        });

        // Agregar las filas ordenadas de nuevo a la tabla
        for (var i = 0; i < rows.length; i++) {
            table.appendChild(rows[i]);
        }
    }

    function obtenerValorCampo(row, campo) {
        var cell = row.querySelector("[data-campo='" + campo + "']");
        if (cell) {
            return cell.getAttribute("data-valor");
        }
        return "";
    }
</script>

<script>
    setTimeout(function() {
        var registrationMessage = document.getElementById('registration-message');
        if (registrationMessage) {
            registrationMessage.remove();
        }
    }, 5000);
</script>

<script>
    setTimeout(function() {
        var Message = document.getElementById('message-error');
        if (Message) {
            Message.remove();
        }
    }, 8000);
</script>
