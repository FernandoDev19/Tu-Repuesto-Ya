@extends('layouts.baseAdmin')

@section('title', 'Proveedores | Tu Repuesto Ya')

<style>
    .hide {
        display: none;
    }

    .paso_activo{
    font-weight: 600; color: #5593E8 !important;
}

    .items_container {
        min-height: 50px;
        height: auto !important;
        width: 100%;
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
        gap: 2%;
    }

    .item_selected {
        min-width: 70px;
        height: max-content;
        border-radius: .25rem;
        border: 1px solid lightgray;
        margin: 3px;
        font-weight: 600;
        padding: 1.5% 5%;
        background-color: lightgray;
        text-align: center;
        transition: all 0.3s ease;
    }

    .btn_borrar_item {
        color: lightgray;
        transform: translate(10px, 0);
        transition: all 300ms ease;
        display: inline-block;
    }

    .item_selected:hover {
        border: 1px solid gray;
    }

    .item_selected:hover .btn_borrar_item {
        color: black;
    }
</style>

<!-- Sidebar -->
@section('sidebar')
    <nav
    class="navbar navbar-expand navbar-light bg-white shadow topbar static-top d-flex justify-content-center">

    <!-- Topbar Navbar -->
    <ul class="navbar-nav">

        <li class="nav-item">
            <a class="nav-link" style="color: var(--gray); padding: 0 .50rem; gap: 3px;" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"> </i>
                <span class="nav-items-cel-small"> Panel</span></a>
        </li>

        @can('providers.loadProviders')
            <li class="nav-item">
                <a href="{{ route('loadProviders') }}" class="nav-link" style="padding: 0 .50rem; color:#4e73df; gap: 3px;"><i
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

