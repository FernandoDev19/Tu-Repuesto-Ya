@extends('layouts.baseAdmin')

@section('title', 'Tu Repuesto Ya - Respuestas')

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
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Componentes</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="{{ route('viewSolicitudes') }}">Solicitudes</a>
                <a class="collapse-item active" href="{{route('viewRespuestas')}}">Respuestas</a>
            </div>
        </div>
    </li>

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
                                    <h1 class="font-weight-bold text-primary">Lista de Respuestas</h1>
                                    <form method="GET" class="form-inline">
                                        <div class="form-group mb-2">
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" id="search" name="search" placeholder="Buscar..." >
                                              <button class="btn btn-outline-primary" type="submit" id="btn_search">Buscar</button>
                                            </div>
                                        </div>
                                    </form>
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
                            <div class="table-responsive">
                                        <table class="table table-borderless table-hover" id="respuestasTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-muted" style="padding:10px 5px; text-align:center;">Id
                                                    </th>
                                                    <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Nº solicitud
                                                    </th>
                                                    <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Proveedor</th>
                                                    <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Repuesto</th>
                                                    <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Tipo de repuesto</th>
                                                    <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Precio</th>
                                                    <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Garantía</th>
                                                    <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Fecha de creación</th>
                                                    <th class="text-muted" style="padding:10px 5px; text-align:center;">
                                                        Detalles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($respuestas->isEmpty())
                                                    <tr>
                                                        <td
                                                            style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                        <td
                                                            style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($respuestas as $respuesta)
                                                    @php
                                                        $json_nombres = $respuesta->solicitud->img_repuesto;
                                                        $nombres = json_decode($json_nombres);

                                                        $array_de_repuestos_answ = json_decode($respuesta->repuesto, true);
                                                        $repuesto_for_answ = is_array($array_de_repuestos_answ) ? implode(', ', $array_de_repuestos_answ) : $array_de_repuestos_answ;

                                                        $array_de_repuestos_soli = json_decode($respuesta->solicitud->repuesto, true);
                                                        $repuesto_for_soli = is_array($array_de_repuestos_soli) ? implode(', ', $array_de_repuestos_soli) : $array_de_repuestos_soli;
                                                    @endphp
                                                        <tr>
                                                            <td style="padding:10px 10px; margin:0; text-align:center;"
                                                                data-campo="id" data-valor="{{ $respuesta->id }}">
                                                                <span style="font-size: 14;"
                                                                    id="id_{{ $respuesta->id }}">{{ $respuesta->id }}</span>
                                                            </td>
                                                            <td style="padding:10px 10px; margin:0; text-align:center;"
                                                                data-campo="idSolicitud"
                                                                data-valor="{{ $respuesta->idSolicitud }}">
                                                                <a title="Ver detalles de solicitud" data-toggle="modal"
                                                                    data-target="#solicitudModal{{ $respuesta->id }}"
                                                                    style="font-size: 14; color: #858796; text-decoration: underline; cursor: pointer;"
                                                                    id="idSolicitud_{{ $respuesta->idSolicitud }}">{{ $respuesta->idSolicitud }}</a>
                                                            </td>

                                                            <td style="padding:10px 10px; margin:0; text-align:center;"
                                                                data-campo="razon_social"
                                                                data-valor="{{ $respuesta->proveedor->razon_social }}">
                                                                <a title="Ver detalles del proveedor" data-toggle="modal"
                                                                    data-target="#providerModal{{ $respuesta->id }}"
                                                                    style="font-size: 14; color: #858796; text-decoration: underline; cursor: pointer;"
                                                                    id="razon_social_{{ $respuesta->proveedor->razon_social }}">{{ $respuesta->proveedor->razon_social }}</a>
                                                            </td>

                                                            <td style="padding:10px 10px; margin:0; text-align:center;"
                                                                data-campo="repuesto"
                                                                data-valor="{{ $repuesto_for_answ }}">
                                                                <span style="font-size: 14;"
                                                                    id="repuesto_{{ $repuesto_for_answ }}">{{ $repuesto_for_answ }}</span>
                                                            </td>

                                                            <td style="padding:10px 10px; margin:0; text-align:center;"
                                                                data-campo="tipo_repuesto"
                                                                data-valor="{{ $respuesta->tipo_repuesto }}">
                                                                <span style="font-size: 14;"
                                                                    id="tipo_repuesto_{{ $respuesta->tipo_repuesto }}">{{ $respuesta->tipo_repuesto }}</span>
                                                            </td>

                                                            <td style="padding:10px 10px; margin:0; text-align:center;"
                                                                data-campo="precio"
                                                                data-valor="{{ $respuesta->precio }}">
                                                                <span style="font-size: 14;"
                                                                    id="precio_{{ $respuesta->precio }}">{{ $respuesta->precio }}</span>
                                                            </td>

                                                            <td style="padding:10px 10px; margin:0; text-align:center;"
                                                                data-campo="garantia"
                                                                data-valor="{{ $respuesta->garantia }}">
                                                                <span style="font-size: 14;"
                                                                    id="garantia_{{ $respuesta->garantia }}">{{ $respuesta->garantia }}</span>
                                                            </td>

                                                            <td style="padding:10px 10px; margin:0; text-align:center;"
                                                                data-campo="created_at"
                                                                data-valor="{{ $respuesta->created_at }}">
                                                                <span style="font-size: 14;"
                                                                    id="created_at_{{ $respuesta->created_at }}">{{ $respuesta->created_at->diffForHumans() }}</span>
                                                            </td>

                                                            <td style="padding:10px; width: 6vw;" class="text-center">
                                                                <a title="Ver detalles" class="btn btn-primary"
                                                                    data-toggle="modal"
                                                                    data-target="#infoModal{{ $respuesta->id }}"
                                                                    style="font-size: 14; padding: 5%;">
                                                                    <i class="fas fa-info-circle"></i>
                                                                    </a>
                                                            </td>

                                                            <!-- Modal de Información de la Respuesta -->
                                                            <div class="modal fade" id="infoModal{{ $respuesta->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="infoModalLabel" aria-hidden="true">
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

                                                                        <div
                                                                            class="modal-body d-flex justify-content-between">
                                                                                <div class="text-wrap w-100">
                                                                                <ul style="padding-left: 2rem;">
                                                                                    <fieldset>
                                                                                        <legend style="text-align: center;"><strong>Información General:</strong></legend>
                                                                                        <li><strong>ID:</strong>
                                                                                        {{ $respuesta->id }}</li>

                                                                                        <li><strong>Nº de solicitud:</strong>
                                                                                        <a class="text-primary"
                                                                                            title="Ver detalles de solicitud"
                                                                                            data-toggle="modal"
                                                                                            data-target="#solicitudModal{{ $respuesta->id }}"
                                                                                            style="font-size: 14; cursor: pointer;">{{ $respuesta->idSolicitud }}</a></li>

                                                                                        <li><strong>Proveedor:</strong>
                                                                                <a class="text-primary"
                                                                                    title="Ver detalles del proveedor"
                                                                                    data-toggle="modal"
                                                                                    data-target="#providerModal{{ $respuesta->id }}"
                                                                                    style="font-size: 14; cursor: pointer;">{{ $respuesta->proveedor->razon_social }}</a></li>
                                                                                    </fieldset>

                                                                                    <hr>

                                                                                    <fieldset>
                                                                                        <legend style="text-align: center;"><strong>Detalles de la Cotización:</strong></legend>
                                                                                        <li><strong>Repuesto:</strong>
                                                                                {{ $repuesto_for_answ }}</li>

                                                                                        <li><strong>Tipo de repuesto:</strong>
                                                                                {{ $respuesta->tipo_repuesto }}</li>

                                                                                        <li><strong>Precio:</strong>
                                                                                {{ $respuesta->precio }}</li>

                                                                                        <li><strong>Garantía:</strong>
                                                                                {{ $respuesta->garantia }}</li>
                                                                                    </fieldset>

                                                                                    <hr>

                                                                                    <fieldset>
                                                                                        <legend style="text-align: center;"><strong>Comentarios:</strong></legend>
                                                                                        <li><strong>Comentarios del proveedor:</strong>
                                                                                {{ $respuesta->comentarios }}</li>
                                                                                    </fieldset>

                                                                                    <hr>

                                                                                    <fieldset>
                                                                                        <legend style="text-align: center;"><strong>Comentarios:</strong></legend>
                                                                                        <li><strong>Fecha de creación:</strong>
                                                                                {{ $respuesta->created_at }}</li>
                                                                                    </fieldset>
                                                                                </ul>

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

                                                            <!-- Modal de Información del proveedor -->
                                                            <div class="modal fade"
                                                                id="providerModal{{ $respuesta->id }}" tabindex="-1"
                                                                role="dialog" aria-labelledby="providerModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="providerModalLabel">
                                                                                Información
                                                                                del proveedor</h5>
                                                                            <button class="close" type="button"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>

                                                                        <div
                                                                            class="modal-body d-flex justify-content-between">
                                                                            <div id="{{$respuesta->id}}" class="text-wrap">
                                                                        <strong>NIT:</strong>
                                                                        {{ $respuesta->proveedor->nit_empresa }}<br>
                                                                        <strong>Razón Social:</strong>
                                                                        {{ $respuesta->proveedor->razon_social }}<br>
                                                                        <strong>Pais:</strong>
                                                                        {{ $respuesta->proveedor->pais }}<br>
                                                                        <strong>Departamento:</strong>
                                                                        {{ $respuesta->proveedor->departamento }}<br>
                                                                        <strong>Municipio:</strong>
                                                                        {{ $respuesta->proveedor->municipio }}
                                                                        <br>
                                                                        <strong>Direccion:</strong>
                                                                        {{ $respuesta->proveedor->direccion }}
                                                                        <br>
                                                                        <strong>Celular:</strong>
                                                                        {{$respuesta->proveedor->celular}}
                                                                        <br>
                                                                        <strong>Telefono:</strong>
                                                                        {{ $respuesta->proveedor->telefono }}
                                                                        <br>
                                                                        <strong>Representante Legal:</strong>
                                                                        {{ $respuesta->proveedor->representante_legal }}
                                                                        <br>
                                                                        <strong>Contacto Principal:</strong>
                                                                        {{ $respuesta->proveedor->contacto_principal }}
                                                                        <br>
                                                                        <strong>Preferencia de Marcas:</strong>
                                                                        @if(isset($preferencias_de_marcas[$respuesta->proveedor->id]))
                                                                            {{ implode(', ', $preferencias_de_marcas[$respuesta->proveedor->id]) }}
                                                                        @else
                                                                            No hay preferencias de marcas para este proveedor.
                                                                        @endif
                                                                        <br>
                                                                        <strong>Email:</strong>
                                                                        {{ $respuesta->proveedor->email }} <br>
                                                                        <strong>Email Secundario:</strong>
                                                                        {{ $respuesta->proveedor->email_secundario }} <br>
                                                                        @php
                                                                            $especialidades[$respuesta->proveedor->id] = json_decode($respuesta->proveedor->especialidad, true);
                                                                        @endphp
                                                                        <strong>Especialidad:</strong>
                                                                        @if(isset($especialidades[$respuesta->proveedor->id]))
                                                                            {{ implode(', ', $especialidades[$respuesta->proveedor->id]) }}
                                                                        @else
                                                                            No hay preferencias de marcas para este proveedor.
                                                                        @endif
                                                                        <br>

                                                                        <strong>RUT:</strong>
                                                                        {{ $respuesta->proveedor->rut }} <br>
                                                                        <strong>Camara de
                                                                            comercio:</strong>
                                                                        {{ $respuesta->proveedor->camara_comercio }}
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

                                                            <!-- Modal de Información de la solicitud -->
                                                                <div class="modal fade"
                                                                    id="solicitudModal{{ $respuesta->id }}" tabindex="-1"
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
                                                                                <div class="text-wrap w-100">
                                                                                    <ul style="padding-left: 2rem;">
                                                                                        <fieldset>
                                                                                            <legend style="text-align: center;"><strong>Información General:</strong></legend>
                                                                                            <li><strong>ID: </strong>{{ $respuesta->solicitud->id }}</li>

                                                                                            <li><strong>Estado de solicitud:</strong>
                                                                                            @if ($respuesta->solicitud->estado)
                                                                                                Activa
                                                                                            @else
                                                                                                Inactiva
                                                                                            @endif</li>

                                                                                            <li><strong>Respuestas:</strong>
                                                                                    {{ $respuesta->solicitud->respuestas }}</li>
                                                                                        </fieldset>

                                                                                        <hr>

                                                                                        <fieldset>
                                                                                            <legend style="text-align: center;"><strong>Detalles de la Solicitud:</strong></legend>
                                                                                             <li><strong>Marca: </strong>{{ $respuesta->solicitud->marca }}</li>

                                                                                            <li><strong>Referencia: </strong>{{ $respuesta->solicitud->referencia }}</li>

                                                                                            <li><strong>Modelo: </strong>{{ $respuesta->solicitud->modelo }}</li>

                                                                                            <li><strong>Transmisión: </strong>{{ $respuesta->solicitud->tipo_de_transmision }}</li>

                                                                                            <li><strong>Repuesto: </strong>{{ $repuesto_for_soli }}</li>

                                                                                            <li><strong>Imagen del repuesto: </strong>
                                                                                            @if (is_array($nombres) && in_array('No se subió ningun archivo', $nombres))
                                                                                                No hay imagen
                                                                                            @else
                                                                                                <a title="Ver imagen del repuesto"
                                                                                                    data-toggle="modal"
                                                                                                    data-target="#imgModal{{ $respuesta->solicitud->id }}"
                                                                                                    href="#">Ver
                                                                                                    Imagen</a>
                                                                                            @endif</li>

                                                                                            <li><strong>Comentarios del cliente: </strong>
                                                                                            @if ($respuesta->solicitud->comentario)
                                                                                                {{ $respuesta->solicitud->comentario }}
                                                                                            @else
                                                                                                No hay comentarios
                                                                                            @endif</li>
                                                                                        </fieldset>

                                                                                        <hr>

                                                                                        <fieldset>
                                                                                            <legend style="text-align: center;"><strong>Información de Contacto:</strong></legend>
                                                                                            <li><strong>Nombre:</strong>
                                                                                            {{ $respuesta->solicitud->nombre }} </li>

                                                                                                <li><strong>Correo electronico:</strong>
                                                                                            {{ $respuesta->solicitud->correo }} </li>

                                                                                                <li><strong>Celular:</strong>
                                                                                            {{ $respuesta->solicitud->numero }} </li>
                                                                                        </fieldset>

                                                                                        <hr>

                                                                                        <fieldset>
                                                                                            <legend style="text-align: center;"><strong>Ubicación:</strong></legend>
                                                                                            <li><strong>Departamento:</strong>
                                                                                            {{ $respuesta->solicitud->departamento }} </li>

                                                                                                <li><strong>Municipio:</strong>
                                                                                            {{ $respuesta->solicitud->municipio }} </li>
                                                                                        </fieldset>

                                                                                    </ul>

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

                                                            <!-- Modal de Imagen -->
                                                                <div class="modal" id="imgModal{{$respuesta->id}}" tabindex="-1" role="dialog">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Imágenes del repuesto</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @if (!empty($nombres))
                                                                                    <div id="carouselModal" class="carousel slide" data-ride="carousel">
                                                                                        <ol class="carousel-indicators">
                                                                                            @foreach ($nombres as $i => $imagen)
                                                                                                <li data-target="#carouselModal" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
                                                                                            @endforeach
                                                                                        </ol>
                                                                                        <div class="carousel-inner">
                                                                                            @foreach ($nombres as $i => $imagen)
                                                                                                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                                                                                    <img src='{{ asset("storage/$imagen") }}' alt="{{ $imagen }}" class="img-fluid">
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                        <a class="carousel-control-prev" href="#carouselModal" role="button" data-slide="prev">
                                                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                            <span class="sr-only">Anterior</span>
                                                                                        </a>
                                                                                        <a class="carousel-control-next" href="#carouselModal" role="button" data-slide="next">
                                                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
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

                                                        </tr>
                                                    @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                        <!-- Botones de paginación -->
                                        <div class="text-center" style="display: flex;">
                                            <ul class="pagination">
                                                <!-- Botón "Anterior" -->
                                                @if ($respuestas->onFirstPage())
                                                    <li class="page-item disabled"><span class="page-link">&laquo;</span>
                                                    </li>
                                                @else
                                                    <li class="page-item"><a href="{{ $respuestas->previousPageUrl() }}"
                                                            class="page-link" rel="prev">&laquo;</a>
                                                    </li>
                                                @endif

                                                <!-- Números de página -->
                                                @foreach ($respuestas->getUrlRange(1, $respuestas->lastPage()) as $page => $url)
                                                    @if ($page == $respuestas->currentPage())
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
                                                @if ($respuestas->hasMorePages())
                                                    <li class="page-item"><a href="{{ $respuestas->nextPageUrl() }}"
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

<script>
    $(document).ready(function() {
        $('#proveedoresTable').DataTable();
    });
</script>

@endsection
