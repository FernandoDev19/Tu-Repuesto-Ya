@extends('layouts.baseAdmin')

@section('title', 'Tu Repuesto Ya - Perfil')

<style>
    p {
        padding: 0 !important;
        margin: 0 !important;
    }

    .image-container {
        position: relative;
        overflow: hidden;
    }

    .edit-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        display: none;
        cursor: pointer;
    }

    .image-container:hover .edit-button {
        display: block;
    }
</style>

@section('sidebar')

    @if (auth()->user()->role == 'Admin')
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Panel de control</span></a>
        </li>
    @else
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('proveedor.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Panel de control</span></a>
        </li>
    @endif

    @can('solicitudes.view')
        <!-- Divider -->
        <hr class="sidebar-divider">

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
                        <div class="container-form" style="display: flex;">
                            <form action="{{ route('profileUpdate') }}" class="form w-100">
                                @csrf
                                <div class="container-cols" style="display: flex;">
                                    <div class="col1" style="width: 50%;">
                                        <div class="row"
                                            style="display: flex; flex-direction: column; padding-left: 6%;  padding-top: 2%">
                                            <div class="titles" style="margin-bottom: 1%; padding: 0;">
                                                <div class="text">
                                                    <h4 class="text-primary">Titulo</h4>
                                                </div>
                                            </div>
                                            <div style="display: flex; justify-content: space-evenly;">
                                                <!-- Fotografía de perfil -->
                                                <div class="image-container">
                                                    <img id="img_perfil" src='{{ asset("$ft") }}'
                                                        alt="Fotografía de perfil" class="img-fluid"
                                                        style="height: 250px; border-radius: 20%;">
                                                    <label for="file-upload" class="edit-button">
                                                        <i class="fas fa-edit"></i> Editar
                                                    </label>
                                                    <input type="file" id="file-upload" style="display: none;"
                                                        accept="image/*">
                                                </div>
                                                <div class="col-md-8">
                                                    <!-- Información del perfil -->
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input class="form-control" type="email" id="email"
                                                            name="email" placeholder="{{ $usuario->email }}"
                                                            value="{{ old('email') }}" autocomplete="on"
                                                            onkeyup="cambios(this)">
                                                        @error('email')
                                                            <small class="text-danger text-xs pt-1"></small>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cel">Celular</label>
                                                        <input class="form-control" type="text" id="cel"
                                                            name="cel" placeholder="{{ $usuario->cel }}"
                                                            value="{{ old('cel') }}" autocomplete="on">
                                                        @error('cel')
                                                            <small class="text-danger text-xs pt-1"></small>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="tel">Telefono</label>
                                                        <input class="form-control" type="text" id="tel"
                                                            name="tel" placeholder="{{ $usuario->tel }}"
                                                            value="{{ old('tel') }}" autocomplete="on">
                                                        @error('tel')
                                                            <small class="text-danger text-xs pt-1"></small>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"
                                            style="display: flex; flex-direction: column; padding-left: 6%;  padding-top: 2%">
                                            <div class="titles" style="margin-bottom: 1%; padding: 0;">
                                                <div class="text">
                                                    <h4 class="text-primary">Titulo</h4>
                                                </div>
                                            </div>
                                            <div class="container">
                                                <!-- Descripción del perfil -->
                                                <h3>Descripción del Perfil</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in
                                                    justo
                                                    nec
                                                    libero malesuada cursus a vel sapien.</p>

                                                <!-- Otras secciones de información del perfil -->
                                                <h3>Otra Sección del Perfil</h3>
                                                <p>Información adicional sobre el perfil o cualquier otra cosa que desees
                                                    mostrar
                                                    aquí.
                                                </p>
                                            </div>

                                        </div>


                                    </div>
                                    <div class="col2" style="width: 50%;">

                                    </div>
                                </div>
                                <div id="boton-container">
                                    <button id="btn1" type="submit" class="btn btn-primary my-4 mb-2"
                                        style="display: none;">Enviar</button>
                                    <span id="btn2" class="btn btn-secondary my-4 mb-2" style="display: none;"
                                        onclick="restaurarValores()">Cancelar</span>
                                </div>
                            </form>
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

<script>
    const imageContainer = document.querySelector(".image-container");
    const editButton = document.querySelector(".edit-button");

    imageContainer.addEventListener("mouseenter", () => {
        editButton.style.display = "block";
    });

    imageContainer.addEventListener("mouseleave", () => {
        editButton.style.display = "none";
    });

    function cambios(input) {
        const campo1 = document.querySelector('#img_perfil');
        const campo2 = document.querySelector('#email');

        let emailUser = '<?php echo $usuario->email; ?>';

        if (campo2 !== emailUser) {
            $('#btn1').show();
            $('#btn2').show();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        let imgPerfil = document.getElementById("img_perfil");
        let urlImagenOriginal = imgPerfil.getAttribute("data-original-src");
    })

    function restaurarValores() {
        imgPerfil.src = urlImagenOriginal;

        document.getElementById("email").value = valoresOriginales.campo2;

        document.getElementById("btn1").style.display = "none";
        document.getElementById("btn2").style.display = "none";
    }
</script>
