@extends('layouts.baseAdmin')

@section('title', 'Solicitudes | Tu Repuesto Ya')

<style>
    .bg-green {
        background-color: rgb(157, 232, 157);
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
                                <h1 class="font-weight-bold text-primary">Bolsa de oportunidades</h1>
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

                                         @if (auth()->user()->hasRole('Admin'))
                                            <th class="text-muted" style="padding: 10px 5px; text-align: center;">Enviado</th>
                                            <th class="text-muted" style="color: #12e912 !important; padding:10px 5px; text-align:center;">
                                                Respuestas
                                            </th>
                                            <th class="text-muted" style="color: #ff5a51 !important; padding: 10px 5px; text-align: center;">Agotado</th>
                                        @endif

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
                                                        data-campo="enviado" data-valor="enviado{{$solicitud->id}}">
                                                        @if($messages)
                                                            @php
                                                                $usuariosUnicos = [];
                                                                $contadorUsuarios = 0;
                                                            @endphp
                                                            @foreach ($messages as $message)
                                                                @if ($message->idSolicitud == $solicitud->id && !in_array($message->idUser, $usuariosUnicos))
                                                                    @php
                                                                        $usuariosUnicos[] = $message->idUser;
                                                                        $contadorUsuarios++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                            <a style="font-size: 14; cursor: pointer;" data-toggle="modal" class="text-primary" data-target="#mostrarDestinatarios{{$solicitud->id}}">{{ $contadorUsuarios }}</a>
                                                        @endif
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="respuestas" data-valor="{{ $solicitud->respuestas }}">
                                                        <a style="font-size: 14;" data-toggle="modal" data-target="#respuestasModal{{ $solicitud->id }}" href="#"
                                                            id="respuestas_{{ $solicitud->respuestas }}">{{ $solicitud->respuestas }}</a>
                                                    </td>
                                                    <td style="padding: 10px; margin: 0; text-align: center;" data-campo="agotado" data-valor="agotado{{$solicitud->id}}">
                                                        @if (is_array(json_decode($solicitud->agotado, true)))
                                                            @php
                                                                $countAgotado = 0;
                                                            @endphp
                                                            @foreach (json_decode($solicitud->agotado, true) as $agotado)
                                                                @php
                                                                    $countAgotado++;
                                                                @endphp
                                                            @endforeach
                                                            <a style="font-size: 14;" data-toggle="modal" data-target="#agotadosModal{{ $solicitud->id }}" href="#"
                                                                id="agotado">{{ $countAgotado }}</a>
                                                        @else
                                                            No hay datos
                                                        @endif
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
                                                        $array_de_categorias = json_decode($solicitud->categoria, true);

                                                        $repuesto_for_soli = is_array($array_de_repuestos) ? implode(', ', $array_de_repuestos) : $array_de_repuestos;
                                                        $categoria_for_soli = is_array($array_de_categorias) ? implode(', ', $array_de_categorias) : $array_de_categorias;

                                                    ?>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="repuesto" data-valor="{{ $repuesto_for_soli }}">
                                                        <span style="font-size: 14;"
                                                            id="repuesto_{{ $repuesto_for_soli }}">{{ $repuesto_for_soli }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="fecha"
                                                        data-valor="{{ $solicitud->created_at }}">
                                                        <span style="font-size: 14;"
                                                            id="fecha_{{ $solicitud->id }}">{{ $solicitud->created_at }}</span>
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
                                                        aria-hidden="true" style="overflow: auto !important;">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="infoModalLabel">
                                                                        <strong>Información
                                                                            de la solicitud</strong>
                                                                    </h5>
                                                                    <button id="close-modal-info{{ $solicitud->id }}" class="close" type="button"
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
                                                                                        <i title="Estado activo" class="fas fa-circle" style="color:#12e912;"> Activa</i>
                                                                                    @else
                                                                                        <i title="Estado inactivo" class="fas fa-circle" style="color:#ff5a51;"> Inactiva</i>
                                                                                    @endif
                                                                                </li>
                                                                                <li><strong>Respuestas:</strong>
                                                                                    <a data-toggle="modal" data-target="#respuestasModal{{ $solicitud->id }}" href="#">
                                                                                        {{ $solicitud->respuestas }}
                                                                                    </a>
                                                                                </li>
                                                                                <li><strong>Enviado a:</strong>
                                                                                    @if($messages)
                                                                                        @php
                                                                                            $usuariosUnicos = [];
                                                                                            $contadorUsuarios = 0;
                                                                                        @endphp
                                                                                        @foreach ($messages as $message)
                                                                                            @if ($message->idSolicitud == $solicitud->id && !in_array($message->idUser, $usuariosUnicos))
                                                                                                @php
                                                                                                    $usuariosUnicos[] = $message->idUser;
                                                                                                    $contadorUsuarios++;
                                                                                                @endphp
                                                                                            @endif
                                                                                        @endforeach
                                                                                        <a  data-toggle="modal" class="text-primary" data-target="#mostrarDestinatarios{{$solicitud->id}}" style="cursor: pointer;">{{ $contadorUsuarios }}</a>
                                                                                    @endif
                                                                                </li>
                                                                                <li><strong>Fecha:</strong>
                                                                                    {{ $solicitud->created_at }}</li>
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
                                                                                <li><strong>Categoria: </strong>{{ $categoria_for_soli }}</li>

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
                                                                                    <a title="Contactar"
                                                                                        data-toggle="modal" class="text-primary"
                                                                                        data-target="#contactarClienteModal{{$solicitud->id}}"
                                                                                        style="cursor: pointer;">{{ $solicitud->numero }}</a>
                                                                                </li>
                                                                            </fieldset>

                                                                            <hr>

                                                                            <fieldset>
                                                                                <legend style="text-align: center;">
                                                                                    <strong>Ubicación:</strong></legend>
                                                                                <li><strong>País: </strong>{{ $solicitud->pais }}</li>
                                                                                <li><strong>Departamento:</strong>
                                                                                    {{ $solicitud->departamento }} </li>

                                                                                <li><strong>Municipio:</strong>
                                                                                    {{ $solicitud->municipio }} </li>

                                                                            </fieldset>

                                                                            <hr>

                                                                            <fieldset>
                                                                                <legend style="text-align: center;">
                                                                                    <strong>Mensajes recibidos:</strong></legend>
                                                                                    @foreach ($viewMessages as $messagess)
                                                                                        @if ($messagess->celular == $solicitud->numero)
                                                                                            <li><strong>{{$messagess->created_at}}</strong>: {{ $messagess->mensaje }}</li>
                                                                                        @endif
                                                                                    @endforeach

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

                                                    {{-- Mostrar destinatarios --}}
                                                    <div class="modal fade" id="mostrarDestinatarios{{ $solicitud->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="destinatariosModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="destinatariosModalLabel">
                                                                        <strong>Destinatarios (Nombres)</strong>
                                                                    </h5>
                                                                    <button id="close-modal-destinatarios{{ $solicitud->id }}" class="close" type="button"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body d-flex justify-content-between">
                                                                    <div class="text-wrap w-100">
                                                                        Si el nombre del proveedor está en <span style="color: #12e912;">verde</span>, es porque ha cotizado, y si está en <span style="color: #ff5a51;">rojo</span> es porque no. <br>
                                                                        <ul class="mt-2" style="padding-left: 2rem;">
                                                                            @if($messages)
                                                                                @php
                                                                                    $idsVistos = [];
                                                                                @endphp
                                                                                @foreach ($messages as $message)
                                                                                    @if ($message->idSolicitud == $solicitud->id && !in_array($message->idUser, $idsVistos))
                                                                                    @php
                                                                                        $proveedor = $proveedores->where('id', $message->idUser)->first();
                                                                                    @endphp
                                                                                    <li><a data-toggle="modal" class="text-primary" data-target="#infoProveedorModal{{ $message->idUser}}" @if($proveedor->ha_cotizado)style="cursor: pointer; color: #12e912 !important;" @else style="cursor: pointer; color: #ff5a51 !important;" @endif>{{ $proveedor->razon_social }}</a></li>
                                                                                        @php
                                                                                            $idsVistos[] = $message->idUser;
                                                                                        @endphp
                                                                                         <div class="modal fade" id="infoProveedorModal{{ $message->idUser}}"
                                                                                            tabindex="-2" role="dialog" aria-labelledby="infoProveedorModalLabel"
                                                                                            aria-hidden="true" >
                                                                                            <div class="modal-dialog" role="document" >
                                                                                                <div class="modal-content" >
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title"
                                                                                                            id="infoProveedorModalLabel">
                                                                                                            <strong>Información
                                                                                                                del Proveedor</strong>
                                                                                                        </h5>
                                                                                                        <button id="close-modal-providers{{ $message->idUser }}" class="close" type="button"
                                                                                                            data-dismiss="modal" aria-label="Close proveedor modal">
                                                                                                            <span aria-hidden="true">×</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <div class="modal-body d-flex justify-content-between"
                                                                                                        style="overflow-y: auto;">
                                                                                                        <div class="text-wrap w-100">
                                                                                                            @php
                                                                                                                $especialidades[$proveedor->id] = json_decode($proveedor->especialidad, true);
                                                                                                                $preferencias_de_marcas[$proveedor->id] = json_decode($proveedor->marcas_preferencias, true);
                                                                                                            @endphp
                                                                                                            <ul style="padding-left: 2rem;">
                                                                                                                <fieldset>
                                                                                                                    <legend style="text-align: center;">
                                                                                                                        <strong>Información Básica:</strong>
                                                                                                                    </legend>
                                                                                                                    <li><strong>NIT:
                                                                                                                        </strong>{{ $proveedor->nit_empresa }}
                                                                                                                    </li>

                                                                                                                    <li><strong>Nombre Establecimiento: </strong>
                                                                                                                        {{ $proveedor->nombre_comercial }}
                                                                                                                    </li>

                                                                                                                    <li><strong>Razón Social:
                                                                                                                        </strong>{{ $proveedor->razon_social }}
                                                                                                                    </li>

                                                                                                                    <li><strong>Pais:
                                                                                                                        </strong>{{ $proveedor->pais }}</li>

                                                                                                                    <li><strong>Departamento:
                                                                                                                        </strong>{{ $proveedor->departamento }}
                                                                                                                    </li>

                                                                                                                    <li> <strong>Municipio:
                                                                                                                        </strong>{{ $proveedor->municipio }}</li>

                                                                                                                    <li><strong>Direccion:
                                                                                                                        </strong>{{ $proveedor->direccion }}</li>
                                                                                                                </fieldset>

                                                                                                                <hr>

                                                                                                                <fieldset>
                                                                                                                    <legend style="text-align: center;">
                                                                                                                        <strong>Información de Contacto:</strong>
                                                                                                                    </legend>
                                                                                                                    <li><strong>Celular:</strong>
                                                                                                                        <a title="Contactar" target="_blank" href="https://api.whatsapp.com/send?phone={{ substr($proveedor->celular, 1) }}" style="cursor: pointer;">{{ $proveedor->celular }}</a>
                                                                                                                    </li>
                                                                                                                    <li><strong>Celular 2°:
                                                                                                                        </strong><a title="Contactar" target="_blank" href="https://api.whatsapp.com/send?phone={{ substr($proveedor->celular, 1) }}" style="cursor: pointer;">{{ $proveedor->telefono }}</a></li>

                                                                                                                    <li><strong>Representante Legal:
                                                                                                                        </strong>{{ $proveedor->representante_legal }}
                                                                                                                    </li>

                                                                                                                    <li><strong>Contacto Principal:
                                                                                                                        </strong>{{ $proveedor->contacto_principal }}
                                                                                                                    </li>

                                                                                                                    <li><strong>Email:</strong>
                                                                                                                        <a href="mailto:{{$proveedor->email}}" target="_blank">{{ $proveedor->email }}</a>
                                                                                                                    </li>

                                                                                                                    <li><strong>Email Secundario:</strong>
                                                                                                                        <a href="mailto:{{$proveedor->email_secundario}}" target="_blank">{{ $proveedor->email_secundario }}</a>
                                                                                                                    </li>
                                                                                                                </fieldset>

                                                                                                                <hr>

                                                                                                                <fieldset>
                                                                                                                    <legend style="text-align: center;">
                                                                                                                        <strong>Información Legal:</strong>
                                                                                                                    </legend>
                                                                                                                    <li><strong>RUT: </strong>
                                                                                                                        <a title="Ver RUT"
                                                                                                                            rel="noopener noreferrer"
                                                                                                                            id="rut"
                                                                                                                            style="color: #858796; text-decoration: underline;"
                                                                                                                            href="{{ route('mostrarArchivo', ['filename' => 'RUT_' . $proveedor->nit_empresa . '.pdf']) }}"
                                                                                                                            target="_blank">{{ $proveedor->rut }}</a>
                                                                                                                    </li>

                                                                                                                    <li><strong>Camara de comercio: </strong>
                                                                                                                        <a title="Ver camara de comercio"
                                                                                                                            style="color: #858796; text-decoration: underline;"
                                                                                                                            id="camara"
                                                                                                                            rel="noopener noreferrer"
                                                                                                                            href="{{ route('mostrarArchivo', 'Camara_de_comercio_' . $proveedor->nit_empresa . '.pdf') }}"
                                                                                                                            target="_blank">{{ $proveedor->camara_comercio }}</a>
                                                                                                                    </li>
                                                                                                                </fieldset>

                                                                                                                <hr>

                                                                                                                <fieldset>
                                                                                                                    <legend style="text-align: center;">
                                                                                                                        <strong>Otros Detalles:</strong>
                                                                                                                    </legend>
                                                                                                                    <li><strong>Preferencia de Marcas: </strong>
                                                                                                                        @if (isset($preferencias_de_marcas[$proveedor->id]))
                                                                                                                            {{ implode(', ', $preferencias_de_marcas[$proveedor->id]) }}
                                                                                                                        @else
                                                                                                                            No hay preferencias de marcas para este
                                                                                                                            proveedor.
                                                                                                                        @endif
                                                                                                                    </li>
                                                                                                                    <li><strong>Especialidad: </strong>
                                                                                                                        @if (isset($especialidades[$proveedor->id]))
                                                                                                                            {{ implode(', ', $especialidades[$proveedor->id]) }}
                                                                                                                        @else
                                                                                                                            No hay preferencias de marcas para este
                                                                                                                            proveedor.
                                                                                                                        @endif
                                                                                                                    </li>
                                                                                                                </fieldset>
                                                                                                                <br>
                                                                                                            </ul>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                    <div class="modal-footer">
                                                                                                        <button class="btn btn-secondary btnCloseModalDetalles" type="button"
                                                                                                            data-dismiss="modal">Cerrar</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif

                                                                                @endforeach
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Mostrar proveedores con los repuestos agotados --}}
                                                    <div class="modal fade" id="agotadosModal{{ $solicitud->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="agotadosModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        <strong>Respuestas (Nombres)</strong>
                                                                    </h5>
                                                                    <button id="close-modal-agotados{{ $solicitud->id }}" class="close" type="button"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body d-flex justify-content-between">
                                                                    <div class="text-wrap w-100">

                                                                        <ul class="mt-2" style="padding-left: 2rem;">
                                                                            @if (is_array(json_decode($solicitud->agotado, true)))
                                                                                @php
                                                                                    $countAgotado = 0;
                                                                                @endphp
                                                                                @foreach (json_decode($solicitud->agotado, true) as $agotado)
                                                                                    @php
                                                                                        $nombre_proveedor = $proveedores->where('id', $agotado)->first();
                                                                                    @endphp
                                                                                    <a style="font-size: 14;" data-toggle="modal" data-target="#infoProveedorAgotadosModal{{ $nombre_proveedor->id }}" href="#"
                                                                                        id="agotado">{{ $nombre_proveedor->razon_social }}</a>

                                                                                        <div class="modal fade" id="infoProveedorAgotadosModal{{ $nombre_proveedor->id}}"
                                                                                            tabindex="-2" role="dialog" aria-labelledby="infoProveedorModalLabel"
                                                                                            aria-hidden="true" >
                                                                                            <div class="modal-dialog" role="document" >
                                                                                                <div class="modal-content" >
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title"
                                                                                                            id="infoProveedorAgotadosModalLabel">
                                                                                                            <strong>Información
                                                                                                                del Proveedor</strong>
                                                                                                        </h5>
                                                                                                        <button id="close-modal-providers{{ $nombre_proveedor->id }}" class="close" type="button"
                                                                                                            data-dismiss="modal" aria-label="Close proveedor modal">
                                                                                                            <span aria-hidden="true">×</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <div class="modal-body d-flex justify-content-between"
                                                                                                        style="overflow-y: auto;">
                                                                                                        <div class="text-wrap w-100">
                                                                                                            @php
                                                                                                                $especialidades[$nombre_proveedor->id] = json_decode($nombre_proveedor->especialidad, true);
                                                                                                                $preferencias_de_marcas[$nombre_proveedor->id] = json_decode($nombre_proveedor->marcas_preferencias, true);
                                                                                                            @endphp
                                                                                                            <ul style="padding-left: 2rem;">
                                                                                                                <fieldset>
                                                                                                                    <legend style="text-align: center;">
                                                                                                                        <strong>Información Básica:</strong>
                                                                                                                    </legend>
                                                                                                                    <li><strong>NIT:
                                                                                                                        </strong>{{ $nombre_proveedor->nit_empresa }}
                                                                                                                    </li>

                                                                                                                    <li><strong>Nombre Establecimiento: </strong>
                                                                                                                        {{ $nombre_proveedor->nombre_comercial }}
                                                                                                                    </li>

                                                                                                                    <li><strong>Razón Social:
                                                                                                                        </strong>{{ $nombre_proveedor->razon_social }}
                                                                                                                    </li>

                                                                                                                    <li><strong>Pais:
                                                                                                                        </strong>{{ $nombre_proveedor->pais }}</li>

                                                                                                                    <li><strong>Departamento:
                                                                                                                        </strong>{{ $nombre_proveedor->departamento }}
                                                                                                                    </li>

                                                                                                                    <li> <strong>Municipio:
                                                                                                                        </strong>{{ $nombre_proveedor->municipio }}</li>

                                                                                                                    <li><strong>Direccion:
                                                                                                                        </strong>{{ $nombre_proveedor->direccion }}</li>
                                                                                                                </fieldset>

                                                                                                                <hr>

                                                                                                                <fieldset>
                                                                                                                    <legend style="text-align: center;">
                                                                                                                        <strong>Información de Contacto:</strong>
                                                                                                                    </legend>
                                                                                                                    <li><strong>Celular:</strong>
                                                                                                                        <a title="Contactar" target="_blank" href="https://api.whatsapp.com/send?phone={{ substr($nombre_proveedor->celular, 1) }}" style="cursor: pointer;">{{ $nombre_proveedor->celular }}</a>
                                                                                                                    </li>
                                                                                                                    <li><strong>Celular 2°:
                                                                                                                        </strong><a title="Contactar" target="_blank" href="https://api.whatsapp.com/send?phone={{ substr($nombre_proveedor->celular, 1) }}" style="cursor: pointer;">{{ $nombre_proveedor->telefono }}</a></li>

                                                                                                                    <li><strong>Representante Legal:
                                                                                                                        </strong>{{ $nombre_proveedor->representante_legal }}
                                                                                                                    </li>

                                                                                                                    <li><strong>Contacto Principal:
                                                                                                                        </strong>{{ $nombre_proveedor->contacto_principal }}
                                                                                                                    </li>

                                                                                                                    <li><strong>Email:</strong>
                                                                                                                        <a href="mailto:{{$nombre_proveedor->email}}" target="_blank">{{ $nombre_proveedor->email }}</a>
                                                                                                                    </li>

                                                                                                                    <li><strong>Email Secundario:</strong>
                                                                                                                        <a href="mailto:{{$nombre_proveedor->email_secundario}}" target="_blank">{{ $nombre_proveedor->email_secundario }}</a>
                                                                                                                    </li>
                                                                                                                </fieldset>

                                                                                                                <hr>

                                                                                                                <fieldset>
                                                                                                                    <legend style="text-align: center;">
                                                                                                                        <strong>Información Legal:</strong>
                                                                                                                    </legend>
                                                                                                                    <li><strong>RUT: </strong>
                                                                                                                        <a title="Ver RUT"
                                                                                                                            rel="noopener noreferrer"
                                                                                                                            id="rut"
                                                                                                                            style="color: #858796; text-decoration: underline;"
                                                                                                                            href="{{ route('mostrarArchivo', ['filename' => 'RUT_' . $nombre_proveedor->nit_empresa . '.pdf']) }}"
                                                                                                                            target="_blank">{{ $nombre_proveedor->rut }}</a>
                                                                                                                    </li>

                                                                                                                    <li><strong>Camara de comercio: </strong>
                                                                                                                        <a title="Ver camara de comercio"
                                                                                                                            style="color: #858796; text-decoration: underline;"
                                                                                                                            id="camara"
                                                                                                                            rel="noopener noreferrer"
                                                                                                                            href="{{ route('mostrarArchivo', 'Camara_de_comercio_' . $nombre_proveedor->nit_empresa . '.pdf') }}"
                                                                                                                            target="_blank">{{ $nombre_proveedor->camara_comercio }}</a>
                                                                                                                    </li>
                                                                                                                </fieldset>

                                                                                                                <hr>

                                                                                                                <fieldset>
                                                                                                                    <legend style="text-align: center;">
                                                                                                                        <strong>Otros Detalles:</strong>
                                                                                                                    </legend>
                                                                                                                    <li><strong>Preferencia de Marcas: </strong>
                                                                                                                        @if (isset($preferencias_de_marcas[$nombre_proveedor->id]))
                                                                                                                            {{ implode(', ', $preferencias_de_marcas[$nombre_proveedor->id]) }}
                                                                                                                        @else
                                                                                                                            No hay preferencias de marcas para este
                                                                                                                            proveedor.
                                                                                                                        @endif
                                                                                                                    </li>
                                                                                                                    <li><strong>Especialidad: </strong>
                                                                                                                        @if (isset($especialidades[$nombre_proveedor->id]))
                                                                                                                            {{ implode(', ', $especialidades[$nombre_proveedor->id]) }}
                                                                                                                        @else
                                                                                                                            No hay preferencias de marcas para este
                                                                                                                            proveedor.
                                                                                                                        @endif
                                                                                                                    </li>
                                                                                                                </fieldset>
                                                                                                                <br>
                                                                                                            </ul>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                    <div class="modal-footer">
                                                                                                        <button class="btn btn-secondary btnCloseModalDetalles" type="button"
                                                                                                            data-dismiss="modal">Cerrar</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                @endforeach

                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal" id="contactarClienteModal{{$solicitud->id}}" tabindex="-1"
                                                        role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Contactar cliente</h5>
                                                                    <button id="close-modal-contactar{{ $solicitud->id }}" type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="d-flex justify-content-between" style="flex-direction: column; gap: 1rem;">
                                                                        <a class="btn btn-success" target="_blank" href="https://api.whatsapp.com/send?phone={{ substr($solicitud->numero, 1) }}">Enviar mensaje</a>
                                                                        <a class="btn btn-primary" target="_blank" href="tel:{{ $solicitud->numero }}">Llamar</a>
                                                                    </div>

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
                                                                    <button id="close-modal-img{{ $solicitud->id }}" type="button" class="close"
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
                                                                    <button id="close-modal-erase{{ $solicitud->id }}" class="close" type="button"
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

                                                    <!-- Modal de respuestas -->
                                                    <div class="modal fade" id="respuestasModal{{ $solicitud->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="respuestasModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="respuestasModalLabel">
                                                                        <strong>Respuestas (Nombres)</strong>
                                                                    </h5>
                                                                    <button id="close-modal-respuestas{{ $solicitud->id }}" class="close" type="button"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body d-flex justify-content-between">
                                                                    <div class="text-wrap w-100">
                                                                        <ul style="padding-left: 2rem;">
                                                                            @if($answer2)
                                                                                @foreach ($answer2 as $answer)
                                                                                    @if ($answer->idSolicitud == $solicitud->id)
                                                                                        <li>{{$answer->proveedor->razon_social}}</li>
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif

                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Cerrar</button>
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
                                                        data-valor="{{ $solicitud->created_at }}">
                                                        <span style="font-size: 14;"
                                                            id="fecha_{{ $solicitud->id }}">{{ $solicitud->created_at }}</span>
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
                                                                <a title="Cotizar"
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
                                                        aria-hidden="true" style="overflow: auto !important;">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="infoModalLabel">
                                                                        <strong>Información
                                                                            de la solicitud</strong>
                                                                    </h5>
                                                                    <button id="close-modal-info{{ $solicitud->id }}" class="close" type="button"
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
                                                                                        <i title="Estado activo" class="fas fa-circle" style="color:#12e912;"> Activa</i>
                                                                                    @else
                                                                                        <i title="Estado inactivo" class="fas fa-circle" style="color:#ff5a51;"> Inactiva</i>
                                                                                    @endif
                                                                                </li>
                                                                                <li><strong>Fecha:</strong>
                                                                                    {{ $solicitud->created_at }}</li>
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
                                                                                    <a title="Contactar"
                                                                                        data-toggle="modal" class="text-primary"
                                                                                        data-target="#contactarClienteModal{{$solicitud->id}}"
                                                                                        style="cursor: pointer;">{{ $solicitud->numero }}</a>
                                                                                </li>
                                                                            </fieldset>

                                                                            <hr>

                                                                            <fieldset>
                                                                                <legend style="text-align: center;">
                                                                                    <strong>Ubicación:</strong></legend>
                                                                                <li><strong>País: </strong>{{ $solicitud->pais }}</li>
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


                                                    <div class="modal" id="contactarClienteModal{{$solicitud->id}}" tabindex="-1"
                                                        role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Contactar cliente</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="d-flex justify-content-between" style="flex-direction: column; gap: 1rem;">
                                                                        <a class="btn btn-success" target="_blank" href="https://api.whatsapp.com/send?phone={{ substr($solicitud->numero, 1) }}">Enviar mensaje</a>
                                                                        <a class="btn btn-primary" target="_blank" href="tel:{{ $solicitud->numero }}">Llamar</a>
                                                                    </div>

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
                            {{$solicitudes->links()}}
                            {{-- <div class="text-center" style="display: flex;">
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
                            </div> --}}
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
