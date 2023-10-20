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

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="container-fluid h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                                <div>
                                    <h1 class="font-weight-bold text-primary">Nuevo proveedor registrado</h1>
                                </div> 
                        </div>
                        <div class="card-body">
                            <div class="card shadow mb-4 contenedor-lista">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="proveedoresTable">
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
                                                        <a title="Ver RUT"
                                                            style="font-size: 14; color: #858796; text-decoration: underline;"
                                                            href="{{ route('mostrarArchivo', ['filename' => 'RUT_' . $proveedores->nit_empresa . '.pdf']) }}"
                                                            target="_blank" rel="noopener noreferrer">RUT</a>
                                                    </td>
                                                    <td
                                                        style="padding:5px 10px; margin:0; text-align:center; line-height: 1; font-size: 14;">
                                                        <a title="Ver camara de comercio"
                                                            style="color: #858796; text-decoration: underline;"
                                                            href="{{ route('mostrarArchivo', 'Camara_de_comercio_' . $proveedores->nit_empresa . '.pdf') }}"
                                                            target="_blank" rel="noopener noreferrer">C. Comercio</a>
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
                                                    <div class="modal fade" id="editModal{{ $proveedores->id }}"
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
                                                                            <label
                                                                                for="departamento_edit">Departamento:</label>
                                                                            <select id="departamento"
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
                                                                            <label for="municipio_edit">Municipio:</label>
                                                                            <select id="municipio" name="municipio_edit"
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

                                            </tbody>
                                        </table>
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

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
    // Obtener los elementos del formulario
    const departamentoSelect = document.getElementById('departamento');
    const municipioSelect = document.getElementById('municipio');

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
        const selectedDepartamento = departamentoSelect.value;
        if (selectedDepartamento) {
            cargarMunicipios(selectedDepartamento);
        } else {
            municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
        }
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
