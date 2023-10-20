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
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="{{ route('viewSolicitudes') }}">Solicitudes</a>
                <a class="collapse-item active" href="{{ 'viewRespuestas' }}">Respuestas</a>
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
                                    <h1 class="font-weight-bold text-primary">Lista de Respuestas</h1>
                                    <form class="form-inline">
                                        <div class="form-group mb-2">
                                            <label for="ordenarPor" class="mr-2">Ordenar por:</label>
                                            <select name="ordenarPor" id="ordenarPor" class="form-control"
                                                onchange="ordenarTabla(this.value)">
                                                <option value="">Seleccionar</option>
                                                <option value="id">Id</option>
                                                <option value="idSolicitud">Solicitud</option>
                                                <option value="razon_social">Proveedor</option>
                                                <option value="repuesto">Repuesto</option>
                                                <option value="tipo_repuesto">Tipo de repuesto</option>
                                                <option value="precio">Precio</option>
                                                <option value="garantia">Garantía</option>
                                                <option value="created_at">Fecha de creación</option>
                                            </select>
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
                        <div class="card-body">
                            <div class="card shadow mb-4 contenedor-lista">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="respuestasTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">Id
                                                    </th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Nº solicitud
                                                    </th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Proveedor</th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Repuesto</th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Tipo de repuesto</th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Precio</th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Garantía</th>
                                                    <th class="text-primary" style="padding:5px 0; text-align:center;">
                                                        Fecha de creación</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($respuestas->isEmpty())
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
                                                        <td
                                                            style="padding:5px 10px; margin:0; text-align:center; line-height: 1;">
                                                            No hay registros
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($respuestas as $respuesta)
                                                        <tr>
                                                            <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                data-campo="id" data-valor="{{ $respuesta->id }}">
                                                                <span style="font-size: 14;"
                                                                    id="id_{{ $respuesta->id }}">{{ $respuesta->id }}</span>
                                                            </td>
                                                            <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                data-campo="idSolicitud"
                                                                data-valor="{{ $respuesta->idSolicitud }}">
                                                                <a title="Ver detalles de solicitud" data-toggle="modal"
                                                                    data-target="#solicitudModal{{ $respuesta->id }}"
                                                                    style="font-size: 14; color: #858796; text-decoration: underline; cursor: pointer;"
                                                                    id="idSolicitud_{{ $respuesta->idSolicitud }}">{{ $respuesta->idSolicitud }}</a>
                                                            </td>

                                                            <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                data-campo="razon_social"
                                                                data-valor="{{ $respuesta->proveedor->razon_social }}">
                                                                <a title="Ver detalles del proveedor" data-toggle="modal"
                                                                    data-target="#providerModal{{ $respuesta->id }}"
                                                                    style="font-size: 14; color: #858796; text-decoration: underline; cursor: pointer;"
                                                                    id="razon_social_{{ $respuesta->proveedor->razon_social }}">{{ $respuesta->proveedor->razon_social }}</a>
                                                            </td>

                                                            <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                data-campo="repuesto"
                                                                data-valor="{{ $respuesta->repuesto }}">
                                                                <span style="font-size: 14;"
                                                                    id="repuesto_{{ $respuesta->repuesto }}">{{ $respuesta->repuesto }}</span>
                                                            </td>

                                                            <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                data-campo="tipo_repuesto"
                                                                data-valor="{{ $respuesta->tipo_repuesto }}">
                                                                <span style="font-size: 14;"
                                                                    id="tipo_repuesto_{{ $respuesta->tipo_repuesto }}">{{ $respuesta->tipo_repuesto }}</span>
                                                            </td>

                                                            <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                data-campo="precio"
                                                                data-valor="{{ $respuesta->precio }}">
                                                                <span style="font-size: 14;"
                                                                    id="precio_{{ $respuesta->precio }}">{{ $respuesta->precio }}</span>
                                                            </td>

                                                            <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                data-campo="garantia"
                                                                data-valor="{{ $respuesta->garantia }}">
                                                                <span style="font-size: 14;"
                                                                    id="garantia_{{ $respuesta->garantia }}">{{ $respuesta->garantia }}</span>
                                                            </td>

                                                            <td style="padding:5px 10px; margin:0; text-align:center; line-height: 1;"
                                                                data-campo="created_at"
                                                                data-valor="{{ $respuesta->created_at }}">
                                                                <span style="font-size: 14;"
                                                                    id="created_at_{{ $respuesta->created_at }}">{{ $respuesta->created_at->diffForHumans() }}</span>
                                                            </td>

                                                            <td style="padding:0px; width: 6vw;" class="text-center">
                                                                <a title="Ver detalles" class="btn btn-primary"
                                                                    data-toggle="modal"
                                                                    data-target="#infoModal{{ $respuesta->id }}"
                                                                    style="font-size: 12; padding: 5%;">
                                                                    <i class="fas fa-info-circle"></i>
                                                                    detalles</a>
                                                            </td>

                                                            <!-- Modal de Información -->
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
                                                                            <div class="text-wrap">
                                                                                <strong>ID:</strong>
                                                                                {{ $respuesta->id }}<br>

                                                                                <strong>Nº de solicitud:</strong>
                                                                                <a class="text-primary"
                                                                                    title="Ver detalles de solicitud"
                                                                                    data-toggle="modal"
                                                                                    data-target="#solicitudModal{{ $respuesta->id }}"
                                                                                    style="font-size: 14; cursor: pointer;">{{ $respuesta->idSolicitud }}</a><br>

                                                                                <strong>Proveedor:</strong>
                                                                                <a class="text-primary"
                                                                                    title="Ver detalles del proveedor"
                                                                                    data-toggle="modal"
                                                                                    data-target="#providerModal{{ $respuesta->id }}"
                                                                                    style="font-size: 14; cursor: pointer;">{{ $respuesta->proveedor->razon_social }}</a><br>

                                                                                <strong>Repuesto:</strong>
                                                                                {{ $respuesta->repuesto }}<br>

                                                                                <strong>Tipo de repuesto:</strong>
                                                                                {{ $respuesta->tipo_repuesto }}<br>

                                                                                <strong>Precio:</strong>
                                                                                {{ $respuesta->precio }}<br>

                                                                                <strong>Garantía:</strong>
                                                                                {{ $respuesta->garantia }}<br>

                                                                                <strong>Comentarios del proveedor:</strong>
                                                                                {{ $respuesta->comentarios }}<br>

                                                                                <strong>Fecha de creación:</strong>
                                                                                {{ $respuesta->created_at }}
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
                                                                            <div class="text-wrap">
                                                                                <strong>NIT:</strong>
                                                                                {{ $respuesta->proveedor->nit_empresa }}<br>
                                                                                <strong>Razón Social:</strong>
                                                                                {{ $respuesta->proveedor->razon_social }}<br>
                                                                                <strong>Departamento:</strong>
                                                                                {{ $respuesta->proveedor->departamento }}<br>
                                                                                <strong>Municipio:</strong>
                                                                                {{ $respuesta->proveedor->municipio }}
                                                                                <br>
                                                                                <strong>Direccion:</strong>
                                                                                {{ $respuesta->proveedor->direccion }}
                                                                                <br>
                                                                                <strong>Celular:</strong>
                                                                                {{ substr($respuesta->proveedor->celular, 2) }}
                                                                                <br>
                                                                                <strong>Telefono:</strong>
                                                                                {{ $respuesta->proveedor->telefono }}
                                                                                <br>
                                                                                <strong>Email:</strong>
                                                                                {{ $respuesta->proveedor->email }} <br>
                                                                                <strong>RUT:</strong>
                                                                                <a target="_blank" title="Ver RUT" rel="noopener noreferrer"
                                                                                    href="{{ route('mostrarArchivo', $respuesta->proveedor->rut) }}">Ver</a><br>
                                                                                <strong>Camara de
                                                                                    comercio:</strong>
                                                                                <a target="_blank" rel="noopener noreferrer"
                                                                                    title="Ver Camara de comercio"
                                                                                    href="{{ route('mostrarArchivo', $respuesta->proveedor->camara_comercio) }}">Ver</a>
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
                                                                role="dialog" aria-labelledby="solicitudModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="solicitudModalLabel">
                                                                                Información
                                                                                de la solicitud</h5>
                                                                            <button class="close" type="button"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>

                                                                        <div
                                                                            class="modal-body d-flex justify-content-between">
                                                                            <div class="text-wrap">
                                                                                <strong>ID:</strong>
                                                                                {{ $respuesta->solicitud->id }}<br>
                                                                                <strong>Respuestas:</strong>
                                                                                {{ $respuesta->solicitud->respuestas }}<br>
                                                                                <strong>Marca:</strong>
                                                                                {{ $respuesta->solicitud->marca }}<br>
                                                                                <strong>Referencia:</strong>
                                                                                {{ $respuesta->solicitud->referencia }}
                                                                                <br>
                                                                                <strong>Modelo:</strong>
                                                                                {{ $respuesta->solicitud->modelo }}
                                                                                <br>
                                                                                <strong>Transmisión:</strong>
                                                                                {{ $respuesta->solicitud->tipo_de_transmision }}
                                                                                <br>
                                                                                <strong>Repuesto:</strong>
                                                                                {{ $respuesta->solicitud->repuesto }}
                                                                                <br>
                                                                                <strong>Imagen del repuesto:</strong>
                                                                                @if ($respuesta->solicitud->img_repuesto == 'No se subió ningun archivo')
                                                                                    No hay imagen
                                                                                @elseif ($respuesta->solicitud->img_repuesto)
                                                                                    <a title="Ver imagen del repuesto"
                                                                                        data-toggle="modal"
                                                                                        data-target="#imgModal{{ $respuesta->id }}"
                                                                                        href="#"><i
                                                                                            class="fas fa-image"
                                                                                            style="font-size: 18px;"></i></a>
                                                                                @else
                                                                                    No
                                                                                @endif
                                                                                <br>
                                                                                <strong>Comentario:</strong>
                                                                                @if ($respuesta->solicitud->comentario)
                                                                                    {{ $respuesta->solicitud->comentario }}
                                                                                @else
                                                                                    No hay comentarios
                                                                                @endif
                                                                                <br>
                                                                                <strong>Nombre:</strong>
                                                                                {{ $respuesta->solicitud->nombre }} <br>
                                                                                <strong>Correo electronico:</strong>
                                                                                {{ $respuesta->solicitud->correo }} <br>
                                                                                <strong>Celular:</strong>
                                                                                {{ $respuesta->solicitud->numero }} <br>
                                                                                <strong>Departamento:</strong>
                                                                                {{ $respuesta->solicitud->departamento }}
                                                                                <br>
                                                                                <strong>Municipio:</strong>
                                                                                {{ $respuesta->solicitud->municipio }} <br>
                                                                                <strong>Estado de solicitud:</strong>
                                                                                @if ($respuesta->solicitud->estado)
                                                                                    Activa
                                                                                @else
                                                                                    Inactiva
                                                                                @endif
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

                                                            <!-- Modal de Información de imagen -->
                                                            <div style="min-height: 100vh; min-width: 100vw;"
                                                                class="modal fade" id="imgModal{{$respuesta->id}}" tabindex="-1"
                                                                role="dialog" aria-labelledby="imgModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document"
                                                                    style="max-width: 1000px !important;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="imgModalLabel">
                                                                                Imagen del repuesto</h5>
                                                                            <button class="close" type="button"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>

                                                                        <div
                                                                            class="modal-body d-flex justify-content-center">
                                                                            <div class="text-wrap">
                                                                                <div
                                                                                    style="display: flex; justify-content: center; box-sizing: border-box">
                                                                                    <img src="{{ asset("storage/".$respuesta->solicitud->img_repuesto) }}"
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

                                                        </tr>
                                                    @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                        <!-- Botones de paginación -->
                                        <div class="text-center" style="display: flex; justify-content: flex-end;">
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
        var table = document.getElementById("respuestasTable");
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
