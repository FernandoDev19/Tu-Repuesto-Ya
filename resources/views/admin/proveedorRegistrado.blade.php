@extends('layouts.baseAdmin')

@section('title', 'Tu Repuesto Ya - Proveedores')

<style>
    .hide {
        display: none;
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

@section('sidebar')

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de control</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @can('solicitudes.view')
        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Componentes</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item" href="{{ route('viewSolicitudes') }}">Solicitudes</a>
                    <a class="collapse-item" href="{{ route('viewRespuestas') }}">Respuestas</a>
                </div>
            </div>
        </li>
    @endcan

    <!-- Nav Item - Proveedores -->
    @can('providers.loadProviders')
        <li class="nav-item active">
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
                                <div>
                                    <h1 class="font-weight-bold text-primary">Nuevo proveedor registrado</h1>
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

                                                <tr>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="nit_empresa"
                                                        data-valor="{{ $proveedores->nit_empresa }}">
                                                        <span style="font-size: 14;"
                                                            id="nit_empresa_{{ $proveedores->id }}">{{ $proveedores->nit_empresa }}</span>
                                                    </td>

                                                    <td style="padding: 10px; margin: 0; text-align: center;" data-campo="nombre_comercial" data-valor="{{$proveedores->nombre_comercial}}">
                                                        <span style="font-size: 14px;" id="nombre_comercial_{{$proveedores->id}}">{{ $proveedores->nombre_comercial }}</span>
                                                    </td>

                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="razon_social"
                                                        data-valor="{{ $proveedores->razon_social }}">
                                                        <span style="font-size: 14;"
                                                            id="razon_social_{{ $proveedores->id }}">{{ $proveedores->razon_social }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="celular" data-valor="{{ $proveedores->celular }}">
                                                        <span style="font-size: 14;"
                                                            id="celular_{{ $proveedores->id }}">{{ $proveedores->celular }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="departamento"
                                                        data-valor="{{ $proveedores->departamento }}">
                                                        <span style="font-size: 14;"
                                                            id="departamento_{{ $proveedores->id }}">{{ $proveedores->departamento }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="municipio"
                                                        data-valor="{{ $proveedores->municipio }}">
                                                        <span style="font-size: 14;"
                                                            id="municipio_{{ $proveedores->id }}">{{ $proveedores->municipio }}</span>
                                                    </td>
                                                    <td
                                                        style="padding:10px 10px; margin:0; text-align:center;">
                                                        <a title="Ver RUT"
                                                            style="font-size: 14; color: #858796; text-decoration: underline;"
                                                            href="{{ route('mostrarArchivo', ['filename' => 'RUT_' . $proveedores->nit_empresa . '.pdf']) }}"
                                                            target="_blank" rel="noopener noreferrer">RUT</a>
                                                    </td>
                                                    <td
                                                        style="padding:10px 10px; margin:0; text-align:center; font-size: 14;">
                                                        <a title="Ver camara de comercio"
                                                            style="color: #858796; text-decoration: underline;"
                                                            href="{{ route('mostrarArchivo', 'Camara_de_comercio_' . $proveedores->nit_empresa . '.pdf') }}"
                                                            target="_blank" rel="noopener noreferrer">C. Comercio</a>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center;"
                                                        data-campo="fecha" data-valor="{{ $proveedores->created_at->diffForHumans() }}">
                                                        <span style="font-size: 14;"
                                                            id="fecha_{{ $proveedores->id }}">{{ $proveedores->created_at->diffForHumans() }}</span>
                                                    </td>
                                                    <td style="padding:10px 10px; margin:0; text-align:center; font-size: 14;"
                                                        data-campo="estado"
                                                        data-valor="{{ $proveedores->estado ? 'Activo' : 'Inactivo' }}">
                                                        @if($proveedores->estado)
                                                         <i class="fas fa-circle" style="color:#12e912;;"></i>
                                                         @else
                                                         <i class="fas fa-circle" style="color:#ff5a51;"></i>
                                                         @endif
                                                    </td>
                                                    <td style="padding:0px; width: 6vw;" class="text-center">
                                                        <a title="Ver detalles" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#infoModal{{ $proveedores->id }}"
                                                            style="font-size: 14; padding: 5%;">
                                                            <i class="fas fa-info-circle"></i>
                                                            </a>
                                                    </td>

                                                        <!-- Modal de Información -->
                                                    <div class="modal fade" id="infoModal{{ $proveedores->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="infoModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="infoModalLabel">
                                                                        <strong>Información
                                                                        del Proveedor</strong></h5>
                                                                    <button class="close" type="button"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body d-flex justify-content-between">
                                                                     <div id="{{$proveedores->id}}" class="text-wrap">
                                                                        @php
                                                                            $especialidades[$proveedores->id] = json_decode($proveedores->especialidad, true);
                                                                        @endphp
                                                                        <ul style="padding-left: 2rem;">
                                                                            <fieldset>
                                                                                <legend style="text-align: center;"><strong>Información Básica:</strong></legend>
                                                                                <li><strong>NIT: </strong>{{ $proveedores->nit_empresa }}</li>

                                                                                <li><strong>Nombre Establecimiento: </strong>
                                                                                    {{ $proveedores->nombre_comercial }}
                                                                                </li>

                                                                                <li><strong>Razón Social: </strong>{{ $proveedores->razon_social }}</li>

                                                                                <li><strong>Pais: </strong>{{ $proveedores->pais }}</li>

                                                                                <li><strong>Departamento: </strong>{{ $proveedores->departamento }}</li>

                                                                                <li> <strong>Municipio: </strong>{{ $proveedores->municipio }}</li>

                                                                                <li><strong>Direccion: </strong>{{ $proveedores->direccion }}</li>
                                                                            </fieldset>

                                                                            <hr>

                                                                            <fieldset>
                                                                                <legend style="text-align: center;"><strong>Información de Contacto:</strong></legend>
                                                                                <li><strong>Celular: </strong>{{$proveedores->celular}}</li>

                                                                                <li><strong>Telefono: </strong>{{ $proveedores->telefono }}</li>

                                                                                <li><strong>Representante Legal: </strong>{{ $proveedores->representante_legal }}</li>

                                                                                <li><strong>Contacto Principal: </strong>{{ $proveedores->contacto_principal }}</li>

                                                                                <li><strong>Email: </strong>{{ $proveedores->email }}</li>

                                                                                <li><strong>Email Secundario: </strong>{{ $proveedores->email_secundario }}</li>
                                                                            </fieldset>

                                                                            <hr>

                                                                            <fieldset>
                                                                                <legend style="text-align: center;"><strong>Información Legal:</strong></legend>
                                                                                <li><strong>RUT: </strong>
                                                                                <a title="Ver RUT" rel="noopener noreferrer" id="rut"
                                                                                style="font-size: 14; color: #858796; text-decoration: underline;"
                                                                                href="{{ route('mostrarArchivo', ['filename' => 'RUT_' . $proveedores->nit_empresa . '.pdf']) }}"
                                                                                target="_blank">{{$proveedores->rut}}</a></li>

                                                                                <li><strong>Camara de comercio: </strong>
                                                                                <a title="Ver camara de comercio"
                                                                                style="color: #858796; text-decoration: underline;" id="camara"
                                                                                rel="noopener noreferrer"
                                                                                href="{{ route('mostrarArchivo', 'Camara_de_comercio_' . $proveedores->nit_empresa . '.pdf') }}"
                                                                                target="_blank">{{$proveedores->camara_comercio}}</a></li>
                                                                            </fieldset>

                                                                            <hr>

                                                                            <fieldset>
                                                                                <legend style="text-align: center;"><strong>Otros Detalles:</strong></legend>
                                                                                 <li><strong>Preferencia de Marcas: </strong>
                                                                                @if(isset($preferencias_de_marcas[$proveedores->id]))
                                                                                    {{ implode(', ', $preferencias_de_marcas[$proveedores->id]) }}
                                                                                @else
                                                                                    No hay preferencias de marcas para este proveedor.
                                                                                @endif</li>

                                                                                    <li><strong>Especialidad: </strong>
                                                                                @if(isset($especialidades[$proveedores->id]))
                                                                                    {{ implode(', ', $especialidades[$proveedores->id]) }}
                                                                                @else
                                                                                    No hay preferencias de marcas para este proveedor.
                                                                                @endif</li>
                                                                            </fieldset>
                                                                            <br>
                                                                        </ul>

                                                                    </div>

                                                                    <button class="btn mt-0 align-self-end"
                                                                        data-id="{{ $proveedores->id }}"
                                                                        data-toggle="modal"
                                                                        data-target="#editModal{{ $proveedores->id }}"
                                                                        onclick="resaltarBotonActivo(this)">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-footer">

                                                                    <button class="btn btn-primary"
                                                                        data-id="{{ $proveedores->id }}"
                                                                        data-toggle="modal"
                                                                        data-target="#eraseModal{{ $proveedores->id }}"
                                                                        onclick="resaltarBotonActivo(this)">
                                                                        Eliminar
                                                                    </button>
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal de edición -->
                                                    <div class="modal fade editModal" id="editModal{{ $proveedores->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
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
                                                                    <form id="edit_modal{{$proveedores->id}}" action="{{ route('editarProveedor') }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf

                                                                        <input type="hidden" name="id"
                                                                            value="{{ $proveedores->id }}">

                                                                        <div class="form-group">
                                                                            <label for="nit_edit">NIT:</label>
                                                                            <input class="form-control" type="text"
                                                                                id="nit_edit_{{$proveedores->id}}"
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
                                                                            <label for="nombre_comercial_edit_{{ $proveedores->id }}">Nombre Establecimiento</label>
                                                                            <input type="text" class="form-control" id="nombre_comercial_edit_{{ $proveedores->id }}" name="nombre_comercial_edit" placeholder="{{$proveedores->nombre_comercial}}" value="{{$proveedores->nombre_comercial}}" autocomplete="on">
                                                                            @error('nombre_comercial_edit')
                                                                                <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="razon_social_edit">Razón
                                                                                Social:</label>
                                                                            <input class="form-control" type="text"
                                                                                id="razon_social_edit{{$proveedores->id}}"
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
                                                                            <div class="form-control" style="display: flex; justify-content: space-between; align-items: center; padding: 0;">
                                                                                <select name="codigo_cel" id="codigo-cel{{$proveedores->id}}" style="border: none; transform: translate(1.5%, 0px); height: auto;">
                                                                                @foreach($codigos as $codigo)
                                                                                    <option value="{{$codigo->codigo}}" title="{{$codigo->pais}}">{{$codigo->iso.' '.$codigo->codigo}}</option>
                                                                                @endforeach
                                                                                </select>
                                                                                <input type="text" class="form-control"
                                                                                    id="cel_edit_{{$proveedores->id}}" name="cel_edit"
                                                                                    placeholder=""
                                                                                    value="@if ($proveedores->pais == 'Colombia' || $proveedores->pais == 'Argentina' || $proveedores->pais == 'Venezuela' || $proveedores->pais == 'Mexico' || $proveedores->pais == 'Chile' || $proveedores->pais == 'Venezuela' || $proveedores->pais == 'Perú' || $proveedores->pais == 'Brasil'){{ substr($proveedores->celular, 3) }}
@elseif ($proveedores->pais == 'Bolivia' || $proveedores->pais == 'Perú' || $proveedores->pais == 'Ecuador' || $proveedores->pais == 'Guayana Francesa' || $proveedores->pais == 'Guyana' || $proveedores->pais == 'Paraguay' || $proveedores->pais == 'Surinam' || $proveedores->pais == 'Uruguay' || $proveedores->pais == 'Costa Rica' || $proveedores->pais == 'El Salvador' || $proveedores->pais =='Guatemala' || $proveedores->pais == 'Honduras' || $proveedores->pais == 'Nicaragua' || $proveedores->pais == 'Panamá'){{ substr($proveedores->celular, 4) }}
@endif"
                                                                                    autocomplete="on">
                                                                            </div>
                                                                            @error('cel')
                                                                                <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="tel">Número
                                                                                de telefono:</label>
                                                                            <input type="text" class="form-control"
                                                                                id="tel{{$proveedores->id}}" name="tel_edit"
                                                                                placeholder="{{$proveedores->telefono }}"
                                                                                value="{{ $proveedores->telefono }}"
                                                                                autocomplete="on">
                                                                            @error('tel_edit')
                                                                                <small
                                                                                    class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="flex flex-col mb-3">
                                                                            <label for="representante_legal">Representante Legal</label>
                                                                            <input id="representante_legal_{{$proveedores->id}}" type="text" class="form-control" name="representante_legal" value="{{$proveedores->representante_legal}}">
                                                                        </div>

                                                                        <div class="flex flex-col mb-3">
                                                                            <label for="contacto_principal">Contacto Principal</label>
                                                                            <input id="contacto_principal_{{$proveedores->id}}" type="text" class="form-control" name="contacto_principal" value="{{$proveedores->contacto_principal}}">
                                                                        </div>

                                                                        <div id="pais{{$proveedores->id}}" class="flex flex-col mb-3 hide">
                                                                            <label>País:</label>
                                                                            <div class="form-control">
                                                                                <span type="text" id="text-pais_edit{{$proveedores->id}}" name="pais" style="border: none !important;">{{$proveedores->pais}}</span>
                                                                            </div>
                                                                        </div>

                                                                        <div id="ciudad{{$proveedores->id}}" class="flex flex-col mb-3 hide">
                                                                            <labe for="ciudad_edit">Ciudad:</labe>
                                                                            <input id="ciudad_input_{{$proveedores->id}}" type="text" class="form-control" name="ciudad_edit" value="{{$proveedores->municipio}}">
                                                                        </div>

                                                                        <div class="form-group" id="departamentos{{$proveedores->id}}">
                                                                            <label for="departamento">Departamento:</label>
                                                                            <select id="departamento{{$proveedores->id}}"
                                                                                name="departamento_edit"
                                                                                class="departamento form-control">
                                                                                <option value="">
                                                                                    Seleccione un departamento
                                                                                </option>
                                                                                @foreach ($departamentos as $departamento)
                                                                                    <option value="{{ $departamento }}">
                                                                                        {{$departamento}}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div id="municipios{{$proveedores->id}}" class="form-group">
                                                                            <label for="municipio_edit">Municipio:</label>
                                                                            <select id="municipio{{$proveedores->id}}" name="municipio_edit"
                                                                                class="municipio form-control">
                                                                                <option value="">
                                                                                    Seleccione un municipio
                                                                                    </option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="direccion">Dirección:</label>
                                                                            <input type="text" class="form-control"
                                                                                id="direccion{{$proveedores->id}}" name="direccion_edit"
                                                                                placeholder="{{ $proveedores->direccion }}"
                                                                                value="{{ $proveedores->direccion }}"
                                                                                autocomplete="on">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="email">Correo
                                                                                electrónico:</label>
                                                                            <input type="email" class="form-control"
                                                                                id="email{{$proveedores->id}}" name="email_edit"
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
                                                                                id="email_2{{$proveedores->id}}" name="email_2_edit"
                                                                                placeholder="{{ $proveedores->email_secundario }}"
                                                                                value="{{ $proveedores->email_secundario }}"
                                                                                autocomplete="on">
                                                                            @error('email_edit')
                                                                                <small
                                                                                    class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <div class="flex flex-col">
                                                                                  <label for="marcas">Preferencias de Marcas</label>
                                                                                <select name="marcas" id="marcas{{$proveedores->id}}" class="form-control"
                                                                                    style="color: var(--bs-secondary-color);">
                                                                                    <option value="" disabled selected>Seleccionar Preferencias</option>
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
                                                                            <div id="marcas_preferencias{{$proveedores->id}}" class="marcas_preferencias flex flex-col mb-3">
                                                                                <div id="items_container{{$proveedores->id}}" class="items_container form-control">
                                                                                    @if(is_string($proveedores->marcas_preferencias))
                                                                                        @php
                                                                                            $marcas = json_decode($proveedores->marcas_preferencias);
                                                                                        @endphp
                                                                                        @foreach($marcas as $marca)
                                                                                            <button type="button" class="item_selected" name="item">{{$marca}}</button>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </div>
                                                                                <div class="text-secondary text-xs pt-1">¡Solo le llegaran solicitudes de las marcas que elijas!.</div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="flex flex-col mb-3">
                                                                            <label for="categoria_repuesto">Especialidad</label>
                                                                            <input title="Especialidad: ¿En que repuestos se especializa?" id="categoria_otro{{$proveedores->id}}" class="form-control hide" value="{{old('categoria_repuesto')}}" placeholder="*Cual?" autofocus>
                                                                            <select title="Especialidad: ¿En que repuestos se especializa?" class="form-control" name="categoria_repuesto" id="categoria_repuesto{{$proveedores->id}}" name="categoria_repuesto"
                                                                                style="color: var(--bs-secondary-color);">
                                                                                    <option value="" disabled selected>*Especialidad</option>
                                                                                    <option value="Frenos">Frenos</option>
                                                                                    <option value="Eléctricos">Eléctricos</option>
                                                                                    <option value="Batería">Batería</option>
                                                                                    <option value="Luces">Luces</option>
                                                                                    <option value="Filtros">Filtros</option>
                                                                                    <option value="Correas">Correas</option>
                                                                                    <option value="Suspensión">Suspensión</option>
                                                                                    <option value="Transmisión">Transmisión</option>
                                                                                    <option value="Motor">Motor</option>
                                                                                    <option value="Accesorios">Accesorios</option>
                                                                                    <option value="Llantas">Llantas</option>
                                                                                    <option value="Vidrios">Vidrios</option>
                                                                                    <option value="Mangueras">Mangueras</option>
                                                                                    <option value="Refrigeración">Refrigeración</option>
                                                                                    <option value="Liquidos">Liquidos</option>
                                                                                    <option value="Frenos">Frenos</option>
                                                                                    <option value="Mofles">Mofles</option>
                                                                                    <option value="No Se">No Sé</option>
                                                                                    <option value="otros">Otros</option>
                                                                            </select>
                                                                            @error('categoria_repuesto')
                                                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                                            @else
                                                                                <div class="text-secondary text-xs pt-1">¿En que repuestos se especializa?</div>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group flex flex-col">
                                                                            <span>RUT:</span>
                                                                            <label id="btn1{{$proveedores->id}}" class="button form-control" for="rut{{$proveedores->id}}"
                                                                            style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                                            <div id="text_file_rut{{$proveedores->id}}" placeholder="{{$proveedores->rut}}">
                                                                            </div>
                                                                            <div><i id="check1{{$proveedores->id}}" class="fa fa-check"
                                                                                    aria-hidden="true"></i>
                                                                            </div>
                                                                        </label>
                                                                        <input type="file" accept=".pdf" name="rut" id="rut{{$proveedores->id}}"
                                                                            class="form-control" aria-label="Rut" style="display: none;">
                                                                        @error('rut')
                                                                            <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                                        @enderror
                                                                        </div>

                                                                        <div class="form-group flex flex-col">
                                                                            <span>Camara de comercio:</span>
                                                                            <label id="btn2{{$proveedores->id}}" class="button form-control" for="cam{{$proveedores->id}}"
                                                                                style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                                                <div id="text_file_cam{{$proveedores->id}}" placeholder="{{$proveedores->camara_comercio}}"></div>
                                                                                <div><i id="check2{{$proveedores->id}}" class="fa fa-check"
                                                                                        aria-hidden="true"></i></div>
                                                                            </label>
                                                                            <input type="file" accept=".pdf" name="cam" id="cam{{$proveedores->id}}"
                                                                                class="form-control" aria-label="Cam" style="display: none;">
                                                                            @error('cam')
                                                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="estado">Estado:</label>
                                                                            <select class="form-control" id="estado{{$proveedores->id}}"
                                                                                name="estado_edit">
                                                                                <option value="">
                                                                                    Estado ({{$proveedores->estado? 'Activo': 'Inactivo'}})
                                                                                </option>
                                                                                <option value="1">
                                                                                    Activo</option>
                                                                                <option value="0">
                                                                                    Inactivo</option>
                                                                            </select>
                                                                        </div>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Guardar
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

                                                    <!-- Modal para eliminar -->
                                                    <div class="modal fade" id="eraseModal{{ $proveedores->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="eraseModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
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

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

 <script>
                                                        document.addEventListener('DOMContentLoaded', function () {
                                                            let codigo = document.getElementById('codigo-cel{{$proveedores->id}}');

                                                                // Obtener el valor del código del proveedor
                                                            let codigoProveedor = '{{ $proveedores->pais }}';

                                                            if(codigoProveedor == 'Argentina'){
                                                                // Establecer el valor del select al valor del proveedor
                                                                codigo.value = "+54";
                                                            }else if(codigoProveedor == 'Bolivia'){
                                                                codigo.value = "+591";
                                                            }else if(codigoProveedor == 'Brasil'){
                                                                codigo.value = "+55";
                                                            }else if(codigoProveedor == 'Chile'){
                                                                codigo.value = "+56";
                                                            }else if(codigoProveedor == 'Ecuador'){
                                                                codigo.value = "+593";
                                                            }else if(codigoProveedor == 'Guayana Francesa'){
                                                                codigo.value = "+594";
                                                            }else if(codigoProveedor == 'Guyana'){
                                                                codigo.value = "+592";
                                                            }else if(codigoProveedor == 'Paraguay'){
                                                                codigo.value = "+595";
                                                            }else if(codigoProveedor == 'Perú'){
                                                                codigo.value = "+51";
                                                            }else if(codigoProveedor == 'Surinam'){
                                                                codigo.value = "+597";
                                                            }else if(codigoProveedor == 'Uruguay'){
                                                                codigo.value = "+598";
                                                            }else if(codigoProveedor == 'Venezuela'){
                                                                codigo.value = "+58";
                                                            }else if(codigoProveedor == 'Colombia'){
                                                                codigo.value = "+57";
                                                            }else if(codigoProveedor == 'Estados Unidos'){
                                                                codigo.value = "+1";
                                                            }else if(codigoProveedor == 'Costa Rica'){
                                                                codigo.value = "+506";
                                                            }else if(codigoProveedor == 'El Salvador'){
                                                                codigo.value = "+503";
                                                            }else if(codigoProveedor == 'Guatemala'){
                                                                codigo.value = "+502";
                                                            }else if(codigoProveedor == 'Honduras'){
                                                                codigo.value = "+504";
                                                            }else if(codigoProveedor == 'México'){
                                                                codigo.value = "+52";
                                                            }else if(codigoProveedor == 'Nicaragua'){
                                                                codigo.value = "+505";
                                                            }else if(codigoProveedor == 'Panamá'){
                                                                codigo.value = "+507";
                                                            }


                                                            let cel = document.getElementById('cel_edit_{{$proveedores->id}}')

                                                            let pais = document.getElementById('pais{{$proveedores->id}}');
                                                            let ciudad = document.getElementById('ciudad_input_{{$proveedores->id}}');
                                                            let textPais = document.getElementById('text-pais_edit{{$proveedores->id}}');
                                                            let departamento = document.getElementById('departamentos{{$proveedores->id}}');
                                                            let municipio = document.getElementById('municipios{{$proveedores->id}}');

                                                            function updateVisibility() {
                                                                sessionStorage.setItem('codigo', codigo.value);

                                                                if(codigo.value == '+54') {
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');

                                                                       if(isNaN(cel.value) || cel.value.length != 10) {
                                                                        cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }

                                                                    textPais.textContent = 'Argentina';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+591') {
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');


                                                                       if(isNaN(cel.value) || cel.value.length != 8) {
                                                                        cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }

                                                                    textPais.textContent = 'Bolivia';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+55') {
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');

                                                                       if(isNaN(cel.value) || cel.value.length != 11) {
                                                                        cel.setCustomValidity("El número de celular debe tener 11 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }

                                                                    textPais.textContent = 'Brasil';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+56') {
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');

                                                                       if(isNaN(cel.value) || cel.value.length != 9) {
                                                                        cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }
                                                                    textPais.textContent = 'Chile';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+593') {
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 10) {
                                                                        cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }

                                                                    textPais.textContent = 'Ecuador';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+594') {
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 9) {
                                                                        cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }

                                                                    textPais.textContent = 'Guayana Francesa';

                                                                   departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+592') {
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 7) {
                                                                        cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }

                                                                    textPais.textContent = 'Guyana';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+595') {
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 9) {
                                                                        cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }


                                                                    textPais.textContent = 'Paraguay';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+51') {
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 9) {
                                                                        cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }


                                                                    textPais.textContent = 'Perú';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+597') {
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    ciudad.classList.remove('hide');
                                                                    pais.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 7) {
                                                                        cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }

                                                                    textPais.textContent = 'Surinam';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+598') {
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 8) {
                                                                        cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }

                                                                    textPais.textContent = 'Uruguay';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+58') {
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 10) {
                                                                        cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }
                                                                    textPais.textContent = 'Venezuela';

                                                                    // Elimina el atributo 'required'
                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+57'){
                                                                    departamento.classList.remove('hide');
                                                                    municipio.classList.remove('hide');
                                                                    pais.classList.add('hide');
                                                                    ciudad.classList.add('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 10) {
                                                                        cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }
                                                                    textPais.textContent = 'Colombia';

                                                                    // Establece los campos como obligatorios
                                                                    departamento.setAttribute('required', true);
                                                                    municipio.setAttribute('required', true);
                                                                }
                                                                else if(codigo.value == '+1'){
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 10) {
                                                                        cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }
                                                                    textPais.textContent = 'Estados Unidos';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                 else if(codigo.value == '+506'){
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 8) {
                                                                        cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }
                                                                    textPais.textContent = 'Costa Rica';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+503'){
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 8) {
                                                                        cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }
                                                                    textPais.textContent = 'El Salvador';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+502'){
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 8) {
                                                                        cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }
                                                                    textPais.textContent = 'Guatemala';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+504'){
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 8) {
                                                                        cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }

                                                                    textPais.textContent = 'Honduras';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+52'){
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 10) {
                                                                        cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }
                                                                    textPais.textContent = 'México';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+505'){
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 8) {
                                                                        cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }
                                                                    textPais.textContent = 'Nicaragua';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                                else if(codigo.value == '+507'){
                                                                    departamento.classList.add('hide');
                                                                    municipio.classList.add('hide');
                                                                    pais.classList.remove('hide');
                                                                    ciudad.classList.remove('hide');
                                                                       if(isNaN(cel.value) || cel.value.length != 8) {
                                                                        cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                                                                        } else {
                                                                            cel.setCustomValidity("");
                                                                        }
                                                                    textPais.textContent = 'Panamá';

                                                                    departamento.removeAttribute('required');
                                                                    municipio.removeAttribute('required');
                                                                }
                                                            }

                                                            codigo.addEventListener('change', updateVisibility);
                                                            cel.addEventListener('change', updateVisibility);

                                                            updateVisibility();
                                                        });
                                                    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let marcas = document.getElementById('marcas{{$proveedores->id}}');
        let container = document.getElementById('items_container{{$proveedores->id}}');
        let marcas_preferencias = document.getElementById('marcas_preferencias{{$proveedores->id}}');
        marcas_preferencias.classList.add('hide');

        // Función para agregar un botón
        function agregarBoton(item) {
            const botonesExistentes = Array.from(container.children).map(button => button.textContent);

            if (!botonesExistentes.includes(item)) {
                let button = document.createElement('button');
                button.type = 'button'; // Cambiamos el tipo de submit a button
                button.classList.add('item_selected');
                button.setAttribute('name', 'item');
                button.textContent = item;

                // Agregar un evento de escucha de clics al botón
                button.addEventListener('click', function (event) {
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
            botones.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    container.removeChild(button);

                    if (container.children.length === 0) {
                        marcas_preferencias.classList.add('hide');
                        marcas.removeAttribute('required');
                    }
                });
            });
        }

        marcas.addEventListener('change', function () {

            let item = marcas.value;
            const botonesExistentes = Array.from(container.children).map(button => button.textContent);
            if (item !== "" && !botonesExistentes.includes(item)) {
                agregarBoton(item);
                marcas_preferencias.classList.remove('hide');
            }
        });

        document.getElementById('edit_modal{{$proveedores->id}}').addEventListener('submit', function (event) {
            event.preventDefault(); // Evitar el envío del formulario para manejarlo manualmente

            // Obtener los textos de los botones en un arreglo
            let textosSeleccionados = Array.from(container.children).map(button => button.textContent);

            // Convertir el arreglo a una cadena JSON
            let jsonTextosSeleccionados = JSON.stringify(textosSeleccionados);

            // Agregar un campo oculto al formulario y asignarle la cadena JSON
            let inputJson = document.createElement('input');
            inputJson.type = 'hidden';
            inputJson.name = 'json_marcas';
            inputJson.value = jsonTextosSeleccionados;
            this.appendChild(inputJson);

            // Ahora, puedes enviar el formulario
            this.submit();
        });
    });