@section('content')

    <div class="container-fluid h-100">
        <div class="row h-100 justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between;">
                            <div class="p-3">
                                <h2 class="header-title font-weight-bold text-primary">Lista de proveedores</h2>
                                <form method="GET" class="form-inline">
                                    <div class="form-group mb-2">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="search" name="search"
                                                placeholder="Buscar...">
                                            <button class="btn btn-outline-primary" type="submit"
                                                id="btn_search">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <a title="Descargar lista de proveedores" href="{{ route('proveedores.excel') }}"
                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                        <i class="fas fa-download fa-sm text-white-50"></i> Descargar
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body" style="padding: 0;">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover" id="proveedoresTable">
                                <thead>
                                    <tr>
                                        <th class="text-muted"
                                            style="padding:10px 5px; text-align:center; font-size: 14px;">NIT
                                        </th>
                                        <th class="text-muted" style="padding: 10px 5px; text-align: center; font-size: 14px;">
                                            Nombre Establecimiento</th>
                                        <th class="text-muted"
                                            style="padding:10px 5px; text-align:center; font-size: 14px;">Razón
                                            Social</th>
                                        <th class="text-muted"
                                            style="padding:10px 5px; text-align:center; font-size: 14px;">
                                            Celular</th>
                                        <th class="text-muted"
                                            style="padding:10px 5px; text-align:center; font-size: 14px;">
                                            Departamento</th>
                                        <th class="text-muted"
                                            style="padding:10px 5px; text-align:center; font-size: 14px;">
                                            Municipio</th>
                                        <th class="text-muted"
                                            style="padding:10px 5px; text-align:center; font-size: 14px;">RUT
                                        </th>
                                        <th class="text-muted"
                                            style="padding:10px 5px; text-align:center; font-size: 14px;">C.
                                            Comercio</th>
                                        <th class="text-muted"
                                            style="padding:10px 5px; text-align:center; font-size: 14px;">
                                            Estado</th>
                                        <th class="text-muted"
                                            style="padding:10px 5px; text-align:center; font-size: 14px;">
                                            Detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($proveedor->isEmpty())
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
                                            <td style="padding:10px 10px; margin:0; text-align:center; line-height: 1;">
                                                No hay registros
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($proveedor as $proveedores)
                                            <tr>
                                                <td style="padding:10px 10px; margin:0; text-align:center;"
                                                    data-campo="nit_empresa" data-valor="{{ $proveedores->nit_empresa }}">
                                                    <span style="font-size: 14;"
                                                        id="nit_empresa_{{ $proveedores->id }}">{{ $proveedores->nit_empresa }}</span>
                                                </td>
                                                <td style="padding: 10px; margin: 0; text-align: center;" data-campo="nombre_comercial" data-valor="{{$proveedores->nombre_comercial}}">
                                                    <span style="font-size: 14px;" id="nombre_comercial_{{$proveedores->id}}">{{ $proveedores->nombre_comercial }}</span>
                                                </td>
                                                <td style="padding:10px 10px; margin:0; text-align:center;"
                                                    data-campo="razon_social" data-valor="{{ $proveedores->razon_social }}">
                                                    <span style="font-size: 14;"
                                                        id="razon_social_{{ $proveedores->id }}">{{ $proveedores->razon_social }}</span>
                                                    <input type="text" id="razon_social_input_{{ $proveedores->id }}"
                                                        class="form-control d-none"
                                                        value="{{ $proveedores->razon_social }}">
                                                </td>
                                                <td style="padding:10px 10px; margin:0; text-align:center;"
                                                    data-campo="celular" data-valor="{{ $proveedores->celular }}">
                                                    <span style="font-size: 14;"
                                                        id="celular_{{ $proveedores->id }}">{{ $proveedores->celular }}</span>
                                                    <input type="text" id="celular_input_{{ $proveedores->id }}"
                                                        class="form-control d-none" value="{{ $proveedores->celular }}"
                                                        placeholder="$proveedores->celular">
                                                </td>
                                                <td style="padding:10px 10px; margin:0; text-align:center;"
                                                    data-campo="departamento"
                                                    data-valor="{{ $proveedores->departamento }}">
                                                    <span style="font-size: 14;"
                                                        id="departamento_{{ $proveedores->id }}">{{ $proveedores->departamento }}</span>
                                                    <input type="text" id="departamento_input_{{ $proveedores->id }}"
                                                        class="form-control d-none"
                                                        value="{{ $proveedores->departamento }}">
                                                </td>
                                                <td style="padding:10px 10px; margin:0; text-align:center;"
                                                    data-campo="municipio" data-valor="{{ $proveedores->municipio }}">
                                                    <span style="font-size: 14;"
                                                        id="municipio_{{ $proveedores->id }}">{{ $proveedores->municipio }}</span>
                                                    <input type="text" id="municipio_input_{{ $proveedores->id }}"
                                                        class="form-control d-none"
                                                        value="{{ $proveedores->municipio }}">
                                                </td>
                                                <td style="padding:10px 10px; margin:0; text-align:center;">
                                                    <a title="Ver RUT" rel="noopener noreferrer"
                                                        id="rut_{{ $proveedores->id }}"
                                                        style="font-size: 14; color: #858796; text-decoration: underline;"
                                                        href="{{ route('mostrarArchivo', ['filename' => 'RUT_' . $proveedores->nit_empresa . '.pdf']) }}"
                                                        target="_blank">RUT</a>
                                                </td>
                                                <td style="padding:10px 10px; margin:0; text-align:center; font-size: 14;">
                                                    <a title="Ver camara de comercio"
                                                        style="color: #858796; text-decoration: underline;"
                                                        id="camara_{{ $proveedores->id }}" rel="noopener noreferrer"
                                                        href="{{ route('mostrarArchivo', 'Camara_de_comercio_' . $proveedores->nit_empresa . '.pdf') }}"
                                                        target="_blank">C. Comercio</a>
                                                </td>
                                                <td style="padding:10px 10px; margin:0; text-align:center; font-size: 14;"
                                                    data-campo="estado" id="estado_{{ $proveedores->id }}"
                                                    data-valor="{{ $proveedores->estado ? 'Activo' : 'Inactivo' }}">
                                                    @if ($proveedores->estado)
                                                        <i class="fas fa-circle" style="color:#12e912;;"></i>
                                                    @else
                                                        <i class="fas fa-circle" style="color:#ff5a51;"></i>
                                                    @endif
                                                </td>
                                                <td style="padding:10px; width: 6vw;" class="text-center">
                                                    <a title="Ver detalles" class="btn btn-primary" data-toggle="modal"
                                                        id="verDetalles_{{ $proveedores->id }}"
                                                        data-target="#infoModal{{ $proveedores->id }}"
                                                        style="font-size: 14; padding: 5%;">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </td>

                                                <!-- Modal de Información -->
                                                <div class="modal fade" id="infoModal{{ $proveedores->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="infoModalLabel"
                                                    aria-hidden="true" style="z-index: 1041;">
                                                    <div class="modal-dialog" role="document" style="z-index: 1042;">
                                                        <div class="modal-content" style="z-index: 1043;">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="infoModalLabel{{ $proveedores->id }}">
                                                                    <strong>Información
                                                                        del Proveedor</strong>
                                                                </h5>
                                                                <button class="close" type="button"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body d-flex justify-content-between"
                                                                style="overflow-y: auto;">
                                                                <div id="{{ $proveedores->id }}" class="text-wrap w-100">
                                                                    @php
                                                                        $especialidades[$proveedores->id] = json_decode($proveedores->especialidad, true);
                                                                    @endphp
                                                                    <ul style="padding-left: 2rem;">
                                                                        <fieldset>
                                                                            <legend style="text-align: center;">
                                                                                <strong>Información Básica:</strong>
                                                                            </legend>
                                                                            <li><strong>NIT:
                                                                                </strong>{{ $proveedores->nit_empresa }}
                                                                            </li>

                                                                            <li><strong>Nombre Establecimiento: </strong>
                                                                                {{ $proveedores->nombre_comercial }}
                                                                            </li>

                                                                            <li><strong>Razón Social:
                                                                                </strong>{{ $proveedores->razon_social }}
                                                                            </li>

                                                                            <li><strong>Pais:
                                                                                </strong>{{ $proveedores->pais }}</li>

                                                                            <li><strong>Departamento:
                                                                                </strong>{{ $proveedores->departamento }}
                                                                            </li>

                                                                            <li> <strong>Municipio:
                                                                                </strong>{{ $proveedores->municipio }}</li>

                                                                            <li><strong>Direccion:
                                                                                </strong>{{ $proveedores->direccion }}</li>
                                                                        </fieldset>

                                                                        <hr>

                                                                        <fieldset>
                                                                            <legend style="text-align: center;">
                                                                                <strong>Información de Contacto:</strong>
                                                                            </legend>
                                                                            <li><strong>Celular:
                                                                                </strong>{{ $proveedores->celular }}</li>

                                                                            <li><strong>Celular 2°:
                                                                                </strong>{{ $proveedores->telefono }}</li>

                                                                            <li><strong>Representante Legal:
                                                                                </strong>{{ $proveedores->representante_legal }}
                                                                            </li>

                                                                            <li><strong>Contacto Principal:
                                                                                </strong>{{ $proveedores->contacto_principal }}
                                                                            </li>

                                                                            <li><strong>Email:
                                                                                </strong>{{ $proveedores->email }}</li>

                                                                            <li><strong>Email Secundario:
                                                                                </strong>{{ $proveedores->email_secundario }}
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
                                                                                    href="{{ route('mostrarArchivo', ['filename' => 'RUT_' . $proveedores->nit_empresa . '.pdf']) }}"
                                                                                    target="_blank">{{ $proveedores->rut }}</a>
                                                                            </li>

                                                                            <li><strong>Camara de comercio: </strong>
                                                                                <a title="Ver camara de comercio"
                                                                                    style="color: #858796; text-decoration: underline;"
                                                                                    id="camara"
                                                                                    rel="noopener noreferrer"
                                                                                    href="{{ route('mostrarArchivo', 'Camara_de_comercio_' . $proveedores->nit_empresa . '.pdf') }}"
                                                                                    target="_blank">{{ $proveedores->camara_comercio }}</a>
                                                                            </li>
                                                                        </fieldset>

                                                                        <hr>

                                                                        <fieldset>
                                                                            <legend style="text-align: center;">
                                                                                <strong>Otros Detalles:</strong>
                                                                            </legend>
                                                                            <li><strong>Preferencia de Marcas: </strong>
                                                                                @if (isset($preferencias_de_marcas[$proveedores->id]))
                                                                                    {{ implode(', ', $preferencias_de_marcas[$proveedores->id]) }}
                                                                                @else
                                                                                    No hay preferencias de marcas para este
                                                                                    proveedor.
                                                                                @endif
                                                                            </li>
                                                                            <li><strong>Especialidad: </strong>
                                                                                @if (isset($especialidades[$proveedores->id]))
                                                                                    {{ implode(', ', $especialidades[$proveedores->id]) }}
                                                                                @else
                                                                                    No hay preferencias de marcas para este
                                                                                    proveedor.
                                                                                @endif
                                                                            </li>
                                                                        </fieldset>
                                                                        <br>
                                                                    </ul>

                                                                </div>

                                                                <button class="btn mt-0 align-self-end"
                                                                    data-id="{{ $proveedores->id }}" data-toggle="modal"
                                                                    data-target="#editModal{{ $proveedores->id }}"
                                                                    >
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div>

                                                            <div class="modal-footer">

                                                                <button class="btn btn-danger"
                                                                    data-id="{{ $proveedores->id }}" data-toggle="modal"
                                                                    data-target="#eraseModal{{ $proveedores->id }}"
                                                                    >
                                                                    Eliminar
                                                                </button>
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade editModal" id="editModal{{ $proveedores->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                                    aria-hidden="true" style="z-index: 1041;">

                                                    <div class="modal-dialog" role="document" style="z-index: 1042;">
                                                        <div class="modal-content" style="z-index: 1043;">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editModalLabel{{ $proveedores->id }}">
                                                                    Editar proveedor</h5>
                                                                <button class="close" type="button"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Pestañas del formulario -->
                                                                <ul class="nav nav-tabs" id="formTabs">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link text-secondary active paso_activo" href="#" id="tab1_{{$proveedores->id}}">Inf. básica</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link text-secondary" href="#" id="tab2_{{$proveedores->id}}">Contacto</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link text-secondary" href="#" id="tab3_{{$proveedores->id}}">Inf. legal</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link text-secondary" href="#" id="tab4_{{$proveedores->id}}">Marcas</a>
                                                                    </li>
                                                                </ul>

                                                                <!-- Contenido de las pestañas -->
                                                                <div class="tab-content">
                                                                    <form id="edit_modal{{ $proveedores->id }}"
                                                                        action="{{ route('editarProveedor') }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf

                                                                        <input type="hidden" name="id"
                                                                        value="{{ $proveedores->id }}">

                                                                        <!-- Parte 1 del formulario -->
                                                                        <div class="tab-pane fade show active" id="tab-content1_{{$proveedores->id}}"
                                                                            style="transition: all 300ms ease;">

                                                                            <div class="form-group">

                                                                                <div class="form-group">
                                                                                    <label for="nit_edit_{{ $proveedores->id }}">NIT:</label>
                                                                                    <input class="form-control" type="text"
                                                                                        id="nit_edit_{{ $proveedores->id }}"
                                                                                        name="nit_edit"
                                                                                        placeholder="{{ $proveedores->nit_empresa }}"
                                                                                        value="{{ $proveedores->nit_empresa }}"
                                                                                        autocomplete="on">
                                                                                    @error('nit_edit')
                                                                                        <small
                                                                                            class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="nombre_comercial_edit_{{ $proveedores->id }}">Nombre Establecimiento:</label>
                                                                                    <input type="text" class="form-control" id="nombre_comercial_edit_{{ $proveedores->id }}" name="nombre_comercial_edit" placeholder="{{$proveedores->nombre_comercial}}" value="{{$proveedores->nombre_comercial}}" maxlength="50" autocomplete="on">
                                                                                    @error('nombre_comercial_edit')
                                                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="razon_social_edit">Razón
                                                                                        Social:</label>
                                                                                    <input class="form-control" type="text"
                                                                                        id="razon_social_edit{{ $proveedores->id }}"
                                                                                        name="razon_social_edit"
                                                                                        placeholder="{{ $proveedores->razon_social }}"
                                                                                        value="{{ $proveedores->razon_social }}" maxlength="100"
                                                                                        autocomplete="on">
                                                                                    @error('razon_social_edit')
                                                                                        <small
                                                                                            class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>

                                                                                <div id="pais{{ $proveedores->id }}"
                                                                                    class="flex flex-col mb-3 hide">
                                                                                    <label>País:</label>
                                                                                    <div class="form-control">
                                                                                        <span type="text"
                                                                                            id="text-pais_edit{{ $proveedores->id }}"
                                                                                            name="pais"
                                                                                            style="border: none !important;">{{ $proveedores->pais }}</span>
                                                                                    </div>
                                                                                </div>

                                                                                <div id="ciudad{{ $proveedores->id }}"
                                                                                    class="flex flex-col mb-3 hide">
                                                                                    <label for="ciudad_edit">Ciudad:</label>
                                                                                    <input id="ciudad_input_{{ $proveedores->id }}"
                                                                                        type="text" class="form-control"
                                                                                        name="ciudad_edit"
                                                                                        value="{{ $proveedores->municipio }}">
                                                                                </div>

                                                                                <div class="form-group"
                                                                                    id="departamentos{{ $proveedores->id }}">
                                                                                    <label for="departamento">Departamento:</label>
                                                                                    <select id="departamento{{ $proveedores->id }}"
                                                                                        name="departamento_edit"
                                                                                        class="departamento form-control">
                                                                                        <option value="">
                                                                                            Seleccione un departamento
                                                                                        </option>
                                                                                        @foreach ($departamentos as $departamento)
                                                                                            <option value="{{ $departamento }}">
                                                                                                {{ $departamento }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                                <div id="municipios{{ $proveedores->id }}"
                                                                                    class="form-group">
                                                                                    <label for="municipio_edit">Municipio:</label>
                                                                                    <select id="municipio{{ $proveedores->id }}"
                                                                                        name="municipio_edit"
                                                                                        class="municipio form-control">
                                                                                        <option value="">
                                                                                            Seleccione un municipio
                                                                                        </option>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="direccion">Dirección:</label>
                                                                                    <input type="text" class="form-control"
                                                                                        id="direccion{{ $proveedores->id }}"
                                                                                        name="direccion_edit"
                                                                                        placeholder="{{ $proveedores->direccion }}"
                                                                                        value="{{ $proveedores->direccion }}" maxlength="50"
                                                                                        autocomplete="on">
                                                                                </div>

                                                                            </div>

                                                                            <hr>

                                                                            <div
                                                                                style="width:100%; height: max-content; display: flex; justify-content: flex-end;">
                                                                                <button id="btn_siguiente_basica{{$proveedores->id}}" type="button" class="btn btn-primary"
                                                                                   >Siguiente</button>
                                                                            </div>

                                                                        </div>

                                                                        <!-- Parte 2 del formulario -->
                                                                        <div class="tab-pane fade" id="tab-content2_{{$proveedores->id}}" style="transition: all 300ms ease;">

                                                                            <div class="form-group">
                                                                                <div class="form-group">
                                                                                    <label for="cel_edit">Número de celular:</label>
                                                                                    <div class="form-control"
                                                                                        style="display: flex; justify-content: space-between; align-items: center; padding: 0;">
                                                                                        <select name="codigo_cel"
                                                                                            id="codigo-cel{{ $proveedores->id }}"
                                                                                            style="border: none; transform: translate(1.5%, 0px); height: auto;">
                                                                                            @foreach ($codigos as $codigo)
                                                                                                <option value="{{ $codigo->codigo }}"
                                                                                                    title="{{ $codigo->pais }}">
                                                                                                    {{ $codigo->iso . ' ' . $codigo->codigo }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <input type="text" class="form-control"
                                                                                            id="cel_edit_{{ $proveedores->id }}"
                                                                                            name="cel_edit"
                                                                                            value="@if($proveedores->pais=='Colombia'||$proveedores->pais=='Argentina'||$proveedores->pais=='Venezuela'||$proveedores->pais=='Mexico'||$proveedores->pais=='Chile'||$proveedores->pais=='Venezuela'||$proveedores->pais=='Perú'||$proveedores->pais=='Brasil'){{substr($proveedores->celular,3)}}@elseif($proveedores->pais=='Bolivia'||$proveedores->pais=='Perú'||$proveedores->pais=='Ecuador'||$proveedores->pais=='Guayana Francesa'||$proveedores->pais=='Guyana'||$proveedores->pais=='Paraguay'||$proveedores->pais=='Surinam'||$proveedores->pais=='Uruguay'||$proveedores->pais=='Costa Rica'||$proveedores->pais=='El Salvador'||$proveedores->pais=='Guatemala'||$proveedores->pais=='Honduras'||$proveedores->pais=='Nicaragua'||$proveedores->pais=='Panamá'){{substr($proveedores->celular,4)}}@else{{substr($proveedores->celular,3)}}@endif"
                                                                                            autocomplete="on">
                                                                                    </div>
                                                                                    @error('cel')
                                                                                        <p class='text-danger text-xs pt-1'>
                                                                                            {{ $message }}</p>
                                                                                    @else
                                                                                        <div class="w-100 text-center">
                                                                                            <small
                                                                                                class="text-center text-xs text-color-secondary">¡Debe tener Whatsapp! <i class="fa fa-whatsapp"
                                                                                                    aria-hidden="true"
                                                                                                    style="color: #25D366; font-size: 15px; transform: translate(0px, 2.4px);">
                                                                                                </i></small>
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="tel">Número
                                                                                        de celular 2°:</label>
                                                                                    <input type="text" class="form-control"
                                                                                        id="tel{{ $proveedores->id }}"
                                                                                        name="tel_edit"
                                                                                        placeholder="{{ $proveedores->telefono }}"
                                                                                        value="@if($proveedores->pais=='Colombia'||$proveedores->pais=='Argentina'||$proveedores->pais=='Venezuela'||$proveedores->pais=='Mexico'||$proveedores->pais=='Chile'||$proveedores->pais=='Venezuela'||$proveedores->pais=='Perú'||$proveedores->pais=='Brasil'){{substr($proveedores->telefono,3)}}@elseif($proveedores->pais=='Bolivia'||$proveedores->pais=='Perú'||$proveedores->pais=='Ecuador'||$proveedores->pais=='Guayana Francesa'||$proveedores->pais=='Guyana'||$proveedores->pais=='Paraguay'||$proveedores->pais=='Surinam'||$proveedores->pais=='Uruguay'||$proveedores->pais=='Costa Rica'||$proveedores->pais=='El Salvador'||$proveedores->pais=='Guatemala'||$proveedores->pais=='Honduras'||$proveedores->pais=='Nicaragua'||$proveedores->pais=='Panamá'){{substr($proveedores->telefono,4)}}@else{{substr($proveedores->telefono,3)}}@endif"
                                                                                        autocomplete="on">
                                                                                    @error('tel_edit')
                                                                                        <small
                                                                                            class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>

                                                                                <div class="flex flex-col mb-3">
                                                                                    <label for="representante_legal">Representante
                                                                                        Legal:</label>
                                                                                    <input
                                                                                        id="representante_legal_{{ $proveedores->id }}"
                                                                                        type="text" class="form-control"
                                                                                        name="representante_legal"
                                                                                        value="{{ $proveedores->representante_legal }}" maxlength="60" autocomplete="on">
                                                                                </div>

                                                                                <div class="flex flex-col mb-3">
                                                                                    <label for="contacto_principal">Contacto
                                                                                        Principal:</label>
                                                                                    <input
                                                                                        id="contacto_principal_{{ $proveedores->id }}"
                                                                                        type="text" class="form-control"
                                                                                        name="contacto_principal"
                                                                                        value="{{ $proveedores->contacto_principal }}" autocomplete="on">
                                                                                </div>
             <div class="form-group">
                                                                                    <label for="email">Correo
                                                                                        electrónico:</label>
                                                                                    <input type="email" class="form-control"
                                                                                        id="email{{ $proveedores->id }}"
                                                                                        name="email_edit"
                                                                                        placeholder="{{ $proveedores->email }}"
                                                                                        value="{{ $proveedores->email }}"
                                                                                        autocomplete="on">
                                                                                    @error('email_edit')
                                                                                        <small
                                                                                            class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="email_2">Correo
                                                                                        electrónico (2°):</label>
                                                                                    <input type="email" class="form-control"
                                                                                        id="email_2{{ $proveedores->id }}"
                                                                                        name="email_2_edit"
                                                                                        placeholder="{{ $proveedores->email_secundario }}"
                                                                                        value="{{ $proveedores->email_secundario }}"
                                                                                        autocomplete="on">
                                                                                    @error('email_edit')
                                                                                        <small
                                                                                            class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="estado">Estado:</label>
                                                                                    <select class="form-control"
                                                                                        id="estado{{ $proveedores->id }}"
                                                                                        name="estado_edit">
                                                                                        <option value="" disabled selected>
                                                                                            Estado
                                                                                            ({{ $proveedores->estado ? 'Activo' : 'Inactivo' }})
                                                                                        </option>
                                                                                        <option value="1">
                                                                                            Activo</option>
                                                                                        <option value="0">
                                                                                            Inactivo</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div
                                                                                style="width:100%; height: max-content; display: flex; justify-content: flex-end; gap: 5px;">
                                                                                <button type="button" id="btn_anterior_contacto{{$proveedores->id}}" class="btn btn-secondary"
                                                                                    >Anterior</button>
                                                                                <button id="btn_siguiente_contacto{{$proveedores->id}}" type="button" class="btn btn-primary"
                                                                                    >Siguiente</button>
                                                                            </div>

                                                                        </div>

                                                                        <div class="tab-pane fade" id="tab-content3_{{$proveedores->id}}" style="transition: all 300ms ease;">

                                                                            <div class="form-group">
                                                                                <div class="form-group flex flex-col">
                                                                                    <span>RUT:</span>
                                                                                    <label id="btn1{{ $proveedores->id }}"
                                                                                        class="button form-control"
                                                                                        for="rut{{ $proveedores->id }}"
                                                                                        style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                                                        <div id="text_file_rut{{ $proveedores->id }}"
                                                                                            placeholder="{{ $proveedores->rut }}">
                                                                                        </div>
                                                                                        <div><i id="check1{{ $proveedores->id }}"
                                                                                                class="fa fa-check"
                                                                                                aria-hidden="true"></i>
                                                                                        </div>
                                                                                    </label>
                                                                                    <input type="file" accept=".pdf"
                                                                                        name="rut"
                                                                                        id="rut{{ $proveedores->id }}"
                                                                                        class="form-control" aria-label="Rut"
                                                                                        style="display: none;">
                                                                                    @error('rut')
                                                                                        <div class="text-danger text-xs pt-1">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>

                                                                                <div class="form-group flex flex-col">
                                                                                    <span>Camara de comercio:</span>
                                                                                    <label id="btn2{{ $proveedores->id }}"
                                                                                        class="button form-control"
                                                                                        for="cam{{ $proveedores->id }}"
                                                                                        style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                                                        <div id="text_file_cam{{ $proveedores->id }}"
                                                                                            placeholder="{{ $proveedores->camara_comercio }}">
                                                                                        </div>
                                                                                        <div><i id="check2{{ $proveedores->id }}"
                                                                                                class="fa fa-check"
                                                                                                aria-hidden="true"></i></div>
                                                                                    </label>
                                                                                    <input type="file" accept=".pdf"
                                                                                        name="cam"
                                                                                        id="cam{{ $proveedores->id }}"
                                                                                        class="form-control" aria-label="Cam"
                                                                                        style="display: none;">
                                                                                    @error('cam')
                                                                                        <div class="text-danger text-xs pt-1">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div
                                                                                style="width:100%; height: max-content; display: flex; justify-content: flex-end; gap: 5px;">
                                                                                <button type="button" id="btn_anterior_legal{{$proveedores->id}}" class="btn btn-secondary"
                                                                                    >Anterior</button>
                                                                                    <button id="btn_siguiente_legal{{$proveedores->id}}" type="button" class="btn btn-primary"
                                                                                        >Siguiente</button>
                                                                            </div>

                                                                        </div>

                                                                        <div class="tab-pane fade" id="tab-content4_{{$proveedores->id}}" style="transition: all 300ms ease;">

                                                                            <div class="form-group">
                                                                                <div class="flex flex-col">
                                                                                    <label for="marcas">Preferencias de
                                                                                        Marcas:</label>
                                                                                    <select name="marcas"
                                                                                        id="marcas{{ $proveedores->id }}"
                                                                                        class="form-control"
                                                                                        style="color: var(--bs-secondary-color);">
                                                                                        <option value="" disabled selected>
                                                                                            Seleccionar Preferencias</option>
                                                                                        <option value="Todas las marcas">Todas las
                                                                                            marcas</option>
                                                                                        <!--<option value="AKT">AKT</option>-->
                                                                                        <option value="Alfa Romeo">Alfa Romeo
                                                                                        </option>
                                                                                        <option value="Alpine">Alpine</option>
                                                                                        <option value="Aston Martin">Aston Martin
                                                                                        </option>
                                                                                        <!--<option value="Apollo Motors">Apollo Motors</option>-->
                                                                                        <!--<option value="Aprilia">Aprilia</option>-->
                                                                                        <option value="Acura">Acura</option>
                                                                                        <option value="Audi">Audi</option>
                                                                                        <!--<option value="Auteco">Auteco</option>-->
                                                                                        <!--<option value="Ayco">Ayco</option>-->
                                                                                        <option value="BAIC">BAIC</option>
                                                                                        <!--<option value="Bajaj">Bajaj</option>-->
                                                                                        <!--<option value="Benelli">Benelli</option>-->
                                                                                        <option value="Bugatti">Bugatti</option>
                                                                                        <option value="Brabus">Brabus</option>
                                                                                        <option value="BMW">BMW</option>
                                                                                        <option value="BYD">BYD</option>
                                                                                        <!--<option value="CF Moto">CF Moto</option>-->
                                                                                        <option value="Changan">Changan</option>
                                                                                        <option value="Chery">Chery</option>
                                                                                        <option value="Cupra">Cupra</option>
                                                                                        <option value="Chevrolet">Chevrolet
                                                                                        </option>
                                                                                        <option value="Cadillac">Cadillac</option>
                                                                                        <option value="Citroën">Citroën</option>
                                                                                        <option value="Dodge">Dodge</option>
                                                                                        <option value="DFSK">DFSK</option>
                                                                                        <option value="DS">DS</option>
                                                                                        <!--<option value="Ducati">Ducati</option>-->
                                                                                        <!--<option value="FAW">FAW</option>-->
                                                                                        <option value="Fiat">Fiat</option>
                                                                                        <option value="Ferrari">Ferrari</option>
                                                                                        <option value="Ford">Ford</option>
                                                                                        <option value="Foton">Foton</option>
                                                                                        <option value="Great Wall">Great Wall
                                                                                        </option>
                                                                                        <option value="GMC">GMC</option>
                                                                                        <option value="Haval">Haval</option>
                                                                                        <!--<option value="Harley Davidson">Harley Davidson</option>-->
                                                                                        <!--<option value="Hero Motos">Hero Motos</option>-->
                                                                                        <option value="Honda">Honda</option>
                                                                                        <option value="Hummer">Hummer</option>
                                                                                        <option value="Hennessey">Hennessey
                                                                                        </option>
                                                                                        <option value="Hyundai">Hyundai</option>
                                                                                        <option value="Infiniti">Infiniti</option>
                                                                                        <!--<option value="Husqvarna">Husqvarna</option>-->
                                                                                        <option value="JAC">JAC</option>
                                                                                        <!--<option value="Jialing Motos">Jialing Motos</option>-->
                                                                                        <option value="JMC">JMC</option>
                                                                                        <option value="Jeep">Jeep</option>
                                                                                        <!--<option value="Kawasaki">Kawasaki</option>-->
                                                                                        <!--<option value="Keeway">Keeway</option>-->
                                                                                        <option value="Kia">Kia</option>
                                                                                        <!--<option value="KTM">KTM</option>-->
                                                                                        <option value="Kenworth">Kenworth</option>
                                                                                        <option value="Koenigsegg">Koenigsegg
                                                                                        </option>
                                                                                        <!--<option value="Kymco">Kymco</option>-->
                                                                                        <option value="Land Rover">Land Rover
                                                                                        </option>
                                                                                        <option value="Lamborghini">Lamborghini
                                                                                        </option>
                                                                                        <option value="Lexus">Lexus</option>
                                                                                        <option value="Lotus">Lotus</option>
                                                                                        <option value="Lincoln">Lincoln</option>
                                                                                        <!--<option value="Lifan">Lifan</option>-->
                                                                                        <option value="Mahindra">Mahindra</option>
                                                                                        <option value="Mazda">Mazda</option>
                                                                                        <option value="McLaren">McLaren</option>
                                                                                        <option value="Maserati">Maserati</option>
                                                                                        <option value="Mercedes-Benz">Mercedes-Benz
                                                                                        </option>
                                                                                        <option value="MG">MG</option>
                                                                                        <option value="Mini">Mini</option>
                                                                                        <option value="Mitsubishi">Mitsubishi
                                                                                        </option>
                                                                                        <!--<option value="Moto Guzzi Colombia">Moto Guzzi Colombia</option>-->
                                                                                        <option value="Nissan">Nissan</option>
                                                                                        <option value="Opel">Opel</option>
                                                                                        <option value="Peugeot">Peugeot</option>
                                                                                        <option value="Pontiac">Pontiac</option>
                                                                                        <!--<option value="Piaggio">Piaggio</option>-->
                                                                                        <option value="Porsche">Porsche</option>
                                                                                        <option value="Pagani">Pagani</option>
                                                                                        <!--<option value="Pulsar">Pulsar</option>-->
                                                                                        <option value="Renault">Renault</option>
                                                                                        <option value="Rivian">Rivian</option>
                                                                                        <option value="Rolls Royce">Rolls Royce
                                                                                        </option>
                                                                                        <!--<option value="Royal Enfield">Royal Enfield</option>-->
                                                                                        <option value="SEAT">SEAT</option>
                                                                                        <!--<option value="Sherco">Sherco</option>-->
                                                                                        <option value="Skoda">Skoda</option>
                                                                                        <option value="SsangYong">SsangYong
                                                                                        </option>
                                                                                        <!--<option value="Starker">Starker</option>-->
                                                                                        <option value="Subaru">Subaru</option>
                                                                                        <option value="Scania">Scania</option>
                                                                                        <option value="Suzuki">Suzuki</option>
                                                                                        <!--<option value="SYM">SYM</option>-->
                                                                                        <option value="Tesla">Tesla</option>
                                                                                        <option value="Toyota">Toyota</option>
                                                                                        <!--<option value="Triumph">Triumph</option>-->
                                                                                        <!--<option value="TVS">TVS</option>-->
                                                                                        <!--<option value="Vespa">Vespa</option>-->
                                                                                        <option value="Volkswagen">Volkswagen
                                                                                        </option>
                                                                                        <option value="Volvo">Volvo</option>
                                                                                        <!--<option value="Yamaha">Yamaha</option>-->
                                                                                        <!--<option value="Zotye">Zotye</option>-->
                                                                                        <option value="otro">Otro</option>

                                                                                    </select>
                                                                                </div>
                                                                                <div id="marcas_preferencias{{ $proveedores->id }}"
                                                                                    class="marcas_preferencias flex flex-col mb-3">
                                                                                    <div id="items_container{{ $proveedores->id }}"
                                                                                        class="items_container form-control">
                                                                                        @if (is_string($proveedores->marcas_preferencias))
                                                                                            @php
                                                                                                $marcas = json_decode($proveedores->marcas_preferencias);
                                                                                            @endphp
                                                                                            @foreach ($marcas as $marca)
                                                                                                <button type="button" class="item_selected" name="item">{{ $marca }}<span class="btn_borrar_item">×</span></button>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="text-secondary text-xs pt-1">¡Solo
                                                                                        le llegaran solicitudes de las marcas que
                                                                                        elijas!.</div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="flex flex-col mb-3">
                                                                                <label
                                                                                    for="categoria_repuesto{{ $proveedores->id }}">Especialidades:</label>
                                                                                <select
                                                                                    title="Especialidad: ¿En que repuestos se especializa?"
                                                                                    class="form-control" name="categoria_repuesto"
                                                                                    id="categoria_repuesto{{ $proveedores->id }}"
                                                                                    name="categoria_repuesto"
                                                                                    style="color: var(--bs-secondary-color);"
                                                                                    required>
                                                                                    <option value="" disabled selected>
                                                                                        *Seleccionar Especialidad</option>
                                                                                    <option value="Todas las especialidades">Todas
                                                                                        las especialidades</option>
                                                                                    <option value="LLantas">LLantas</option>
                                                                                    <option value="Frenos">Frenos</option>
                                                                                    <option value="Suspensión">Suspensión</option>
                                                                                    <option value="Dirección">Sistema de Dirección</option>
                                                                                    <option value="Motor">Motor</option>
                                                                                    <option value="Latas">Latas</option>
                                                                                    <option value="Refrigeración">Refrigeración</option>
                                                                                    <option value="Eléctricos">Eléctricos
                                                                                    </option>
                                                                                    <option value="otros">Otros</option>
                                                                                </select>
                                                                                <div id="categorias_preferencias{{ $proveedores->id }}"
                                                                                    class="categorias_preferencias flex flex-col mb-3">
                                                                                    <div id="items_container_categorias{{ $proveedores->id }}"
                                                                                        class="items_container form-control">
                                                                                        @if (is_string($proveedores->especialidad))
                                                                                            @php
                                                                                                $preferencias = json_decode($proveedores->especialidad);
                                                                                            @endphp
                                                                                            @foreach ($preferencias as $preferencia)
                                                                                                <button type="button" class="item_selected" name="item_category">{{ $preferencia }}<span class="btn_borrar_item">×</span></button>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </div>
                                                                                    @error('json_marcas')
                                                                                        <div class="text-danger text-xs pt-1">
                                                                                            {{ $message }}</div>
                                                                                    @else
                                                                                        <div class="text-secondary text-xs pt-1">¡Solo
                                                                                            le llegaran solicitudes de las marcas que
                                                                                            elijas!.</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div
                                                                                style="width:100%; height: max-content; display: flex; justify-content: flex-end; gap: 5px;">
                                                                                <button type="button" id="btn_anterior_marcas{{$proveedores->id}}" class="btn btn-secondary"
                                                                                    >Anterior</button>
                                                                                    <button id="btn_submit" type="submit" class="btn btn-primary"
                                                                                        >Guardar todo</button>
                                                                            </div>

                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal de edición -->
                                                {{-- <div class="modal fade editModal" id=""
                                                    tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                                    aria-hidden="true" style="z-index: 1041;">

                                                    <div class="modal-dialog" role="document" style="z-index: 1042;">
                                                        <div class="modal-content" style="z-index: 1043;">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editModalLabel{{ $proveedores->id }}">
                                                                    Editar proveedor</h5>
                                                                <button class="close" type="button"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="edit_modal{{ $proveedores->id }}"
                                                                    action="{{ route('editarProveedor') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf

                                                                    <input type="hidden" name="id"
                                                                        value="{{ $proveedores->id }}">

                                                                    <div class="form-group">
                                                                        <label for="nit_edit_{{ $proveedores->id }}">NIT:</label>
                                                                        <input class="form-control" type="text"
                                                                            id="nit_edit_{{ $proveedores->id }}"
                                                                            name="nit_edit"
                                                                            placeholder="{{ $proveedores->nit_empresa }}"
                                                                            value="{{ $proveedores->nit_empresa }}"
                                                                            autocomplete="on">
                                                                        @error('nit_edit')
                                                                            <small
                                                                                class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="nombre_comercial_edit_{{ $proveedores->id }}">Nombre Establecimiento:</label>
                                                                        <input type="text" class="form-control" id="nombre_comercial_edit_{{ $proveedores->id }}" name="nombre_comercial_edit" placeholder="{{$proveedores->nombre_comercial}}" value="{{$proveedores->nombre_comercial}}" autocomplete="on">
                                                                        @error('nombre_comercial_edit')
                                                                            <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="razon_social_edit">Razón
                                                                            Social:</label>
                                                                        <input class="form-control" type="text"
                                                                            id="razon_social_edit{{ $proveedores->id }}"
                                                                            name="razon_social_edit"
                                                                            placeholder="{{ $proveedores->razon_social }}"
                                                                            value="{{ $proveedores->razon_social }}"
                                                                            autocomplete="on">
                                                                        @error('razon_social_edit')
                                                                            <small
                                                                                class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="cel_edit">Número de celular:</label>
                                                                        <div class="form-control"
                                                                            style="display: flex; justify-content: space-between; align-items: center; padding: 0;">
                                                                            <select name="codigo_cel"
                                                                                id="codigo-cel{{ $proveedores->id }}"
                                                                                style="border: none; transform: translate(1.5%, 0px); height: auto;">
                                                                                @foreach ($codigos as $codigo)
                                                                                    <option value="{{ $codigo->codigo }}"
                                                                                        title="{{ $codigo->pais }}">
                                                                                        {{ $codigo->iso . ' ' . $codigo->codigo }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            <input type="text" class="form-control"
                                                                                id="cel_edit_{{ $proveedores->id }}"
                                                                                name="cel_edit"
                                                                                value="@if($proveedores->pais=='Colombia'||$proveedores->pais=='Argentina'||$proveedores->pais=='Venezuela'||$proveedores->pais=='Mexico'||$proveedores->pais=='Chile'||$proveedores->pais=='Venezuela'||$proveedores->pais=='Perú'||$proveedores->pais=='Brasil'){{substr($proveedores->celular,3)}}@elseif($proveedores->pais=='Bolivia'||$proveedores->pais=='Perú'||$proveedores->pais=='Ecuador'||$proveedores->pais=='Guayana Francesa'||$proveedores->pais=='Guyana'||$proveedores->pais=='Paraguay'||$proveedores->pais=='Surinam'||$proveedores->pais=='Uruguay'||$proveedores->pais=='Costa Rica'||$proveedores->pais=='El Salvador'||$proveedores->pais=='Guatemala'||$proveedores->pais=='Honduras'||$proveedores->pais=='Nicaragua'||$proveedores->pais=='Panamá'){{substr($proveedores->celular,4)}}@else{{substr($proveedores->celular,3)}}@endif"
                                                                                autocomplete="on">
                                                                        </div>
                                                                        @error('cel')
                                                                            <p class='text-danger text-xs pt-1'>
                                                                                {{ $message }}</p>
                                                                        @else
                                                                            <div class="w-100 text-center">
                                                                                <small
                                                                                    class="text-center text-xs text-color-secondary">¡Debe tener Whatsapp! <i class="fa fa-whatsapp"
                                                                                        aria-hidden="true"
                                                                                        style="color: #25D366; font-size: 15px; transform: translate(0px, 2.4px);">
                                                                                    </i></small>
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="tel">Número
                                                                            de celular 2°:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="tel{{ $proveedores->id }}"
                                                                            name="tel_edit"
                                                                            placeholder="{{ $proveedores->telefono }}"
                                                                            value="@if($proveedores->pais=='Colombia'||$proveedores->pais=='Argentina'||$proveedores->pais=='Venezuela'||$proveedores->pais=='Mexico'||$proveedores->pais=='Chile'||$proveedores->pais=='Venezuela'||$proveedores->pais=='Perú'||$proveedores->pais=='Brasil'){{substr($proveedores->telefono,3)}}@elseif($proveedores->pais=='Bolivia'||$proveedores->pais=='Perú'||$proveedores->pais=='Ecuador'||$proveedores->pais=='Guayana Francesa'||$proveedores->pais=='Guyana'||$proveedores->pais=='Paraguay'||$proveedores->pais=='Surinam'||$proveedores->pais=='Uruguay'||$proveedores->pais=='Costa Rica'||$proveedores->pais=='El Salvador'||$proveedores->pais=='Guatemala'||$proveedores->pais=='Honduras'||$proveedores->pais=='Nicaragua'||$proveedores->pais=='Panamá'){{substr($proveedores->telefono,4)}}@else{{substr($proveedores->telefono,3)}}@endif"
                                                                            autocomplete="on">
                                                                        @error('tel_edit')
                                                                            <small
                                                                                class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="flex flex-col mb-3">
                                                                        <label for="representante_legal">Representante
                                                                            Legal:</label>
                                                                        <input
                                                                            id="representante_legal_{{ $proveedores->id }}"
                                                                            type="text" class="form-control"
                                                                            name="representante_legal"
                                                                            value="{{ $proveedores->representante_legal }}">
                                                                    </div>

                                                                    <div class="flex flex-col mb-3">
                                                                        <label for="contacto_principal">Contacto
                                                                            Principal:</label>
                                                                        <input
                                                                            id="contacto_principal_{{ $proveedores->id }}"
                                                                            type="text" class="form-control"
                                                                            name="contacto_principal"
                                                                            value="{{ $proveedores->contacto_principal }}">
                                                                    </div>

                                                                    <div id="pais{{ $proveedores->id }}"
                                                                        class="flex flex-col mb-3 hide">
                                                                        <label>País:</label>
                                                                        <div class="form-control">
                                                                            <span type="text"
                                                                                id="text-pais_edit{{ $proveedores->id }}"
                                                                                name="pais"
                                                                                style="border: none !important;">{{ $proveedores->pais }}</span>
                                                                        </div>
                                                                    </div>

                                                                    <div id="ciudad{{ $proveedores->id }}"
                                                                        class="flex flex-col mb-3 hide">
                                                                        <label for="ciudad_edit">Ciudad:</label>
                                                                        <input id="ciudad_input_{{ $proveedores->id }}"
                                                                            type="text" class="form-control"
                                                                            name="ciudad_edit"
                                                                            value="{{ $proveedores->municipio }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="email">Correo
                                                                            electrónico:</label>
                                                                        <input type="email" class="form-control"
                                                                            id="email{{ $proveedores->id }}"
                                                                            name="email_edit"
                                                                            placeholder="{{ $proveedores->email }}"
                                                                            value="{{ $proveedores->email }}"
                                                                            autocomplete="on">
                                                                        @error('email_edit')
                                                                            <small
                                                                                class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="email_2">Correo
                                                                            electrónico (2°):</label>
                                                                        <input type="email" class="form-control"
                                                                            id="email_2{{ $proveedores->id }}"
                                                                            name="email_2_edit"
                                                                            placeholder="{{ $proveedores->email_secundario }}"
                                                                            value="{{ $proveedores->email_secundario }}"
                                                                            autocomplete="on">
                                                                        @error('email_edit')
                                                                            <small
                                                                                class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group"
                                                                        id="departamentos{{ $proveedores->id }}">
                                                                        <label for="departamento">Departamento:</label>
                                                                        <select id="departamento{{ $proveedores->id }}"
                                                                            name="departamento_edit"
                                                                            class="departamento form-control">
                                                                            <option value="">
                                                                                Seleccione un departamento
                                                                            </option>
                                                                            @foreach ($departamentos as $departamento)
                                                                                <option value="{{ $departamento }}">
                                                                                    {{ $departamento }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div id="municipios{{ $proveedores->id }}"
                                                                        class="form-group">
                                                                        <label for="municipio_edit">Municipio:</label>
                                                                        <select id="municipio{{ $proveedores->id }}"
                                                                            name="municipio_edit"
                                                                            class="municipio form-control">
                                                                            <option value="">
                                                                                Seleccione un municipio
                                                                            </option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="direccion">Dirección:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="direccion{{ $proveedores->id }}"
                                                                            name="direccion_edit"
                                                                            placeholder="{{ $proveedores->direccion }}"
                                                                            value="{{ $proveedores->direccion }}"
                                                                            autocomplete="on">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="flex flex-col">
                                                                            <label for="marcas">Preferencias de
                                                                                Marcas:</label>
                                                                            <select name="marcas"
                                                                                id="marcas{{ $proveedores->id }}"
                                                                                class="form-control"
                                                                                style="color: var(--bs-secondary-color);">
                                                                                <option value="" disabled selected>
                                                                                    Seleccionar Preferencias</option>
                                                                                <option value="Todas las marcas">Todas las
                                                                                    marcas</option>
                                                                                <!--<option value="AKT">AKT</option>-->
                                                                                <option value="Alfa Romeo">Alfa Romeo
                                                                                </option>
                                                                                <option value="Alpine">Alpine</option>
                                                                                <option value="Aston Martin">Aston Martin
                                                                                </option>
                                                                                <!--<option value="Apollo Motors">Apollo Motors</option>-->
                                                                                <!--<option value="Aprilia">Aprilia</option>-->
                                                                                <option value="Acura">Acura</option>
                                                                                <option value="Audi">Audi</option>
                                                                                <!--<option value="Auteco">Auteco</option>-->
                                                                                <!--<option value="Ayco">Ayco</option>-->
                                                                                <option value="BAIC">BAIC</option>
                                                                                <!--<option value="Bajaj">Bajaj</option>-->
                                                                                <!--<option value="Benelli">Benelli</option>-->
                                                                                <option value="Bugatti">Bugatti</option>
                                                                                <option value="Brabus">Brabus</option>
                                                                                <option value="BMW">BMW</option>
                                                                                <option value="BYD">BYD</option>
                                                                                <!--<option value="CF Moto">CF Moto</option>-->
                                                                                <option value="Changan">Changan</option>
                                                                                <option value="Chery">Chery</option>
                                                                                <option value="Cupra">Cupra</option>
                                                                                <option value="Chevrolet">Chevrolet
                                                                                </option>
                                                                                <option value="Cadillac">Cadillac</option>
                                                                                <option value="Citroën">Citroën</option>
                                                                                <option value="Dodge">Dodge</option>
                                                                                <option value="DFSK">DFSK</option>
                                                                                <option value="DS">DS</option>
                                                                                <!--<option value="Ducati">Ducati</option>-->
                                                                                <!--<option value="FAW">FAW</option>-->
                                                                                <option value="Fiat">Fiat</option>
                                                                                <option value="Ferrari">Ferrari</option>
                                                                                <option value="Ford">Ford</option>
                                                                                <option value="Foton">Foton</option>
                                                                                <option value="Great Wall">Great Wall
                                                                                </option>
                                                                                <option value="GMC">GMC</option>
                                                                                <option value="Haval">Haval</option>
                                                                                <!--<option value="Harley Davidson">Harley Davidson</option>-->
                                                                                <!--<option value="Hero Motos">Hero Motos</option>-->
                                                                                <option value="Honda">Honda</option>
                                                                                <option value="Hummer">Hummer</option>
                                                                                <option value="Hennessey">Hennessey
                                                                                </option>
                                                                                <option value="Hyundai">Hyundai</option>
                                                                                <option value="Infiniti">Infiniti</option>
                                                                                <!--<option value="Husqvarna">Husqvarna</option>-->
                                                                                <option value="JAC">JAC</option>
                                                                                <!--<option value="Jialing Motos">Jialing Motos</option>-->
                                                                                <option value="JMC">JMC</option>
                                                                                <option value="Jeep">Jeep</option>
                                                                                <!--<option value="Kawasaki">Kawasaki</option>-->
                                                                                <!--<option value="Keeway">Keeway</option>-->
                                                                                <option value="Kia">Kia</option>
                                                                                <!--<option value="KTM">KTM</option>-->
                                                                                <option value="Kenworth">Kenworth</option>
                                                                                <option value="Koenigsegg">Koenigsegg
                                                                                </option>
                                                                                <!--<option value="Kymco">Kymco</option>-->
                                                                                <option value="Land Rover">Land Rover
                                                                                </option>
                                                                                <option value="Lamborghini">Lamborghini
                                                                                </option>
                                                                                <option value="Lexus">Lexus</option>
                                                                                <option value="Lotus">Lotus</option>
                                                                                <option value="Lincoln">Lincoln</option>
                                                                                <!--<option value="Lifan">Lifan</option>-->
                                                                                <option value="Mahindra">Mahindra</option>
                                                                                <option value="Mazda">Mazda</option>
                                                                                <option value="McLaren">McLaren</option>
                                                                                <option value="Maserati">Maserati</option>
                                                                                <option value="Mercedes-Benz">Mercedes-Benz
                                                                                </option>
                                                                                <option value="MG">MG</option>
                                                                                <option value="Mini">Mini</option>
                                                                                <option value="Mitsubishi">Mitsubishi
                                                                                </option>
                                                                                <!--<option value="Moto Guzzi Colombia">Moto Guzzi Colombia</option>-->
                                                                                <option value="Nissan">Nissan</option>
                                                                                <option value="Opel">Opel</option>
                                                                                <option value="Peugeot">Peugeot</option>
                                                                                <option value="Pontiac">Pontiac</option>
                                                                                <!--<option value="Piaggio">Piaggio</option>-->
                                                                                <option value="Porsche">Porsche</option>
                                                                                <option value="Pagani">Pagani</option>
                                                                                <!--<option value="Pulsar">Pulsar</option>-->
                                                                                <option value="Renault">Renault</option>
                                                                                <option value="Rivian">Rivian</option>
                                                                                <option value="Rolls Royce">Rolls Royce
                                                                                </option>
                                                                                <!--<option value="Royal Enfield">Royal Enfield</option>-->
                                                                                <option value="SEAT">SEAT</option>
                                                                                <!--<option value="Sherco">Sherco</option>-->
                                                                                <option value="Skoda">Skoda</option>
                                                                                <option value="SsangYong">SsangYong
                                                                                </option>
                                                                                <!--<option value="Starker">Starker</option>-->
                                                                                <option value="Subaru">Subaru</option>
                                                                                <option value="Scania">Scania</option>
                                                                                <option value="Suzuki">Suzuki</option>
                                                                                <!--<option value="SYM">SYM</option>-->
                                                                                <option value="Tesla">Tesla</option>
                                                                                <option value="Toyota">Toyota</option>
                                                                                <!--<option value="Triumph">Triumph</option>-->
                                                                                <!--<option value="TVS">TVS</option>-->
                                                                                <!--<option value="Vespa">Vespa</option>-->
                                                                                <option value="Volkswagen">Volkswagen
                                                                                </option>
                                                                                <option value="Volvo">Volvo</option>
                                                                                <!--<option value="Yamaha">Yamaha</option>-->
                                                                                <!--<option value="Zotye">Zotye</option>-->
                                                                                <option value="otro">Otro</option>

                                                                            </select>
                                                                        </div>
                                                                        <div id="marcas_preferencias{{ $proveedores->id }}"
                                                                            class="marcas_preferencias flex flex-col mb-3">
                                                                            <div id="items_container{{ $proveedores->id }}"
                                                                                class="items_container form-control">
                                                                                @if (is_string($proveedores->marcas_preferencias))
                                                                                    @php
                                                                                        $marcas = json_decode($proveedores->marcas_preferencias);
                                                                                    @endphp
                                                                                    @foreach ($marcas as $marca)
                                                                                        <button type="button"
                                                                                            class="item_selected"
                                                                                            name="item">{{ $marca }}
                                                                                            <span
                                                                                                class="btn_borrar_item">×</span>
                                                                                        </button>
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>
                                                                            <div class="text-secondary text-xs pt-1">¡Solo
                                                                                le llegaran solicitudes de las marcas que
                                                                                elijas!.</div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="flex flex-col mb-3">
                                                                        <label
                                                                            for="categoria_repuesto{{ $proveedores->id }}">Especialidades:</label>
                                                                        <select
                                                                            title="Especialidad: ¿En que repuestos se especializa?"
                                                                            class="form-control" name="categoria_repuesto"
                                                                            id="categoria_repuesto{{ $proveedores->id }}"
                                                                            name="categoria_repuesto"
                                                                            style="color: var(--bs-secondary-color);"
                                                                            required>
                                                                            <option value="" disabled selected>
                                                                                *Seleccionar Especialidad</option>
                                                                            <option value="Todas las especialidades">Todas
                                                                                las especialidades</option>
                                                                            <option value="LLantas">LLantas</option>
                                                                            <option value="Frenos">Frenos</option>
                                                                            <option value="Suspensión">Suspensión</option>
                                                                            <option value="Dirección">Sistema de Dirección</option>
                                                                            <option value="Motor">Motor</option>
                                                                            <option value="Transmisión">Transmisión
                                                                            </option>
                                                                            <option value="Tren motriz">Tren motriz</option>
                                                                            <option value="Latas">Latas</option>
                                                                            <option value="Refrigeración">Refrigeración</option>
                                                                            <option value="Eléctricos">Eléctricos
                                                                            </option>
                                                                            <option value="otros">Otros</option>
                                                                        </select>
                                                                        <div id="categorias_preferencias{{ $proveedores->id }}"
                                                                            class="categorias_preferencias flex flex-col mb-3">
                                                                            <div id="items_container_categorias{{ $proveedores->id }}"
                                                                                class="items_container form-control">
                                                                                @if (is_string($proveedores->especialidad))
                                                                                    @php
                                                                                        $preferencias = json_decode($proveedores->especialidad);
                                                                                    @endphp
                                                                                    @foreach ($preferencias as $preferencia)
                                                                                        <button type="button"
                                                                                            class="item_selected"
                                                                                            name="item_category">{{ $preferencia }}
                                                                                            <span
                                                                                                class="btn_borrar_item">×</span></button>
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>
                                                                            @error('json_marcas')
                                                                                <div class="text-danger text-xs pt-1">
                                                                                    {{ $message }}</div>
                                                                            @else
                                                                                <div class="text-secondary text-xs pt-1">¡Solo
                                                                                    le llegaran solicitudes de las marcas que
                                                                                    elijas!.</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group flex flex-col">
                                                                        <span>RUT:</span>
                                                                        <label id="btn1{{ $proveedores->id }}"
                                                                            class="button form-control"
                                                                            for="rut{{ $proveedores->id }}"
                                                                            style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                                            <div id="text_file_rut{{ $proveedores->id }}"
                                                                                placeholder="{{ $proveedores->rut }}">
                                                                            </div>
                                                                            <div><i id="check1{{ $proveedores->id }}"
                                                                                    class="fa fa-check"
                                                                                    aria-hidden="true"></i>
                                                                            </div>
                                                                        </label>
                                                                        <input type="file" accept=".pdf"
                                                                            name="rut"
                                                                            id="rut{{ $proveedores->id }}"
                                                                            class="form-control" aria-label="Rut"
                                                                            style="display: none;">
                                                                        @error('rut')
                                                                            <div class="text-danger text-xs pt-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group flex flex-col">
                                                                        <span>Camara de comercio:</span>
                                                                        <label id="btn2{{ $proveedores->id }}"
                                                                            class="button form-control"
                                                                            for="cam{{ $proveedores->id }}"
                                                                            style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                                            <div id="text_file_cam{{ $proveedores->id }}"
                                                                                placeholder="{{ $proveedores->camara_comercio }}">
                                                                            </div>
                                                                            <div><i id="check2{{ $proveedores->id }}"
                                                                                    class="fa fa-check"
                                                                                    aria-hidden="true"></i></div>
                                                                        </label>
                                                                        <input type="file" accept=".pdf"
                                                                            name="cam"
                                                                            id="cam{{ $proveedores->id }}"
                                                                            class="form-control" aria-label="Cam"
                                                                            style="display: none;">
                                                                        @error('cam')
                                                                            <div class="text-danger text-xs pt-1">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="estado">Estado:</label>
                                                                        <select class="form-control"
                                                                            id="estado{{ $proveedores->id }}"
                                                                            name="estado_edit">
                                                                            <option value="" disabled selected>
                                                                                Estado
                                                                                ({{ $proveedores->estado ? 'Activo' : 'Inactivo' }})
                                                                            </option>
                                                                            <option value="1">
                                                                                Activo</option>
                                                                            <option value="0">
                                                                                Inactivo</option>
                                                                        </select>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Guardar
                                                                        Cambios</button>
                                                                </form>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                <!-- Modal para eliminar -->
                                                <div class="modal fade" id="eraseModal{{ $proveedores->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="eraseModalLabel"
                                                    aria-hidden="true" style="z-index: 1041;">
                                                    <div class="modal-dialog" role="document" style="z-index: 1042;">
                                                        <div class="modal-content" style="z-index: 1043;">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="eraseModalLabel{{ $proveedores->id }}">
                                                                    Eliminar proveedor</h5>
                                                                <button class="close" type="button"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Seguro que deseas eliminar a este
                                                                proveedor?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-dismiss="modal">Cancelar</button>
                                                                <form
                                                                    action="{{ route('eliminarProveedor', $proveedores->id) }}"
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

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    let codigo = document.getElementById('codigo-cel{{ $proveedores->id }}');

                                                    // Obtener el valor del código del proveedor
                                                    let codigoProveedor = '{{ $proveedores->pais }}';

                                                    if (codigoProveedor == 'Argentina') {
                                                        // Establecer el valor del select al valor del proveedor
                                                        codigo.value = "+54";
                                                    } else if (codigoProveedor == 'Bolivia') {
                                                        codigo.value = "+591";
                                                    } else if (codigoProveedor == 'Brasil') {
                                                        codigo.value = "+55";
                                                    } else if (codigoProveedor == 'Chile') {
                                                        codigo.value = "+56";
                                                    } else if (codigoProveedor == 'Ecuador') {
                                                        codigo.value = "+593";
                                                    } else if (codigoProveedor == 'Guayana Francesa') {
                                                        codigo.value = "+594";
                                                    } else if (codigoProveedor == 'Guyana') {
                                                        codigo.value = "+592";
                                                    } else if (codigoProveedor == 'Paraguay') {
                                                        codigo.value = "+595";
                                                    } else if (codigoProveedor == 'Perú') {
                                                        codigo.value = "+51";
                                                    } else if (codigoProveedor == 'Surinam') {
                                                        codigo.value = "+597";
                                                    } else if (codigoProveedor == 'Uruguay') {
                                                        codigo.value = "+598";
                                                    } else if (codigoProveedor == 'Venezuela') {
                                                        codigo.value = "+58";
                                                    } else if (codigoProveedor == 'Colombia') {
                                                        codigo.value = "+57";
                                                    } else if (codigoProveedor == 'Estados Unidos') {
                                                        codigo.value = "+1";
                                                    } else if (codigoProveedor == 'Costa Rica') {
                                                        codigo.value = "+506";
                                                    } else if (codigoProveedor == 'El Salvador') {
                                                        codigo.value = "+503";
                                                    } else if (codigoProveedor == 'Guatemala') {
                                                        codigo.value = "+502";
                                                    } else if (codigoProveedor == 'Honduras') {
                                                        codigo.value = "+504";
                                                    } else if (codigoProveedor == 'México') {
                                                        codigo.value = "+52";
                                                    } else if (codigoProveedor == 'Nicaragua') {
                                                        codigo.value = "+505";
                                                    } else if (codigoProveedor == 'Panamá') {
                                                        codigo.value = "+507";
                                                    }


                                                    let cel = document.getElementById('cel_edit_{{ $proveedores->id }}')
                                                    let tel = document.getElementById('tel{{ $proveedores->id }}')

                                                    let pais = document.getElementById('pais{{ $proveedores->id }}');
                                                    let ciudad = document.getElementById('ciudad{{ $proveedores->id }}');
                                                    let textPais = document.getElementById('text-pais_edit{{ $proveedores->id }}');
                                                    let departamento = document.getElementById('departamentos{{ $proveedores->id }}');
                                                    let municipio = document.getElementById('municipios{{ $proveedores->id }}');

                                                    // Función para limpiar el número de celular
                                                    function limpiarCelular() {
                                                        cel.value = cel.value.replace(/[^\d]/g, '');
                                                        if (codigo.value == '+54') {
                                                            cel.value = cel.value.slice(0, 10);
                                                            tel.value = tel.value.slice(0, 10);
                                                        } else if (codigo.value == '+591') {
                                                            cel.value = cel.value.slice(0, 8);
                                                            tel.value = tel.value.slice(0, 8);
                                                        } else if (codigo.value == '+55') {
                                                            cel.value = cel.value.slice(0, 11);
                                                            tel.value = tel.value.slice(0, 11);
                                                        } else if (codigo.value == '+56') {
                                                            cel.value = cel.value.slice(0, 9);
                                                            tel.value = tel.value.slice(0, 9);
                                                        } else if (codigo.value == '+593') {
                                                            cel.value = cel.value.slice(0, 10);
                                                            tel.value = tel.value.slice(0, 10);
                                                        } else if (codigo.value == '+594') {
                                                            cel.value = cel.value.slice(0, 9);
                                                            tel.value = tel.value.slice(0, 9);
                                                        } else if (codigo.value == '+592') {
                                                            cel.value = cel.value.slice(0, 7);
                                                            tel.value = tel.value.slice(0, 7);
                                                        } else if (codigo.value == '+595') {
                                                            cel.value = cel.value.slice(0, 9);
                                                            tel.value = tel.value.slice(0, 9);
                                                        } else if (codigo.value == '+51') {
                                                            cel.value = cel.value.slice(0, 9);
                                                            tel.value = tel.value.slice(0, 9);
                                                        } else if (codigo.value == '+597') {
                                                            cel.value = cel.value.slice(0, 7);
                                                            tel.value = tel.value.slice(0, 7);
                                                        } else if (codigo.value == '+598') {
                                                            cel.value = cel.value.slice(0, 8);
                                                            tel.value = tel.value.slice(0, 8);
                                                        } else if (codigo.value == '+58') {
                                                            cel.value = cel.value.slice(0, 10);
                                                            tel.value = tel.value.slice(0, 10);
                                                        } else if (codigo.value == '+57') {
                                                            cel.value = cel.value.slice(0, 10);
                                                            tel.value = tel.value.slice(0, 10);
                                                        } else if (codigo.value == '+1') {
                                                            cel.value = cel.value.slice(0, 10);
                                                            tel.value = tel.value.slice(0, 10);
                                                        } else if (codigo.value == '+506') {
                                                            cel.value = cel.value.slice(0, 8);
                                                            tel.value = tel.value.slice(0, 8);
                                                        } else if (codigo.value == '+503') {
                                                            cel.value = cel.value.slice(0, 8);
                                                            tel.value = tel.value.slice(0, 8);
                                                        } else if (codigo.value == '+502') {
                                                            cel.value = cel.value.slice(0, 8);
                                                            tel.value = tel.value.slice(0, 8);
                                                        } else if (codigo.value == '+504') {
                                                            cel.value = cel.value.slice(0, 8);
                                                            tel.value = tel.value.slice(0, 8);
                                                        } else if (codigo.value == '+52') {
                                                            cel.value = cel.value.slice(0, 10);
                                                            tel.value = tel.value.slice(0, 10);
                                                        } else if (codigo.value == '+505') {
                                                            cel.value = cel.value.slice(0, 8);
                                                            tel.value = tel.value.slice(0, 8);
                                                        } else if (codigo.value == '+507') {
                                                            cel.value = cel.value.slice(0, 8);
                                                            tel.value = tel.value.slice(0, 8);
                                                        }
                                                    }

                                                    // Asigna la función al evento input del campo de celular
                                                    cel.addEventListener('input', limpiarCelular);
                                                    tel.addEventListener('input', limpiarCelular);

                                                    function updateVisibility() {
                                                        sessionStorage.setItem('codigo', codigo.value);

                                                        if (codigo.value == '+54') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');

                                                            if (isNaN(cel.value) || cel.value.length != 10) {
                                                                cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }

                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 10) {
                                                                tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }

                                                            textPais.textContent = 'Argentina';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+591') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');


                                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }

                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }

                                                            textPais.textContent = 'Bolivia';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+55') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');

                                                            if (isNaN(cel.value) || cel.value.length != 11) {
                                                                cel.setCustomValidity("El número de celular debe tener 11 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }

                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 11) {
                                                                tel.setCustomValidity("El número de celular debe tener 11 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }

                                                            textPais.textContent = 'Brasil';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+56') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');

                                                            if (isNaN(cel.value) || cel.value.length != 9) {
                                                                cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }
                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 9) {
                                                                tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }

                                                            textPais.textContent = 'Chile';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+593') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 10) {
                                                                cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }

                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 10) {
                                                                tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }

                                                            textPais.textContent = 'Ecuador';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+594') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 9) {
                                                                cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 9) {
                                                                tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }
                                                            textPais.textContent = 'Guayana Francesa';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+592') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 7) {
                                                                cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }

                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 7) {
                                                                tel.setCustomValidity("El número de celular debe tener 7 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }

                                                            textPais.textContent = 'Guyana';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+595') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 9) {
                                                                cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 9) {
                                                                tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }


                                                            textPais.textContent = 'Paraguay';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+51') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 9) {
                                                                cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }

                                                            if (isNaN(tel.value) || tel.value.length != 9) {
                                                                tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }

                                                            textPais.textContent = 'Perú';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+597') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            ciudad.classList.remove('hide');
                                                            pais.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 7) {
                                                                cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 7) {
                                                                tel.setCustomValidity("El número de celular debe tener 7 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }

                                                            textPais.textContent = 'Surinam';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+598') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }

                                                            textPais.textContent = 'Uruguay';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+58') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 10) {
                                                                cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }

                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 10) {
                                                                tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }
                                                            textPais.textContent = 'Venezuela';

                                                            // Elimina el atributo 'required'
                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+57') {
                                                            departamento.classList.remove('hide');
                                                            municipio.classList.remove('hide');
                                                            pais.classList.add('hide');
                                                            ciudad.classList.add('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 10) {
                                                                cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 10) {
                                                                tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }
                                                            textPais.textContent = 'Colombia';

                                                            // Establece los campos como obligatorios
                                                            departamento.setAttribute('required', true);
                                                            municipio.setAttribute('required', true);
                                                        } else if (codigo.value == '+1') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 10) {
                                                                cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 10) {
                                                                tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }
                                                            textPais.textContent = 'Estados Unidos';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+506') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }
                                                            textPais.textContent = 'Costa Rica';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+503') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }
                                                            textPais.textContent = 'El Salvador';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+502') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }
                                                            textPais.textContent = 'Guatemala';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+504') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }

                                                            textPais.textContent = 'Honduras';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+52') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 10) {
                                                                cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 10) {
                                                                tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }
                                                            textPais.textContent = 'México';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+505') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }
                                                            textPais.textContent = 'Nicaragua';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        } else if (codigo.value == '+507') {
                                                            departamento.classList.add('hide');
                                                            municipio.classList.add('hide');
                                                            pais.classList.remove('hide');
                                                            ciudad.classList.remove('hide');
                                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                cel.setCustomValidity("");
                                                            }


                                                            if (tel.value == "") {
                                                                tel.setCustomValidity("");
                                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                            } else {
                                                                tel.setCustomValidity("");
                                                            }
                                                            textPais.textContent = 'Panamá';

                                                            departamento.removeAttribute('required');
                                                            municipio.removeAttribute('required');
                                                        }
                                                    }

                                                    codigo.addEventListener('change', updateVisibility);
                                                    cel.addEventListener('change', updateVisibility);
                                                    tel.addEventListener('change', updateVisibility);

                                                    updateVisibility();
                                                });
                                            </script>

                                            <script>
                                                // Obtener los elementos del formulario dentro de cada iteración
                                                const departamentoSelect{{ $proveedores->id }} = document.getElementById('departamento{{ $proveedores->id }}');
                                                const municipioSelect{{ $proveedores->id }} = document.getElementById('municipio{{ $proveedores->id }}');

                                                // Función para cargar los municipios según el departamento seleccionado
                                                function cargarMunicipios{{ $proveedores->id }}(departamento) {
                                                    municipioSelect{{ $proveedores->id }}.innerHTML = '<option value="">Seleccione un municipio</option>';
                                                    // Obtener los municipios del departamento seleccionado del objeto PHP $group
                                                    const municipios = {!! json_encode($group) !!}[departamento];
                                                    if (municipios) {
                                                        // Agregar las opciones de los municipios al campo de municipio
                                                        municipios.forEach(municipio => {
                                                            municipioSelect{{ $proveedores->id }}.innerHTML +=
                                                                `<option value="${municipio}">${municipio}</option>`;
                                                        });
                                                    }
                                                }

                                                // Evento para cargar los municipios al seleccionar un departamento
                                                departamentoSelect{{ $proveedores->id }}.addEventListener('change', function() {
                                                    const selectedDepartamento = departamentoSelect{{ $proveedores->id }}.value;
                                                    if (selectedDepartamento) {
                                                        cargarMunicipios{{ $proveedores->id }}(selectedDepartamento);
                                                    } else {
                                                        // Si no se ha seleccionado un departamento, limpiar el campo de municipio
                                                        municipioSelect{{ $proveedores->id }}.innerHTML =
                                                            '<option value="">Seleccione un municipio</option>';
                                                    }

                                                    // Guardar la selección actual en localStorage cuando cambia
                                                    localStorage.setItem('selectedDepartamento{{ $proveedores->id }}', selectedDepartamento);
                                                });

                                                // Obtener el valor anterior de 'departamento' almacenado en localStorage
                                                const storedDepartamento{{ $proveedores->id }} = localStorage.getItem(
                                                    'selectedDepartamento{{ $proveedores->id }}');

                                                // Verificar si hay un valor almacenado y establecerlo como la opción seleccionada
                                                if (storedDepartamento{{ $proveedores->id }}) {
                                                    departamentoSelect{{ $proveedores->id }}.value = storedDepartamento{{ $proveedores->id }};
                                                    cargarMunicipios{{ $proveedores->id }}(storedDepartamento{{ $proveedores->id }});
                                                }
                                            </script>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    let marcas = document.getElementById('marcas{{ $proveedores->id }}');
                                                    let container = document.getElementById('items_container{{ $proveedores->id }}');
                                                    let marcas_preferencias = document.getElementById('marcas_preferencias{{ $proveedores->id }}');
                                                    marcas_preferencias.classList.add('hide');

                                                    // Función para agregar un botón
                                                    function agregarBoton(item) {
                                                        const botonesExistentes = Array.from(container.children).map(button => button.textContent).replace(/×/g, '');

                                                        if (!botonesExistentes.includes(item)) {
                                                            let button = document.createElement('button');
                                                            button.type = 'button'; // Cambiamos el tipo de submit a button
                                                            button.classList.add('item_selected');
                                                            button.setAttribute('name', 'item');
                                                            button.innerHTML = item + '<span class="btn_borrar_item">×</span>';

                                                            // Agregar un evento de escucha de clics al botón
                                                            button.addEventListener('click', function(event) {
                                                                event.preventDefault(); // Evitar la recarga de la página

                                                                // Eliminar el botón del contenedor
                                                                container.removeChild(button);

                                                                if (container.children.length === 0) {
                                                                    marcas_preferencias.classList.add('hide');
                                                                    marcas.removeAttribute('required');
                                                                }
                                                            });

                                                            container.appendChild(button);
                                                        }

                                                    }

                                                    // Si hay marcas seleccionadas, recrear los botones
                                                    if (container.children.length > 0) {
                                                        marcas_preferencias.classList.remove('hide');
                                                        marcas.removeAttribute('required');

                                                        // Agregar el evento de clic a los botones existentes
                                                        let botones = container.querySelectorAll('.item_selected');
                                                        botones.forEach(function(button) {
                                                            button.addEventListener('click', function(event) {
                                                                event.preventDefault();
                                                                container.removeChild(button);

                                                                if (container.children.length === 0) {
                                                                    marcas_preferencias.classList.add('hide');
                                                                    marcas.removeAttribute('required');
                                                                }
                                                            });
                                                        });
                                                    }

                                                    marcas.addEventListener('change', function() {

                                                        let item = marcas.value;
                                                        const botonesExistentes = Array.from(container.children).map(button => button.textContent);
                                                        if (item !== "" && !botonesExistentes.includes(item)) {
                                                            agregarBoton(item);
                                                            marcas_preferencias.classList.remove('hide');
                                                        }
                                                    });

                                                    document.getElementById('edit_modal{{ $proveedores->id }}').addEventListener('submit', function(
                                                        event) {
                                                        event.preventDefault(); // Evitar el envío del formulario para manejarlo manualmente

                                                        // Obtener los textos de los botones en un arreglo
                                                        let textosSeleccionados = Array.from(container.children).map(button => button.textContent);

                                                        // Convertir el arreglo a una cadena JSON
                                                        let jsonTextosSeleccionados = JSON.stringify(textosSeleccionados);

                                                        // Agregar un campo oculto al formulario y asignarle la cadena JSON
                                                        let inputJson = document.createElement('input');
                                                        inputJson.type = 'hidden';
                                                        inputJson.name = 'json_marcas';
                                                        inputJson.value = jsonTextosSeleccionados.replace(/×/g, '').replace(/\n/g, '').replace(/\r/g, '');
                                                        this.appendChild(inputJson);

                                                        // Ahora, puedes enviar el formulario
                                                        this.submit();
                                                    });
                                                });
                                            </script>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    let categoria = document.getElementById('categoria_repuesto{{ $proveedores->id }}');
                                                    let container = document.getElementById('items_container_categorias{{ $proveedores->id }}');
                                                    let categorias_preferencias = document.getElementById(
                                                        'categorias_preferencias{{ $proveedores->id }}');
                                                    categorias_preferencias.classList.add('hide');


                                                    // Función para agregar un botón
                                                    function agregarBoton(item) {
                                                        const botonesExistentes = Array.from(container.children).map(button => button.textContent.replace(/×/g, ''));

                                                        if (!botonesExistentes.includes(item)) {
                                                            let button = document.createElement('button');
                                                            button.type = 'button'; // Cambiamos el tipo de submit a button
                                                            button.classList.add('item_selected');
                                                            button.setAttribute('name', 'item_category');
                                                            button.innerHTML = item + '<span class="btn_borrar_item">×</span>';

                                                            // Agregar un evento de escucha de clics al botón
                                                            button.addEventListener('click', function(event) {
                                                                event.preventDefault(); // Evitar la recarga de la página

                                                                // Eliminar el botón del contenedor
                                                                container.removeChild(button);

                                                                if (container.children.length === 0) {
                                                                    categorias_preferencias.classList.add('hide');
                                                                    categoria.removeAttribute('required');
                                                                }
                                                            });

                                                            container.appendChild(button);
                                                        }

                                                    }

                                                    // Si hay categorias seleccionadas, recrear los botones
                                                    if (container.children.length > 0) {
                                                        categorias_preferencias.classList.remove('hide');
                                                        categoria.removeAttribute('required');

                                                        // Agregar el evento de clic a los botones existentes
                                                        let botones = container.querySelectorAll('.item_selected');
                                                        botones.forEach(function(button) {
                                                            button.addEventListener('click', function(event) {
                                                                event.preventDefault();
                                                                container.removeChild(button);

                                                                if (container.children.length === 0) {
                                                                    categorias_preferencias.classList.add('hide');
                                                                    categoria.removeAttribute('required');
                                                                }
                                                            });
                                                        });
                                                    }

                                                    categoria.addEventListener('change', function() {

                                                        let item = categoria.value;
                                                        const botonesExistentes = Array.from(container.children).map(button => button.textContent);
                                                        if (item !== "" && !botonesExistentes.includes(item)) {
                                                            agregarBoton(item);
                                                            categorias_preferencias.classList.remove('hide');
                                                        }
                                                    });

                                                    document.getElementById('edit_modal{{ $proveedores->id }}').addEventListener('submit', function(
                                                        event) {
                                                        event.preventDefault(); // Evitar el envío del formulario para manejarlo manualmente

                                                        // Obtener los textos de los botones en un arreglo
                                                        let textosSeleccionados = Array.from(container.children).map(button => button.textContent);

                                                        // Convertir el arreglo a una cadena JSON
                                                        let jsonTextosSeleccionados = JSON.stringify(textosSeleccionados);

                                                        // Agregar un campo oculto al formulario y asignarle la cadena JSON
                                                        let inputJson = document.createElement('input');
                                                        inputJson.type = 'hidden';
                                                        inputJson.name = 'json_categorias';
                                                        inputJson.value = jsonTextosSeleccionados.replace(/×/g, '').replace(/\n/g, '').replace(/\r/g, '');
                                                        this.appendChild(inputJson);

                                                        // Ahora, puedes enviar el formulario
                                                        this.submit();
                                                    });
                                                });
                                            </script>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {

                                                    let text_rut = document.getElementById('text_file_rut{{ $proveedores->id }}');
                                                    let text_cam = document.getElementById('text_file_cam{{ $proveedores->id }}');

                                                    text_rut.innerHTML = "{{ $proveedores->rut }}";
                                                    text_cam.innerHTML = "{{ $proveedores->camara_comercio }}";

                                                    let rut = document.getElementById('rut{{ $proveedores->id }}');
                                                    let cam = document.getElementById('cam{{ $proveedores->id }}');

                                                    const btn1 = document.getElementById('btn1{{ $proveedores->id }}');
                                                    const i1 = document.getElementById('check1{{ $proveedores->id }}');
                                                    i1.style.display = "none";

                                                    const btn2 = document.getElementById('btn2{{ $proveedores->id }}');
                                                    const i2 = document.getElementById('check2{{ $proveedores->id }}');
                                                    i2.style.display = 'none';

                                                    rut.addEventListener('change', function() {
                                                        if (this.files.length > 0) {
                                                            console.log('Se ha seleccionado al menos un archivo.');
                                                            btn1.style.borderColor = 'rgb(157, 232, 157)';
                                                            i1.style.display = 'block';
                                                            text_rut.innerHTML = this.files[0].name;
                                                        }
                                                    });

                                                    cam.addEventListener('change', function() {
                                                        if (this.files.length > 0) {
                                                            btn2.style.borderColor = 'rgb(157, 232, 157)';
                                                            i2.style.display = 'block';
                                                            text_cam.innerHTML = this.files[0].name;
                                                        }
                                                    });
                                                });
                                            </script>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    let nit = document.getElementById('nit_edit_{{ $proveedores->id }}');

                                                    function nitValidity() {
                                                        if (nit.value.length != 0) {
                                                            nit.value = nit.value.slice(0, 12);
                                                            if (nit.value.length < 8) {
                                                                nit.setCustomValidity("El nit es muy corto");
                                                            } else if (isNaN(nit.value)) {
                                                                nit.setCustomValidity("El nit debe contener solo números");
                                                            } else {
                                                                nit.setCustomValidity("");
                                                            }
                                                        } else {
                                                            nit.setCustomValidity("");
                                                        }
                                                    }

                                                    nit.addEventListener('input', nitValidity);

                                                    nitValidity();
                                                });
                                            </script>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function(){

                                                    let tab1 = document.getElementById('tab1_{{$proveedores->id}}');
                                                    let btnSTab1 = document.getElementById('btn_siguiente_basica{{$proveedores->id}}');

                                                    let tab2 = document.getElementById('tab2_{{$proveedores->id}}');
                                                    let btnATab2 = document.getElementById('btn_anterior_contacto{{$proveedores->id}}');
                                                    let btnSTab2 = document.getElementById('btn_siguiente_contacto{{$proveedores->id}}');

                                                    let tab3 = document.getElementById('tab3_{{$proveedores->id}}');
                                                    let btnATab3 = document.getElementById('btn_anterior_legal{{$proveedores->id}}');
                                                    let btnSTab3 = document.getElementById('btn_siguiente_legal{{$proveedores->id}}');

                                                    let tab4 = document.getElementById('tab4_{{$proveedores->id}}');
                                                    let btnATab4 = document.getElementById('btn_anterior_marcas{{$proveedores->id}}');

                                                    tab1.addEventListener('click', function () {
                                                        let tabId1 = document.getElementById('tab-content1_{{$proveedores->id}}');
                                                        let tabId2 = document.getElementById('tab-content2_{{$proveedores->id}}');
                                                        let tabId3 = document.getElementById('tab-content3_{{$proveedores->id}}');
                                                        let tabId4 = document.getElementById('tab-content4_{{$proveedores->id}}');

                                                        tabId1.classList.remove('hide');
                                                        tab1.classList.add('active');
                                                        tab1.classList.add('paso_activo');
                                                        tabId1.classList.add('show');
                                                        tabId1.classList.add('active');

                                                        tabId2.classList.add('hide');
                                                        tabId2.classList.remove('active');
                                                        tab2.classList.remove('active');
                                                        tab2.classList.remove('paso_activo');
                                                        tabId2.classList.remove('show');

                                                        tabId3.classList.add('hide');
                                                        tabId3.classList.remove('active');
                                                        tab3.classList.remove('active');
                                                        tab3.classList.remove('paso_activo');
                                                        tabId3.classList.remove('show');

                                                        tabId4.classList.add('hide');
                                                        tabId4.classList.remove('active');
                                                        tab4.classList.remove('active');
                                                        tab4.classList.remove('paso_activo');
                                                        tabId4.classList.remove('show');
                                                    });
                                                    btnSTab1.addEventListener('click', function () {
                                                        let tabId1 = document.getElementById('tab-content1_{{$proveedores->id}}');
                                                        let tabId2 = document.getElementById('tab-content2_{{$proveedores->id}}');
                                                        let tabId3 = document.getElementById('tab-content3_{{$proveedores->id}}');
                                                        let tabId4 = document.getElementById('tab-content4_{{$proveedores->id}}');

                                                        tabId1.classList.add('hide');
                                                        tabId1.classList.remove('active');
                                                        tab1.classList.remove('active');
                                                        tab1.classList.remove('paso_activo');
                                                        tabId1.classList.remove('show');

                                                        tabId2.classList.remove('hide');
                                                        tab2.classList.add('active');
                                                        tab2.classList.add('paso_activo');
                                                        tabId2.classList.add('show');
                                                        tabId2.classList.add('active');

                                                        tabId3.classList.add('hide');
                                                        tabId3.classList.remove('active');
                                                        tab3.classList.remove('active');
                                                        tab3.classList.remove('paso_activo');
                                                        tabId3.classList.remove('show');

                                                        tabId4.classList.add('hide');
                                                        tabId4.classList.remove('active');
                                                        tab4.classList.remove('active');
                                                        tab4.classList.remove('paso_activo');
                                                        tabId4.classList.remove('show');
                                                    });

                                                    tab2.addEventListener('click', function () {
                                                        let tabId1 = document.getElementById('tab-content1_{{$proveedores->id}}');
                                                        let tabId2 = document.getElementById('tab-content2_{{$proveedores->id}}');
                                                        let tabId3 = document.getElementById('tab-content3_{{$proveedores->id}}');
                                                        let tabId4 = document.getElementById('tab-content4_{{$proveedores->id}}');

                                                        tabId1.classList.add('hide');
                                                        tabId1.classList.remove('active');
                                                        tab1.classList.remove('active');
                                                        tab1.classList.remove('paso_activo');
                                                        tabId1.classList.remove('show');

                                                        tabId2.classList.remove('hide');
                                                        tab2.classList.add('active');
                                                        tab2.classList.add('paso_activo');
                                                        tabId2.classList.add('show');
                                                        tabId2.classList.add('active');

                                                        tabId3.classList.add('hide');
                                                        tabId3.classList.remove('active');
                                                        tab3.classList.remove('active');
                                                        tab3.classList.remove('paso_activo');
                                                        tabId3.classList.remove('show');

                                                        tabId4.classList.add('hide');
                                                        tabId4.classList.remove('active');
                                                        tab4.classList.remove('active');
                                                        tab4.classList.remove('paso_activo');
                                                        tabId4.classList.remove('show');
                                                    });
                                                    btnATab2.addEventListener('click', function () {
                                                        let tabId1 = document.getElementById('tab-content1_{{$proveedores->id}}');
                                                        let tabId2 = document.getElementById('tab-content2_{{$proveedores->id}}');
                                                        let tabId3 = document.getElementById('tab-content3_{{$proveedores->id}}');
                                                        let tabId4 = document.getElementById('tab-content4_{{$proveedores->id}}');

                                                        tabId1.classList.remove('hide');
                                                        tab1.classList.add('active');
                                                        tab1.classList.add('paso_activo');
                                                        tabId1.classList.add('show');
                                                        tabId1.classList.add('active');

                                                        tabId2.classList.add('hide');
                                                        tabId2.classList.remove('active');
                                                        tab2.classList.remove('active');
                                                        tab2.classList.remove('paso_activo');
                                                        tabId2.classList.remove('show');

                                                        tabId3.classList.add('hide');
                                                        tabId3.classList.remove('active');
                                                        tab3.classList.remove('active');
                                                        tab3.classList.remove('paso_activo');
                                                        tabId3.classList.remove('show');

                                                        tabId4.classList.add('hide');
                                                        tabId4.classList.remove('active');
                                                        tab4.classList.remove('active');
                                                        tab4.classList.remove('paso_activo');
                                                        tabId4.classList.remove('show');
                                                    });
                                                    btnSTab2.addEventListener('click', function () {
                                                        let tabId1 = document.getElementById('tab-content1_{{$proveedores->id}}');
                                                        let tabId2 = document.getElementById('tab-content2_{{$proveedores->id}}');
                                                        let tabId3 = document.getElementById('tab-content3_{{$proveedores->id}}');
                                                        let tabId4 = document.getElementById('tab-content4_{{$proveedores->id}}');

                                                        tabId1.classList.add('hide');
                                                        tabId1.classList.remove('active');
                                                        tab1.classList.remove('active');
                                                        tab1.classList.remove('paso_activo');
                                                        tabId1.classList.remove('show');

                                                        tabId2.classList.add('hide');
                                                        tabId2.classList.remove('active');
                                                        tab2.classList.remove('active');
                                                        tab2.classList.remove('paso_activo');
                                                        tabId2.classList.remove('show');

                                                        tabId3.classList.remove('hide');
                                                        tab3.classList.add('active');
                                                        tab3.classList.add('paso_activo');
                                                        tabId3.classList.add('show');
                                                        tabId3.classList.add('active');

                                                        tabId4.classList.add('hide');
                                                        tabId4.classList.remove('active');
                                                        tab4.classList.remove('active');
                                                        tab4.classList.remove('paso_activo');
                                                        tabId4.classList.remove('show');
                                                    });

                                                    tab3.addEventListener('click', function () {
                                                        let tabId1 = document.getElementById('tab-content1_{{$proveedores->id}}');
                                                        let tabId2 = document.getElementById('tab-content2_{{$proveedores->id}}');
                                                        let tabId3 = document.getElementById('tab-content3_{{$proveedores->id}}');
                                                        let tabId4 = document.getElementById('tab-content4_{{$proveedores->id}}');

                                                        tabId1.classList.add('hide');
                                                        tabId1.classList.remove('active');
                                                        tab1.classList.remove('active');
                                                        tab1.classList.remove('paso_activo');
                                                        tabId1.classList.remove('show');

                                                        tabId2.classList.add('hide');
                                                        tabId2.classList.remove('active');
                                                        tab2.classList.remove('active');
                                                        tab2.classList.remove('paso_activo');
                                                        tabId2.classList.remove('show');

                                                        tabId3.classList.remove('hide');
                                                        tab3.classList.add('active');
                                                        tab3.classList.add('paso_activo');
                                                        tabId3.classList.add('show');
                                                        tabId3.classList.add('active');

                                                        tabId4.classList.add('hide');
                                                        tabId4.classList.remove('active');
                                                        tab4.classList.remove('active');
                                                        tab4.classList.remove('paso_activo');
                                                        tabId4.classList.remove('show');
                                                    });
                                                    btnATab3.addEventListener('click', function () {
                                                        let tabId1 = document.getElementById('tab-content1_{{$proveedores->id}}');
                                                        let tabId2 = document.getElementById('tab-content2_{{$proveedores->id}}');
                                                        let tabId3 = document.getElementById('tab-content3_{{$proveedores->id}}');
                                                        let tabId4 = document.getElementById('tab-content4_{{$proveedores->id}}');

                                                        tabId1.classList.add('hide');
                                                        tabId1.classList.remove('active');
                                                        tab1.classList.remove('active');
                                                        tab1.classList.remove('paso_activo');
                                                        tabId1.classList.remove('show');

                                                        tabId2.classList.remove('hide');
                                                        tab2.classList.add('active');
                                                        tab2.classList.add('paso_activo');
                                                        tabId2.classList.add('show');
                                                        tabId2.classList.add('active');

                                                        tabId3.classList.add('hide');
                                                        tabId3.classList.remove('active');
                                                        tab3.classList.remove('active');
                                                        tab3.classList.remove('paso_activo');
                                                        tabId3.classList.remove('show');

                                                        tabId4.classList.add('hide');
                                                        tabId4.classList.remove('active');
                                                        tab4.classList.remove('active');
                                                        tab4.classList.remove('paso_activo');
                                                        tabId4.classList.remove('show');
                                                    });
                                                    btnSTab3.addEventListener('click', function () {
                                                        let tabId1 = document.getElementById('tab-content1_{{$proveedores->id}}');
                                                        let tabId2 = document.getElementById('tab-content2_{{$proveedores->id}}');
                                                        let tabId3 = document.getElementById('tab-content3_{{$proveedores->id}}');
                                                        let tabId4 = document.getElementById('tab-content4_{{$proveedores->id}}');

                                                        tabId1.classList.add('hide');
                                                        tabId1.classList.remove('active');
                                                        tab1.classList.remove('active');
                                                        tab1.classList.remove('paso_activo');
                                                        tabId1.classList.remove('show');

                                                        tabId2.classList.add('hide');
                                                        tabId2.classList.remove('active');
                                                        tab2.classList.remove('active');
                                                        tab2.classList.remove('paso_activo');
                                                        tabId2.classList.remove('show');

                                                        tabId3.classList.add('hide');
                                                        tabId3.classList.remove('active');
                                                        tab3.classList.remove('active');
                                                        tab3.classList.remove('paso_activo');
                                                        tabId3.classList.remove('show');

                                                        tabId4.classList.remove('hide');
                                                        tab4.classList.add('active');
                                                        tab4.classList.add('paso_activo');
                                                        tabId4.classList.add('show');
                                                        tabId4.classList.add('active');
                                                    });

                                                    tab4.addEventListener('click', function () {
                                                        let tabId1 = document.getElementById('tab-content1_{{$proveedores->id}}');
                                                        let tabId2 = document.getElementById('tab-content2_{{$proveedores->id}}');
                                                        let tabId3 = document.getElementById('tab-content3_{{$proveedores->id}}');
                                                        let tabId4 = document.getElementById('tab-content4_{{$proveedores->id}}');

                                                        tabId1.classList.add('hide');
                                                        tabId1.classList.remove('active');
                                                        tab1.classList.remove('active');
                                                        tab1.classList.remove('paso_activo');
                                                        tabId1.classList.remove('show');

                                                        tabId2.classList.add('hide');
                                                        tabId2.classList.remove('active');
                                                        tab2.classList.remove('active');
                                                        tab2.classList.remove('paso_activo');
                                                        tabId2.classList.remove('show');

                                                        tabId3.classList.add('hide');
                                                        tabId3.classList.remove('active');
                                                        tab3.classList.remove('active');
                                                        tab3.classList.remove('paso_activo');
                                                        tabId3.classList.remove('show');

                                                        tabId4.classList.remove('hide');
                                                        tab4.classList.add('active');
                                                        tab4.classList.add('paso_activo');
                                                        tabId4.classList.add('show');
                                                        tabId4.classList.add('active');
                                                    });
                                                    btnATab4.addEventListener('click', function () {
                                                        let tabId1 = document.getElementById('tab-content1_{{$proveedores->id}}');
                                                        let tabId2 = document.getElementById('tab-content2_{{$proveedores->id}}');
                                                        let tabId3 = document.getElementById('tab-content3_{{$proveedores->id}}');
                                                        let tabId4 = document.getElementById('tab-content4_{{$proveedores->id}}');

                                                        tabId1.classList.add('hide');
                                                        tabId1.classList.remove('active');
                                                        tab1.classList.remove('active');
                                                        tab1.classList.remove('paso_activo');
                                                        tabId1.classList.remove('show');

                                                        tabId2.classList.add('hide');
                                                        tabId2.classList.remove('active');
                                                        tab2.classList.remove('active');
                                                        tab2.classList.remove('paso_activo');
                                                        tabId2.classList.remove('show');

                                                        tabId3.classList.remove('hide');
                                                        tab3.classList.add('active');
                                                        tab3.classList.add('paso_activo');
                                                        tabId3.classList.add('show');
                                                        tabId3.classList.add('active');

                                                        tabId4.classList.add('hide');
                                                        tabId4.classList.remove('active');
                                                        tab4.classList.remove('active');
                                                        tab4.classList.remove('paso_activo');
                                                        tabId4.classList.remove('show');
                                                    });

                                                    // function validateForm1() {
                                                    //     campo_nombre.removeAttribute('required');
                                                    //     campo_cel.setCustomValidity("");
                                                    //     campo_cel.removeAttribute("required");
                                                    //     campo_departamento.removeAttribute('required');
                                                    //     campo_municipio.removeAttribute('required');

                                                    //     let form = document.getElementById('form_client');
                                                    //     if (!form.reportValidity()) {
                                                    //         return;
                                                    //     }

                                                    //     // Cambiar a la siguiente pestaña solo si todos los campos son válidos
                                                    //     changeTab1();
                                                    // }

                                                    // function validateForm2() {
                                                    //     campo_nombre.setAttribute('required', true);
                                                    //     campo_cel.setAttribute("required", true);

                                                    //     let form = document.getElementById('form_client');
                                                    //     if (!form.reportValidity()) {
                                                    //         return;
                                                    //     }
                                                    // }

                                                })
                                            </script>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                            <!-- Botones de paginación -->
                            {{$proveedor->links()}}
                            {{-- <div class="text-center w-100"
                                style="display: flex; justify-content: space-between; padding: 0 2%;">
                                <ul class="pagination">
                                    <!-- Botón "Anterior" -->
                                    @if ($proveedor->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item"><a href="{{ $proveedor->previousPageUrl() }}"
                                                class="page-link" rel="prev">&laquo;</a>
                                        </li>
                                    @endif

                                    <!-- Números de página -->
                                    @foreach ($proveedor->getUrlRange(1, $proveedor->lastPage()) as $page => $url)
                                        @if ($page == $proveedor->currentPage())
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
                                    @if ($proveedor->hasMorePages())
                                        <li class="page-item"><a href="{{ $proveedor->nextPageUrl() }}"
                                                class="page-link" rel="next">&raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                                <div class="container-btn-crear">
                                    <a title="Crear Nuevo Proveedor" class="btn btn-primary" data-toggle="modal"
                                        id="create_provider" data-target="#createModal"
                                        style="font-size: 14; padding: 8%;">
                                        Crear
                                    </a>
                                </div>
                            </div> --}}

                            <!-- Modal de creación -->
                            <div class="modal fade createModal" id="createModal" tabindex="-1" role="dialog"
                                aria-labelledby="createModalLabel" aria-hidden="true" style="z-index: 1041;">
                                <div class="modal-dialog" role="document" style="z-index: 1042;">
                                    <div class="modal-content" style="z-index: 1043;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createModalLabel">
                                                Crear nuevo proveedor</h5>
                                            <button class="close" type="button" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="create_modal" action="{{ route('createProvider') }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="nit_create"><span class="text-danger">*</span>NIT:</label>
                                                    <input class="form-control" type="text" id="nit_create"
                                                        name="nit_create" placeholder="Eje. 12345678..."
                                                        autocomplete="on" value="{{ old('nit_create') }}">
                                                    @error('nit_create')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="nombre_comercial_create"><span class="text-danger">*</span>Nombre Establecimiento:</label>
                                                    <input type="text" class="form-control" id="nombre_comercial_create" name="nombre_comercial_create" placeholder="" value="{{old('nombre_comercial_create')}}" maxlength="50" autocomplete="on" required>
                                                    @error('nombre_comercial_create')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="razon_create"><span class="text-danger">*</span>Razón
                                                        Social:</label>
                                                    <input class="form-control" type="text" id="razon_create"
                                                        name="razon_create" placeholder="Eje. Autos Repuestos S A S"
                                                        autocomplete="on" value="{{ old('razon_create') }}" maxlength="100" required>
                                                    @error('razon_create')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="cel_create"><span class="text-danger">*</span>Número de celular:</label>
                                                    <div class="form-control"
                                                        style="display: flex; justify-content: space-between; align-items: center; padding: 0;">
                                                        <select name="codigo_cel_create" id="codigo_cel_create"
                                                            style="border: none; transform: translate(1.5%, 0px); height: auto;">
                                                            @foreach ($codigos as $codigo)
                                                                <option value="{{ $codigo->codigo }}"
                                                                    title="{{ $codigo->pais }}">
                                                                    {{ $codigo->iso . ' ' . $codigo->codigo }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="text" class="form-control" id="cel_create"
                                                            name="cel_create" autocomplete="on"
                                                            value="{{ old('cel_create') }}">
                                                    </div>
                                                    @error('cel_create')
                                                        <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                                    @else
                                                        <div class="w-100 text-center">
                                                            <small
                                                                class="text-center text-xs text-color-secondary">¡Debe tener Whatsapp! <i class="fa fa-whatsapp"
                                                                    aria-hidden="true"
                                                                    style="color: #25D366; font-size: 15px; transform: translate(0px, 2.4px);">
                                                                </i></small>
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="tel_create">Número
                                                        de celular 2°:</label>
                                                    <input type="text" class="form-control" id="tel_create"
                                                        name="tel_create" autocomplete="on"
                                                        value="{{ old('tel_create') }}">
                                                    @error('tel_create')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="flex flex-col mb-3">
                                                    <label for="representante_legal_create">Representante Legal:</label>
                                                    <input id="representante_legal_create" type="text"
                                                        class="form-control" name="representante_legal_create"
                                                        value="{{ old('representante_legal_create') }}" maxlength="60" autocomplete="on">
                                                </div>

                                                <div class="flex flex-col mb-3">
                                                    <label for="contacto_principal_create">Contacto Principal:</label>
                                                    <input id="contacto_principal_create" type="text"
                                                        class="form-control" name="contacto_principal_cerate"
                                                        value="{{ old('contacto_principal_create') }}" autocomplete="on">
                                                </div>

                                                <div id="pais_create" class="flex flex-col mb-3 hide">
                                                    <label>País:</label>
                                                    <div class="form-control">
                                                        <span type="text" id="text_pais_create" name="pais_create"
                                                            style="border: none !important;"></span>
                                                    </div>
                                                </div>

                                                <div id="ciudad_create" class="flex flex-col mb-3 hide">
                                                    <label for="ciudad_create"><span class="text-danger">*</span>Ciudad:</label>
                                                    <input id="ciudad_input_create" type="text" class="form-control"
                                                        name="ciudad_create" value="{{ old('ciudad_create') }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="email_create"><span class="text-danger">*</span>Correo
                                                        electrónico:</label>
                                                    <input type="email" class="form-control" id="email_create"
                                                        name="email_create" placeholder="Eje. ejemplo123@ejemplo.com"
                                                        autocomplete="on" value="{{ old('email_create') }}" required>
                                                    @error('email_create')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="email_2_create">Correo
                                                        electrónico (2°):</label>
                                                    <input type="email" class="form-control" id="email_2_create"
                                                        name="email_2_create" autocomplete="on"
                                                        value="{{ old('email_2_create') }}">
                                                    @error('email_2_create')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-group" id="departamentos_create">
                                                    <label for="departamento"><span class="text-danger">*</span>Departamento:</label>
                                                    <select id="departamento_create" name="departamento_create"
                                                        class="departamento form-control"
                                                        value="{{ old('departamento_create') }}" required>
                                                        <option value="" disabled selected>
                                                            Seleccione un departamento
                                                        </option>
                                                        @foreach ($departamentos as $departamento)
                                                            <option value="{{ $departamento }}">
                                                                {{ $departamento }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('departamento_create')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div id="municipios_create" class="form-group">
                                                    <label for="municipio_create"><span class="text-danger">*</span>Municipio:</label>
                                                    <select id="municipio_create" name="municipio_create"
                                                        class="municipio form-control"
                                                        value="{{ old('municipio_create') }}" required>
                                                        <option value="" disabled selected>
                                                            Seleccione un municipio
                                                        </option>
                                                    </select>
                                                    @error('municipio_create')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="direccion"><span class="text-danger">*</span>Dirección:</label>
                                                    <input type="text" class="form-control" id="direccion_create"
                                                        name="direccion_create" placeholder="Obligatorio" autocomplete="on"
                                                        value="{{ old('direccion_create') }}" maxlength="50" required>
                                                    @error('direccion_create')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <div class="flex flex-col">
                                                        <label for="marcas_create"><span class="text-danger">*</span>Preferencias de Marcas:</label>
                                                        <select name="marcas_create" id="marcas_create"
                                                            class="form-control"
                                                            style="color: var(--bs-secondary-color);">
                                                            <option value="" disabled selected>Seleccionar
                                                                Preferencias</option>
                                                            <option value="Todas las marcas">Todas las marcas</option>
                                                            <!--<option value="AKT">AKT</option>-->
                                                            <option value="Alfa Romeo">Alfa Romeo</option>
                                                            <option value="Alpine">Alpine</option>
                                                            <option value="Aston Martin">Aston Martin</option>
                                                            <!--<option value="Apollo Motors">Apollo Motors</option>-->
                                                            <!--<option value="Aprilia">Aprilia</option>-->
                                                            <option value="Acura">Acura</option>
                                                            <option value="Audi">Audi</option>
                                                            <!--<option value="Auteco">Auteco</option>-->
                                                            <!--<option value="Ayco">Ayco</option>-->
                                                            <option value="BAIC">BAIC</option>
                                                            <!--<option value="Bajaj">Bajaj</option>-->
                                                            <!--<option value="Benelli">Benelli</option>-->
                                                            <option value="Bugatti">Bugatti</option>
                                                            <option value="Brabus">Brabus</option>
                                                            <option value="BMW">BMW</option>
                                                            <option value="BYD">BYD</option>
                                                            <!--<option value="CF Moto">CF Moto</option>-->
                                                            <option value="Changan">Changan</option>
                                                            <option value="Chery">Chery</option>
                                                            <option value="Cupra">Cupra</option>
                                                            <option value="Chevrolet">Chevrolet</option>
                                                            <option value="Cadillac">Cadillac</option>
                                                            <option value="Citroën">Citroën</option>
                                                            <option value="Dodge">Dodge</option>
                                                            <option value="DFSK">DFSK</option>
                                                            <option value="DS">DS</option>
                                                            <!--<option value="Ducati">Ducati</option>-->
                                                            <!--<option value="FAW">FAW</option>-->
                                                            <option value="Fiat">Fiat</option>
                                                            <option value="Ferrari">Ferrari</option>
                                                            <option value="Ford">Ford</option>
                                                            <option value="Foton">Foton</option>
                                                            <option value="Great Wall">Great Wall</option>
                                                            <option value="GMC">GMC</option>
                                                            <option value="Haval">Haval</option>
                                                            <!--<option value="Harley Davidson">Harley Davidson</option>-->
                                                            <!--<option value="Hero Motos">Hero Motos</option>-->
                                                            <option value="Honda">Honda</option>
                                                            <option value="Hummer">Hummer</option>
                                                            <option value="Hennessey">Hennessey</option>
                                                            <option value="Hyundai">Hyundai</option>
                                                            <option value="Infiniti">Infiniti</option>
                                                            <!--<option value="Husqvarna">Husqvarna</option>-->
                                                            <option value="JAC">JAC</option>
                                                            <!--<option value="Jialing Motos">Jialing Motos</option>-->
                                                            <option value="JMC">JMC</option>
                                                            <option value="Jeep">Jeep</option>
                                                            <!--<option value="Kawasaki">Kawasaki</option>-->
                                                            <!--<option value="Keeway">Keeway</option>-->
                                                            <option value="Kia">Kia</option>
                                                            <!--<option value="KTM">KTM</option>-->
                                                            <option value="Kenworth">Kenworth</option>
                                                            <option value="Koenigsegg">Koenigsegg</option>
                                                            <!--<option value="Kymco">Kymco</option>-->
                                                            <option value="Land Rover">Land Rover</option>
                                                            <option value="Lamborghini">Lamborghini</option>
                                                            <option value="Lexus">Lexus</option>
                                                            <option value="Lotus">Lotus</option>
                                                            <option value="Lincoln">Lincoln</option>
                                                            <!--<option value="Lifan">Lifan</option>-->
                                                            <option value="Mahindra">Mahindra</option>
                                                            <option value="Mazda">Mazda</option>
                                                            <option value="McLaren">McLaren</option>
                                                            <option value="Maserati">Maserati</option>
                                                            <option value="Mercedes-Benz">Mercedes-Benz</option>
                                                            <option value="MG">MG</option>
                                                            <option value="Mini">Mini</option>
                                                            <option value="Mitsubishi">Mitsubishi</option>
                                                            <!--<option value="Moto Guzzi Colombia">Moto Guzzi Colombia</option>-->
                                                            <option value="Nissan">Nissan</option>
                                                            <option value="Opel">Opel</option>
                                                            <option value="Peugeot">Peugeot</option>
                                                            <option value="Pontiac">Pontiac</option>
                                                            <!--<option value="Piaggio">Piaggio</option>-->
                                                            <option value="Porsche">Porsche</option>
                                                            <option value="Pagani">Pagani</option>
                                                            <!--<option value="Pulsar">Pulsar</option>-->
                                                            <option value="Renault">Renault</option>
                                                            <option value="Rivian">Rivian</option>
                                                            <option value="Rolls Royce">Rolls Royce</option>
                                                            <!--<option value="Royal Enfield">Royal Enfield</option>-->
                                                            <option value="SEAT">SEAT</option>
                                                            <!--<option value="Sherco">Sherco</option>-->
                                                            <option value="Skoda">Skoda</option>
                                                            <option value="SsangYong">SsangYong</option>
                                                            <!--<option value="Starker">Starker</option>-->
                                                            <option value="Subaru">Subaru</option>
                                                            <option value="Scania">Scania</option>
                                                            <option value="Suzuki">Suzuki</option>
                                                            <!--<option value="SYM">SYM</option>-->
                                                            <option value="Tesla">Tesla</option>
                                                            <option value="Toyota">Toyota</option>
                                                            <!--<option value="Triumph">Triumph</option>-->
                                                            <!--<option value="TVS">TVS</option>-->
                                                            <!--<option value="Vespa">Vespa</option>-->
                                                            <option value="Volkswagen">Volkswagen</option>
                                                            <option value="Volvo">Volvo</option>
                                                            <!--<option value="Yamaha">Yamaha</option>-->
                                                            <!--<option value="Zotye">Zotye</option>-->
                                                            <option value="otro">Otro</option>

                                                        </select>
                                                    </div>
                                                    <div id="marcas_preferencias_create"
                                                        class="marcas_preferencias flex flex-col mb-3">
                                                        <div id="items_container_create"
                                                            class="items_container form-control">

                                                        </div>
                                                        <div class="text-secondary text-xs pt-1">¡Solo le llegaran
                                                            solicitudes de las marcas que elijas!.</div>
                                                    </div>
                                                </div>

                                                <div class="flex flex-col mb-3">
                                                    <label for="categoria_repuesto_create"><span class="text-danger">*</span>Especialidades:</label>
                                                    <select title="Especialidad: ¿En que repuestos se especializa?"
                                                        class="form-control" name="categoria_repuesto_create"
                                                        id="categoria_repuesto_create"
                                                        style="color: var(--bs-secondary-color);" required>
                                                        <option value="" disabled selected>*Seleccionar Especialidad
                                                        </option>
                                                        <option value="Todas las especialidades">Todas las especialidades
                                                        </option>
                                                        <option value="LLantas">LLantas</option>
                                                        <option value="Frenos">Frenos</option>
                                                        <option value="Suspensión">Suspensión</option>
                                                        <option value="Dirección">Sistema de Dirección</option>
                                                        <option value="Motor">Motor</option>
                                                        <option value="Latas">Latas</option>
                                                        <option value="Refrigeración">Refrigeración</option>
                                                        <option value="Eléctricos">Eléctricos
                                                        </option>
                                                        <option value="otros">Otros</option>
                                                    </select>
                                                    <div id="categorias_preferencias_create"
                                                        class="categorias_preferencias flex flex-col mb-3">
                                                        <div id="items_container_categorias_create"
                                                            class="items_container form-control">

                                                        </div>
                                                        @error('json_marcas')
                                                            <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                        @else
                                                            <div class="text-secondary text-xs pt-1">¡Solo le llegaran
                                                                solicitudes de las marcas que elijas!.</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group flex flex-col">
                                                    <span>RUT:</span>
                                                    <label id="btn1_create" class="button form-control" for="rut_create"
                                                        style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                        <div id="text_file_rut_create">
                                                        </div>
                                                        <div><i id="check1_create" class="fa fa-check"
                                                                aria-hidden="true"></i>
                                                        </div>
                                                    </label>
                                                    <input type="file" accept=".pdf" name="rut_create"
                                                        id="rut_create" class="form-control" aria-label="Rut"
                                                        style="display: none;">
                                                    @error('rut_create')
                                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group flex flex-col">
                                                    <span>Camara de comercio:</span>
                                                    <label id="btn2_create" class="button form-control" for="cam_create"
                                                        style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                        <div id="text_file_cam_create"></div>
                                                        <div><i id="check2_create" class="fa fa-check"
                                                                aria-hidden="true"></i></div>
                                                    </label>
                                                    <input type="file" accept=".pdf" name="cam_create"
                                                        id="cam_create" class="form-control" aria-label="Cam"
                                                        style="display: none;">
                                                    @error('cam_create')
                                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="estado">Estado:</label>
                                                    <select class="form-control" id="estado_create" name="estado_create"
                                                        value="{{ old('estado_create') }}">
                                                        <option value="" disabled selected>
                                                            Estado
                                                        </option>
                                                        <option value="1">
                                                            Activo</option>
                                                        <option value="0">
                                                            Inactivo</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Guardar
                                                    Cambios</button>
                                            </form>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    let nit = document.getElementById('nit_create');

                                    function nitValidity() {
                                        if (nit.value.length != 0) {
                                            nit.value = nit.value.slice(0, 12);
                                            if (nit.value.length < 8) {
                                                nit.setCustomValidity("El nit es muy corto");
                                            } else if (isNaN(nit.value)) {
                                                nit.setCustomValidity("El nit debe contener solo números");
                                            } else {
                                                nit.setCustomValidity("");
                                            }
                                        } else {
                                            nit.setCustomValidity("");
                                        }
                                    }

                                    nit.addEventListener('input', nitValidity);

                                    nitValidity();
                                });
                            </script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {

                                    let text_rut = document.getElementById('text_file_rut_create');
                                    let text_cam = document.getElementById('text_file_cam_create');

                                    let rut = document.getElementById('rut_create');
                                    let cam = document.getElementById('cam_create');

                                    const btn1 = document.getElementById('btn1_create');
                                    const i1 = document.getElementById('check1_create');
                                    i1.style.display = "none";

                                    const btn2 = document.getElementById('btn2_create');
                                    const i2 = document.getElementById('check2_create');
                                    i2.style.display = 'none';

                                    rut.addEventListener('change', function() {
                                        if (this.files.length > 0) {
                                            console.log('Se ha seleccionado al menos un archivo.');
                                            btn1.style.borderColor = 'rgb(157, 232, 157)';
                                            i1.style.display = 'block';
                                            text_rut.innerHTML = this.files[0].name;
                                        }
                                    });

                                    cam.addEventListener('change', function() {
                                        if (this.files.length > 0) {
                                            btn2.style.borderColor = 'rgb(157, 232, 157)';
                                            i2.style.display = 'block';
                                            text_cam.innerHTML = this.files[0].name;
                                        }
                                    });
                                });
                            </script>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    let categoria = document.getElementById('categoria_repuesto_create');
                                    let container = document.getElementById('items_container_categorias_create');
                                    let categorias_preferencias = document.getElementById('categorias_preferencias_create');
                                    categorias_preferencias.classList.add('hide');

                                    // Intentar recuperar las categorias seleccionadas del localStorage
                                    let categoriaSeleccionados_create = JSON.parse(localStorage.getItem('categoriaSeleccionados_create')) ||
                                    {};

                                    // Función para agregar un botón
                                    function agregarBoton(item_category) {
                                        let button = document.createElement('button');
                                        button.classList.add('item_selected');
                                        button.setAttribute('name', 'item_category');
                                        button.innerHTML = item_category + '<span class="btn_borrar_item">×</span>';

                                        // Agregar un evento de escucha de clics al botón
                                        button.addEventListener('click', function() {
                                            // Eliminar el botón del contenedor
                                            container.removeChild(button);

                                            // Eliminar la opción del objeto seleccionados
                                            delete categoriaSeleccionados_create[item_category];

                                            // Guardar las categorias seleccionadas en el localStorage
                                            localStorage.setItem('categoriaSeleccionados_create', JSON.stringify(
                                                categoriaSeleccionados_create));

                                            if (Object.keys(categoriaSeleccionados_create).length === 0) {
                                                categoria.setAttribute('required', true);
                                            }
                                        });

                                        container.appendChild(button);

                                        // Marcar la opción como seleccionada
                                        categoriaSeleccionados_create[item_category] = true;

                                        // Guardar las categorias seleccionadas en el localStorage
                                        localStorage.setItem('categoriaSeleccionados_create', JSON.stringify(
                                        categoriaSeleccionados_create));
                                    }

                                    // Si hay categorias seleccionadas, recrear los botones
                                    if (Object.keys(categoriaSeleccionados_create).length > 0) {
                                        categorias_preferencias.classList.remove('hide');
                                        categoria.removeAttribute('required');
                                        for (let item_category in categoriaSeleccionados_create) {
                                            agregarBoton(item_category);
                                        }
                                    }

                                    categoria.addEventListener('change', function() {
                                        let item_category = categoria.value;
                                        if (item_category !== "") {
                                            if (!categoriaSeleccionados_create[item_category]) {
                                                agregarBoton(item_category);
                                                categorias_preferencias.classList.remove('hide');
                                                categoria.removeAttribute('required');
                                            }
                                        }
                                    });

                                    if (Object.keys(categoriaSeleccionados_create).length === 0) {
                                        categoria.setAttribute('required', true);
                                    } else {
                                        categoria.removeAttribute('required');
                                    }

                                    document.getElementById('create_modal').addEventListener('submit', function(event) {
                                        event.preventDefault(); // Evitar el envío del formulario para manejarlo manualmente

                                        // Obtener los textos de los botones en un arreglo
                                        let textosSeleccionados = Object.keys(categoriaSeleccionados_create);

                                        // Convertir el arreglo a una cadena JSON
                                        let jsonTextosSeleccionados = JSON.stringify(textosSeleccionados);

                                        // Agregar un campo oculto al formulario y asignarle la cadena JSON
                                        let inputJsonCategory = document.createElement('input');
                                        inputJsonCategory.type = 'hidden';
                                        inputJsonCategory.name = 'json_categorias_create';
                                        inputJsonCategory.value = jsonTextosSeleccionados.replace(/×/g, '').replace(/\n/g, '');
                                        this.appendChild(inputJsonCategory);

                                        // Limpiar los datos en localStorage después de enviar el formulario
                                        localStorage.removeItem('categoriaSeleccionados_create');

                                        container.innerHTML = "";

                                        // Ahora, puedes enviar el formulario
                                        this.submit();
                                    });
                                });
                            </script>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    let marcas = document.getElementById('marcas_create');
                                    let container = document.getElementById('items_container_create');
                                    let marcas_preferencias = document.getElementById('marcas_preferencias_create');
                                    marcas_preferencias.classList.add('hide');

                                    // Intentar recuperar las marcas seleccionadas del localStorage
                                    let seleccionados_create = JSON.parse(localStorage.getItem('seleccionados_create')) || {};

                                    // Función para agregar un botón
                                    function agregarBoton(item) {
                                        let button = document.createElement('button');
                                        button.classList.add('item_selected');
                                        button.setAttribute('name', 'item_create');
                                        button.innerHTML = item + '<span class="btn_borrar_item">×</span>';

                                        // Agregar un evento de escucha de clics al botón
                                        button.addEventListener('click', function() {
                                            // Eliminar el botón del contenedor
                                            container.removeChild(button);

                                            // Eliminar la opción del objeto seleccionados
                                            delete seleccionados_create[item];

                                            // Guardar las marcas seleccionadas en el localStorage
                                            localStorage.setItem('seleccionados_create', JSON.stringify(seleccionados_create));

                                            if (!Object.keys(seleccionados_create).length === 0) {
                                                marcas.removeAttribute('required');
                                            }
                                        });

                                        container.appendChild(button);

                                        // Marcar la opción como seleccionada
                                        seleccionados_create[item] = true;

                                        // Guardar las marcas seleccionadas en el localStorage
                                        localStorage.setItem('seleccionados_create', JSON.stringify(seleccionados_create));
                                    }

                                    // Si hay marcas seleccionadas, recrear los botones
                                    if (Object.keys(seleccionados_create).length > 0) {
                                        marcas_preferencias.classList.remove('hide');
                                        marcas.removeAttribute('required');
                                        for (let item in seleccionados_create) {
                                            agregarBoton(item);
                                        }
                                    }

                                    marcas.addEventListener('change', function() {
                                        let item = marcas.value;
                                        if (item !== "") {
                                            if (!seleccionados_create[item]) {
                                                agregarBoton(item);
                                                marcas_preferencias.classList.remove('hide');
                                                if (Object.keys(seleccionados_create).length === 0) {
                                                    marcas.setAttribute('required', true);
                                                }
                                            }
                                        }
                                    });

                                    if (Object.keys(seleccionados_create).length === 0) {
                                        marcas.setAttribute('required', true);
                                    } else {
                                        marcas.removeAttribute('required');
                                    }

                                    document.getElementById('create_modal').addEventListener('submit', function(event) {
                                        event.preventDefault(); // Evitar el envío del formulario para manejarlo manualmente

                                        // Obtener los textos de los botones en un arreglo
                                        let textosSeleccionados = Object.keys(seleccionados_create);

                                        // Convertir el arreglo a una cadena JSON
                                        let jsonTextosSeleccionados = JSON.stringify(textosSeleccionados);

                                        // Agregar un campo oculto al formulario y asignarle la cadena JSON
                                        let inputJson = document.createElement('input');
                                        inputJson.type = 'hidden';
                                        inputJson.name = 'json_marcas_create';
                                        inputJson.value = jsonTextosSeleccionados.replace(/×/g, '').replace(/\n/g, '');
                                        this.appendChild(inputJson);

                                        // Limpiar los datos en localStorage después de enviar el formulario
                                        localStorage.removeItem('seleccionados_create');
                                        container.innerHTML = "";

                                        // Ahora, puedes enviar el formulario
                                        this.submit();
                                    });

                                });
                            </script>

                            <script>
                                // Obtener los elementos del formulario dentro de cada iteración
                                const departamentoSelect = document.getElementById('departamento_create');
                                const municipioSelect = document.getElementById('municipio_create');

                                // Función para cargar los municipios según el departamento seleccionado
                                function cargarMunicipios(departamento) {
                                    municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                                    // Obtener los municipios del departamento seleccionado del objeto PHP $group
                                    const municipios = {!! json_encode($group) !!}[departamento];
                                    if (municipios) {
                                        // Agregar las opciones de los municipios al campo de municipio
                                        municipios.forEach(municipio => {
                                            municipioSelect.innerHTML += `<option value="${municipio}">${municipio}</option>`;
                                        });
                                    }
                                }

                                // Evento para cargar los municipios al seleccionar un departamento
                                departamentoSelect.addEventListener('change', function() {
                                    const selectedDepartamentoCreate = departamentoSelect.value;
                                    if (selectedDepartamentoCreate) {
                                        cargarMunicipios(selectedDepartamentoCreate);
                                    } else {
                                        // Si no se ha seleccionado un departamento, limpiar el campo de municipio
                                        municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                                    }

                                    // Guardar la selección actual en localStorage cuando cambia
                                    localStorage.setItem('selectedDepartamentoCreate', selectedDepartamentoCreate);
                                });

                                // Obtener el valor anterior de 'departamento' almacenado en localStorage
                                const storedDepartamento = localStorage.getItem('selectedDepartamentoCreate');

                                // Verificar si hay un valor almacenado y establecerlo como la opción seleccionada
                                if (storedDepartamento) {
                                    departamentoSelect.value = storedDepartamento;
                                    cargarMunicipios(storedDepartamento);
                                }
                            </script>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    let codigo = document.getElementById('codigo_cel_create');

                                    let cel = document.getElementById('cel_create');
                                    let tel = document.getElementById('tel_create');

                                    let pais = document.getElementById('pais_create');
                                    let ciudad = document.getElementById('ciudad_create');
                                    let textPais = document.getElementById('text_pais_create');
                                    let departamento = document.getElementById('departamentos_create');
                                    let municipio = document.getElementById('municipios_create');

                                    // Función para limpiar el número de celular
                                    function limpiarCelular() {
                                        cel.value = cel.value.replace(/[^\d]/g, '');
                                        if (codigo.value == '+54') {
                                            cel.value = cel.value.slice(0, 10);
                                            tel.value = tel.value.slice(0, 10);
                                        } else if (codigo.value == '+591') {
                                            cel.value = cel.value.slice(0, 8);
                                            tel.value = tel.value.slice(0, 8);
                                        } else if (codigo.value == '+55') {
                                            cel.value = cel.value.slice(0, 11);
                                            tel.value = tel.value.slice(0, 11);
                                        } else if (codigo.value == '+56') {
                                            cel.value = cel.value.slice(0, 9);
                                            tel.value = tel.value.slice(0, 9);
                                        } else if (codigo.value == '+593') {
                                            cel.value = cel.value.slice(0, 10);
                                            tel.value = tel.value.slice(0, 10);
                                        } else if (codigo.value == '+594') {
                                            cel.value = cel.value.slice(0, 9);
                                            tel.value = tel.value.slice(0, 9);
                                        } else if (codigo.value == '+592') {
                                            cel.value = cel.value.slice(0, 7);
                                            tel.value = tel.value.slice(0, 7);
                                        } else if (codigo.value == '+595') {
                                            cel.value = cel.value.slice(0, 9);
                                            tel.value = tel.value.slice(0, 9);
                                        } else if (codigo.value == '+51') {
                                            cel.value = cel.value.slice(0, 9);
                                            tel.value = tel.value.slice(0, 9);
                                        } else if (codigo.value == '+597') {
                                            cel.value = cel.value.slice(0, 7);
                                            tel.value = tel.value.slice(0, 7);
                                        } else if (codigo.value == '+598') {
                                            cel.value = cel.value.slice(0, 8);
                                            tel.value = tel.value.slice(0, 8);
                                        } else if (codigo.value == '+58') {
                                            cel.value = cel.value.slice(0, 10);
                                            tel.value = tel.value.slice(0, 10);
                                        } else if (codigo.value == '+57') {
                                            cel.value = cel.value.slice(0, 10);
                                            tel.value = tel.value.slice(0, 10);
                                        } else if (codigo.value == '+1') {
                                            cel.value = cel.value.slice(0, 10);
                                            tel.value = tel.value.slice(0, 10);
                                        } else if (codigo.value == '+506') {
                                            cel.value = cel.value.slice(0, 8);
                                            tel.value = tel.value.slice(0, 8);
                                        } else if (codigo.value == '+503') {
                                            cel.value = cel.value.slice(0, 8);
                                            tel.value = tel.value.slice(0, 8);
                                        } else if (codigo.value == '+502') {
                                            cel.value = cel.value.slice(0, 8);
                                            tel.value = tel.value.slice(0, 8);
                                        } else if (codigo.value == '+504') {
                                            cel.value = cel.value.slice(0, 8);
                                            tel.value = tel.value.slice(0, 8);
                                        } else if (codigo.value == '+52') {
                                            cel.value = cel.value.slice(0, 10);
                                            tel.value = tel.value.slice(0, 10);
                                        } else if (codigo.value == '+505') {
                                            cel.value = cel.value.slice(0, 8);
                                            tel.value = tel.value.slice(0, 8);
                                        } else if (codigo.value == '+507') {
                                            cel.value = cel.value.slice(0, 8);
                                            tel.value = tel.value.slice(0, 8);
                                        }
                                    }

                                    // Asigna la función al evento input del campo de celular
                                    cel.addEventListener('input', limpiarCelular);
                                    tel.addEventListener('input', limpiarCelular);

                                    function updateVisibility() {
                                        sessionStorage.setItem('codigo', codigo.value);

                                        if (codigo.value == '+54') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');

                                            if (isNaN(cel.value) || cel.value.length != 10) {
                                                cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }

                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 10) {
                                                tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }

                                            textPais.textContent = 'Argentina';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+591') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');


                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }

                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }

                                            textPais.textContent = 'Bolivia';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+55') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');

                                            if (isNaN(cel.value) || cel.value.length != 11) {
                                                cel.setCustomValidity("El número de celular debe tener 11 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }

                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 11) {
                                                tel.setCustomValidity("El número de celular debe tener 11 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }

                                            textPais.textContent = 'Brasil';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+56') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');

                                            if (isNaN(cel.value) || cel.value.length != 9) {
                                                cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }
                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 9) {
                                                tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }

                                            textPais.textContent = 'Chile';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+593') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 10) {
                                                cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }

                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 10) {
                                                tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }

                                            textPais.textContent = 'Ecuador';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+594') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 9) {
                                                cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 9) {
                                                tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }
                                            textPais.textContent = 'Guayana Francesa';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+592') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 7) {
                                                cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }

                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 7) {
                                                tel.setCustomValidity("El número de celular debe tener 7 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }

                                            textPais.textContent = 'Guyana';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+595') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 9) {
                                                cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 9) {
                                                tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }


                                            textPais.textContent = 'Paraguay';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+51') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 9) {
                                                cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }

                                            if (isNaN(tel.value) || tel.value.length != 9) {
                                                tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }

                                            textPais.textContent = 'Perú';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+597') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            ciudad.classList.remove('hide');
                                            pais.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 7) {
                                                cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 7) {
                                                tel.setCustomValidity("El número de celular debe tener 7 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }

                                            textPais.textContent = 'Surinam';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+598') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }

                                            textPais.textContent = 'Uruguay';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+58') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 10) {
                                                cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }

                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 10) {
                                                tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }
                                            textPais.textContent = 'Venezuela';

                                            // Elimina el atributo 'required'
                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+57') {
                                            departamento.classList.remove('hide');
                                            municipio.classList.remove('hide');
                                            pais.classList.add('hide');
                                            ciudad.classList.add('hide');
                                            if (isNaN(cel.value) || cel.value.length != 10) {
                                                cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 10) {
                                                tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }
                                            textPais.textContent = 'Colombia';

                                            // Establece los campos como obligatorios
                                            departamento.setAttribute('required', true);
                                            municipio.setAttribute('required', true);
                                        } else if (codigo.value == '+1') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 10) {
                                                cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 10) {
                                                tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }
                                            textPais.textContent = 'Estados Unidos';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+506') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }
                                            textPais.textContent = 'Costa Rica';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+503') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }
                                            textPais.textContent = 'El Salvador';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+502') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }
                                            textPais.textContent = 'Guatemala';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+504') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }

                                            textPais.textContent = 'Honduras';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+52') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 10) {
                                                cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 10) {
                                                tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }
                                            textPais.textContent = 'México';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+505') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }
                                            textPais.textContent = 'Nicaragua';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        } else if (codigo.value == '+507') {
                                            departamento.classList.add('hide');
                                            municipio.classList.add('hide');
                                            pais.classList.remove('hide');
                                            ciudad.classList.remove('hide');
                                            if (isNaN(cel.value) || cel.value.length != 8) {
                                                cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                cel.setCustomValidity("");
                                            }


                                            if (tel.value == "") {
                                                tel.setCustomValidity("");
                                            } else if (isNaN(tel.value) || tel.value.length != 8) {
                                                tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                            } else {
                                                tel.setCustomValidity("");
                                            }
                                            textPais.textContent = 'Panamá';

                                            departamento.removeAttribute('required');
                                            municipio.removeAttribute('required');
                                        }
                                    }

                                    codigo.addEventListener('change', updateVisibility);
                                    cel.addEventListener('change', updateVisibility);
                                    tel.addEventListener('change', updateVisibility);
                                    updateVisibility();
                                });
                            </script>
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

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@endsection
