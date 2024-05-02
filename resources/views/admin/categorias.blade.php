@extends('layouts.baseAdmin')

@section('title', 'Proveedores | Tu Repuesto Ya')
<link rel="stylesheet" href="{{ asset('css/keywordsStyles.css') }}">

<!-- Sidebar -->
@section('sidebar')
    <div id="overlay" class="overlay" style="display:flex; flex-direction:column;">
        <div class="loader"></div>
        <div style="margin-top: 10px; color: white; font-size:15px;"><small>Cargando...</small></div>
    </div>
    <nav class="navbar navbar-expand navbar-light bg-white shadow topbar static-top d-flex justify-content-center">

        <!-- Topbar Navbar -->
        <ul id="lista-nav-items" class="navbar-nav" style="font-size: 1.3rem;">

            <li class="nav-item">
                <a class="nav-link" style="color: var(--gray); padding: 0 .50rem; gap: 3px;" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt icon-sidebar"> </i>
                    <span class="nav-items-cel-small"> Panel</span></a>
            </li>

            @can('providers.loadProviders')
                <li class="nav-item">
                    <a href="{{ route('loadProviders') }}" class="nav-link"
                        style="color: var(--gray); padding: 0 .50rem; gap: 3px;"><i class="fas fa-users icon-sidebar"> </i><span
                            class="nav-items-cel-small">Proveedores</span> </a>
                </li>
            @endcan

            @can('solicitudes.view')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('viewSolicitudes') }}"
                        style="color: var(--gray); padding: 0 .50rem; gap: 3px;"><i class="fas fa-file-alt icon-sidebar"> </i> <span
                            class="nav-items-cel-small">Solicitudes</span></a>
                </li>
            @endcan

            @can('answers.view')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('viewRespuestas') }}"
                        style="color: var(--gray); padding: 0 .50rem; gap: 3px;"><i class="fas fa-reply icon-sidebar"> </i><span
                            class="nav-items-cel-small">Respuestas</span> </a>
                </li>
            @endcan

        </ul>
    </nav>
@endsection
@section('content')

    {{-- Contenido principal --}}
    <div class="container-fluid h-100">
        <div class="row h-100 justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between;">
                            <div class="p-3">
                                <h2 class="header-title font-weight-bold text-primary">Categorias</h2>
                                {{-- <div class="form-group mb-2">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="search" name="search" wire:model.live="search"
                                                placeholder="Buscar...">
                                        </div>
                                    </div> --}}
                            </div>
                            <div style="display: flex; align-items: center;">
                                <div class="align-items-center justify-content-between mb-4"
                                    style="flex-direction: column; gap: .5rem;">
                                    <button class="btn btn-primary" id="btn-crear-keyword" data-toggle="modal"
                                        data-target="#createModal">
                                        Crear
                                    </button>
                                    <a title="Descargar lista de categorias y sus repuestos" href="{{route('categorias.excel')}}"
                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                        <i class="fas fa-download fa-sm text-white-50"></i> Descargar
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body" style="padding: 0;">
                        <div class="container-categories">
                            @foreach ($category as $categoria)
                                <a id="btn_categoria{{$categoria->id}}"  href="/categorias/{{ $categoria->nombre_categoria }}/{{ $categoria->id }}">
                                    <button type="button" class="btn btn-primary" style="padding: 0;">
                                        <div class="p-3">
                                            <h5 style="margin: 0;">{{ $categoria->nombre_categoria }}</h5>
                                        </div>
                                    </button>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal create -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">
                        Crear palabra clave</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body d-flex justify-content-between">
                    <div style="height: 100%; width: 100%; padding: 1rem;">
                        <form action="{{ route('saveCategory') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="category" class="text-primary">Nombre para Categoria:</label>
                                <input type="text" id="category" name="category" class="form-control" autofocus required>
                                <span class="text-xs mb-1 mt-1 text-danger" id="categoryError"></span>
                                <div style="width: 100%; display:flex; justify-content: flex-end;">
                                    <button class="btn btn-primary" type="submit">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
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

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{asset('js/ctxmenu.min/ctxmenu.min.js')}}"></script>

    <script>
        // Create the context menu instance
        const contextMenu = CtxMenu();

        // Add an item to the menu
        contextMenu.addItem("Recargar", function () {
            location.reload();
        });
    </script>

    <script>
        const overlay = document.getElementById('overlay');

        hideLoadingOverlay();

        document.addEventListener('submit', function() {
            showLoadingOverlay();
        });

        function showLoadingOverlay() {
            overlay.style.display = 'flex'; // Mostrar superposición
        }

        function hideLoadingOverlay() {
            overlay.style.display = 'none'; // Ocultar superposición
        }
    </script>

    @foreach ($category as $categoria2)

        <script>
            const boton{{$categoria2->id}} = document.getElementById('btn_categoria{{$categoria2->id}}');
            let tieneEliminar{{$categoria2->id}} = false;

            boton{{$categoria2->id}}.addEventListener('contextmenu', function (event) {
                event.preventDefault(); // Prevent default context menu

                const contextMenu{{$categoria2->id}} = CtxMenu(this);

                if (!tieneEliminar{{$categoria2->id}}) {
                    contextMenu{{$categoria2->id}}.addItem("Eliminar {{$categoria2->nombre_categoria}}", function () {
                        let overlay = document.getElementById('overlay').style.display = 'flex';

                        fetch('http://localhost:8000/categorias/{{ $categoria2->nombre_categoria }}/{{ $categoria2->id }}/eliminar', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Agrega el token CSRF para la protección de Laravel
                        },
                        })
                        .then(respuesta => {
                            if (respuesta.ok) {
                                location.reload();
                            } else {
                                location.reload();
                            }
                        })
                        .catch(error => {
                            // Maneja errores de red u otros errores
                            console.error('Error inesperado:', error);
                        });
                    });
                    tieneEliminar{{$categoria2->id}} = true;
                }
                // Show the context menu at the click position
                contextMenu{{$categoria2->id}}.show(event.clientX, event.clientY);
            });
        </script>
    @endforeach

@endsection