</script>

<script>
                                                        document.addEventListener('DOMContentLoaded', function() {

                                                            let text_rut = document.getElementById('text_file_rut{{$proveedores->id}}');
                                                            let text_cam = document.getElementById('text_file_cam{{$proveedores->id}}');

                                                            text_rut.innerHTML="{{$proveedores->rut}}";
                                                            text_cam.innerHTML="{{$proveedores->camara_comercio}}";

                                                            let rut = document.getElementById('rut{{$proveedores->id}}');
                                                            let cam = document.getElementById('cam{{$proveedores->id}}');

                                                            const btn1 = document.getElementById('btn1{{$proveedores->id}}');
                                                            const i1 = document.getElementById('check1{{$proveedores->id}}');
                                                            i1.style.display = "none";

                                                            const btn2 = document.getElementById('btn2{{$proveedores->id}}');
                                                            const i2 = document.getElementById('check2{{$proveedores->id}}');
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
                                                    // Obtener los elementos del formulario dentro de cada iteración
                                                    const departamentoSelect{{$proveedores->id}} = document.getElementById('departamento{{$proveedores->id}}');
                                                    const municipioSelect{{$proveedores->id}} = document.getElementById('municipio{{$proveedores->id}}');

                                                    // Función para cargar los municipios según el departamento seleccionado
                                                    function cargarMunicipios{{$proveedores->id}}(departamento) {
                                                        municipioSelect{{$proveedores->id}}.innerHTML = '<option value="">Seleccione un municipio</option>';
                                                        // Obtener los municipios del departamento seleccionado del objeto PHP $group
                                                        const municipios = {!! json_encode($group) !!}[departamento];
                                                        if (municipios) {
                                                            // Agregar las opciones de los municipios al campo de municipio
                                                            municipios.forEach(municipio => {
                                                                municipioSelect{{$proveedores->id}}.innerHTML += `<option value="${municipio}">${municipio}</option>`;
                                                            });
                                                        }
                                                    }

                                                    // Evento para cargar los municipios al seleccionar un departamento
                                                    departamentoSelect{{$proveedores->id}}.addEventListener('change', function () {
                                                        const selectedDepartamento = departamentoSelect{{$proveedores->id}}.value;
                                                        if (selectedDepartamento) {
                                                            cargarMunicipios{{$proveedores->id}}(selectedDepartamento);
                                                        } else {
                                                            // Si no se ha seleccionado un departamento, limpiar el campo de municipio
                                                            municipioSelect{{$proveedores->id}}.innerHTML = '<option value="">Seleccione un municipio</option>';
                                                        }

                                                        // Guardar la selección actual en localStorage cuando cambia
                                                        localStorage.setItem('selectedDepartamento{{$proveedores->id}}', selectedDepartamento);
                                                    });

                                                    // Obtener el valor anterior de 'departamento' almacenado en localStorage
                                                    const storedDepartamento{{$proveedores->id}} = localStorage.getItem('selectedDepartamento{{$proveedores->id}}');

                                                    // Verificar si hay un valor almacenado y establecerlo como la opción seleccionada
                                                    if (storedDepartamento{{$proveedores->id}}) {
                                                        departamentoSelect{{$proveedores->id}}.value = storedDepartamento{{$proveedores->id}};
                                                        cargarMunicipios{{$proveedores->id}}(storedDepartamento{{$proveedores->id}});
                                                    }
                                                </script>

                                                <script>
                                                        document.addEventListener('DOMContentLoaded', function(){
                                                           let nit = document.getElementById('nit_edit_{{$proveedores->id}}');

                                                           function nitValidity(){
                                                                   if(this.value.length != 0){
                                                                        if(this.value.length > 12 || this.value.length < 8){
                                                                            this.setCustomValidity("El nit es muy largo o muy corto");
                                                                        }
                                                                        else if(isNaN(this.value)){
                                                                            this.setCustomValidity("El nit debe contener solo números");
                                                                        }
                                                                        else{
                                                                            this.setCustomValidity("");
                                                                        }
                                                                   }else{
                                                                       this.setCustomValidity("");
                                                                   }
                                                           }

                                                           nit.addEventListener('change', nitValidity);

                                                           nitValidity();
                                                        });
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
