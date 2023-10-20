@extends('layouts.baseAdmin')

@section('title', 'Tu Repuesto Ya - Proveedores')

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
                <span>Components</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item" href="{{ route('viewSolicitudes') }}">Solicitudes</a>
                    @can('answers.view')
                        <a class="collapse-item" href="{{ route('viewRespuestas') }}">Respuestas</a>
                    @endcan
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

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="container-fluid h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between;">
                                <div class="p-3">
                                    <h2 class="header-title font-weight-bold text-primary">Lista de proveedores</h2>
                                    <form class="form-inline">
                                        <div class="form-group mb-2">
                                            <label for="ordenarPor" class="mr-2">Ordenar por:</label>
                                            <select name="ordenarPor" id="ordenarPor" class="form-control"
                                                onchange="ordenarTabla(this.value)">
                                                <option value="razon_social">Seleccionar</option>
                                                <option value="nit_empresa">NIT</option>
                                                <option value="razon_social">Razón Social</option>
                                                <option value="celular">Celular</option>
                                                <option value="departamento">Departamento</option>
                                                <option value="municipio">Municipio</option>
                                                <option value="estado">Estado</option>
                                            </select>
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="proveedoresTable">
                                    <thead>
                                        <tr>
                                            <th class="text-primary" style="padding:5px 0; text-align:center;">NIT
                                            </th>
                                            <th class="text-primary" style="padding:5px 0; text-align:center;">Razón
                                                Social</th>
                                            <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                Celular</th>
                                            <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                Departamento</th>
                                            <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                Municipio</th>
                                            <th class="text-primary" style="padding:5px 0; text-align:center;">RUT
                                            </th>
                                            <th class="text-primary" style="padding:5px 0; text-align:center;">C.
                                                Comercio</th>
                                            <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($proveedor->isEmpty())
                                            <tr>
                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                    No hay registros
                                                </td>
                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                    No hay registros
                                                </td>
                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                    No hay registros
                                                </td>
                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                    No hay registros
                                                </td>
                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                    No hay registros
                                                </td>
                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                    No hay registros
                                                </td>
                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                    No hay registros
                                                </td>
                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                    No hay registros
                                                </td>
                                                <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                    No hay registros
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($proveedor as $proveedores)
                                                <tr>
                                                    <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                        data-campo="nit_empresa"
                                                        data-valor="{{ $proveedores->nit_empresa }}">
                                                        <span style="font-size: 14;"
                                                            id="nit_empresa_{{ $proveedores->id }}">{{ $proveedores->nit_empresa }}</span>
                                                    </td>
                                                    <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                        data-campo="razon_social"
                                                        data-valor="{{ $proveedores->razon_social }}">
                                                        <span style="font-size: 14;"
                                                            id="razon_social_{{ $proveedores->id }}">{{ $proveedores->razon_social }}</span>
                                                        <input type="text"
                                                            id="razon_social_input_{{ $proveedores->id }}"
                                                            class="form-control d-none"
                                                            value="{{ $proveedores->razon_social }}">
                                                    </td>
                                                    <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                        data-campo="celular" data-valor="{{ $proveedores->celular }}">
                                                        <span style="font-size: 14;"
                                                            id="celular_{{ $proveedores->id }}">+{{ $proveedores->celular }}</span>
                                                        <input type="text" id="celular_input_{{ $proveedores->id }}"
                                                            class="form-control d-none"
                                                            value="{{ $proveedores->celular }}">
                                                    </td>
                                                    <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                        data-campo="departamento"
                                                        data-valor="{{ $proveedores->departamento }}">
                                                        <span style="font-size: 14;"
                                                            id="departamento_{{ $proveedores->id }}">{{ $proveedores->departamento }}</span>
                                                        <input type="text"
                                                            id="departamento_input_{{ $proveedores->id }}"
                                                            class="form-control d-none"
                                                            value="{{ $proveedores->departamento }}">
                                                    </td>
                                                    <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                        data-campo="municipio"
                                                        data-valor="{{ $proveedores->municipio }}">
                                                        <span style="font-size: 14;"
                                                            id="municipio_{{ $proveedores->id }}">{{ $proveedores->municipio }}</span>
                                                        <input type="text" id="municipio_input_{{ $proveedores->id }}"
                                                            class="form-control d-none"
                                                            value="{{ $proveedores->municipio }}">
                                                    </td>
                                                    <td
                                                        style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                        <a title="Ver RUT" rel="noopener noreferrer"
                                                            style="font-size: 14; color: #858796; text-decoration: underline;"
                                                            href="{{ route('mostrarArchivo', ['filename' => 'RUT_' . $proveedores->nit_empresa . '.pdf']) }}"
                                                            target="_blank">RUT</a>
                                                    </td>
                                                    <td
                                                        style="padding:5px 10px; margin:0; text-align:center; line-height: 1; font-size: 14;">
                                                        <a title="Ver camara de comercio"
                                                            style="color: #858796; text-decoration: underline;"
                                                            rel="noopener noreferrer"
                                                            href="{{ route('mostrarArchivo', 'Camara_de_comercio_' . $proveedores->nit_empresa . '.pdf') }}"
                                                            target="_blank">C. Comercio</a>
                                                    </td>
                                                    <td style="padding:0 10px; margin:0; text-align:center;"
                                                        data-campo="estado"
                                                        data-valor="{{ $proveedores->estado ? 'Activo' : 'Inactivo' }}">
                                                        {{ $proveedores->estado ? 'Activo' : 'Inactivo' }}
                                                    </td>
                                                    <td style="padding:0px; width: 6vw;" class="text-center">
                                                        <a title="Ver detalles" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#infoModal{{ $proveedores->id }}"
                                                            style="font-size: 12; padding: 5%;">
                                                            <i class="fas fa-info-circle"></i>
                                                            detalles</a>
                                                    </td>

                                                    <!-- Modal de Información -->
                                                    <div class="modal fade" id="infoModal{{ $proveedores->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="infoModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="infoModalLabel">
                                                                        Información
                                                                        del Proveedor</h5>
                                                                    <button class="close" type="button"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body d-flex justify-content-between">
                                                                    <div class="text-wrap">
                                                                        <strong>NIT:</strong>
                                                                        {{ $proveedores->nit_empresa }}<br>
                                                                        <strong>Razón Social:</strong>
                                                                        {{ $proveedores->razon_social }}<br>
                                                                        <strong>Departamento:</strong>
                                                                        {{ $proveedores->departamento }}<br>
                                                                        <strong>Municipio:</strong>
                                                                        {{ $proveedores->municipio }}
                                                                        <br>
                                                                        <strong>Direccion:</strong>
                                                                        {{ $proveedores->direccion }}
                                                                        <br>
                                                                        <strong>Celular:</strong>
                                                                        {{ substr($proveedores->celular, 2) }}
                                                                        <br>
                                                                        <strong>Telefono:</strong>
                                                                        {{ $proveedores->telefono }}
                                                                        <br>
                                                                        <strong>Email:</strong>
                                                                        {{ $proveedores->email }} <br>
                                                                        <strong>RUT:</strong>
                                                                        {{ $proveedores->rut }} <br>
                                                                        <strong>Camara de
                                                                            comercio:</strong>
                                                                        {{ $proveedores->camara_comercio }}
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

                                                    {{-- Modal de edición --}}
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
                                                                    <form action="{{ route('editarProveedor') }}"
                                                                        method="POST">
                                                                        @csrf

                                                                        <input type="hidden" name="id"
                                                                            value="{{ $proveedores->id }}">

                                                                        <div class="form-group">
                                                                            <label for="razon_social_edit">Razón
                                                                                Social:</label>
                                                                            <input class="form-control" type="text"
                                                                                id="razon_social_edit"
                                                                                name="razon_social_edit"
                                                                                placeholder="{{ $proveedores->razon_social }}"
                                                                                value="{{ old('razon_social_edit') }}"
                                                                                autocomplete="on">
                                                                            @error('razon_social_edit')
                                                                                <small
                                                                                    class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="departamento">Departamento:</label>
                                                                            <select id="departamento{{$proveedores->id}}"
                                                                                name="departamento_edit"
                                                                                class="departamento form-control">
                                                                                <option value="">
                                                                                    Seleccione un
                                                                                    departamento
                                                                                </option>
                                                                                @foreach ($departamentos as $departamento)
                                                                                    <option value="{{ $departamento }}">
                                                                                        {{ $departamento }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="municipio">Municipio:</label>
                                                                            <select id="municipio{{$proveedores->id}}" name="municipio_edit"
                                                                                class="municipio form-control">
                                                                                <option value="">
                                                                                    Seleccione un
                                                                                    municipio</option>

                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="direccion">Dirección:</label>
                                                                            <input type="text" class="form-control"
                                                                                id="direccion" name="direccion_edit"
                                                                                placeholder="{{ $proveedores->direccion }}"
                                                                                value="{{ old('direccion_edit') }}"
                                                                                autocomplete="on">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="cel">Número
                                                                                de celular:</label>
                                                                            <input type="text" class="form-control"
                                                                                id="cel" name="cel_edit"
                                                                                placeholder="{{ substr($proveedores->celular, 2) }}"
                                                                                value="{{ old('cel_edit') }}"
                                                                                autocomplete="on">
                                                                            @error('cel_edit')
                                                                                <small
                                                                                    class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="tel">Número
                                                                                de telefono:</label>
                                                                            <input type="text" class="form-control"
                                                                                id="tel" name="tel_edit"
                                                                                placeholder="{{ substr($proveedores->telefono, 2) }}"
                                                                                value="{{ old('tel_edit') }}"
                                                                                autocomplete="on">
                                                                            @error('tel_edit')
                                                                                <small
                                                                                    class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="email">Correo
                                                                                electrónico:</label>
                                                                            <input type="email" class="form-control"
                                                                                id="email" name="email_edit"
                                                                                placeholder="{{ $proveedores->email }}"
                                                                                value="{{ old('email_edit') }}"
                                                                                autocomplete="on">
                                                                            @error('email_edit')
                                                                                <small
                                                                                    class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="estado">Estado:</label>
                                                                            <select class="form-control" id="estado"
                                                                                name="estado_edit">
                                                                                <option value="">
                                                                                    Seleccione el estado
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
                                                    departamentoSelect{{$proveedores->id}}.addEventListener('change', function() {
                                                        const selectedDepartamento = departamentoSelect{{$proveedores->id}}.value;
                                                        if (selectedDepartamento) {
                                                            cargarMunicipios{{$proveedores->id}}(selectedDepartamento);
                                                        } else {
                                                            // Si no se ha seleccionado un departamento, limpiar el campo de municipio
                                                            municipioSelect{{$proveedores->id}}.innerHTML = '<option value="">Seleccione un municipio</option>';
                                                        }
                                                    });
                                                </script>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                                <!-- Botones de paginación -->
                                <div class="text-center" style="display: flex; justify-content: flex-end;">
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

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    function ordenarTabla(campo) {
        var table = document.getElementById("proveedoresTable");
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

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

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
