<!DOCTYPE html>
<html lang="es">

<head>
    @include('includes.head')
</head>

<body style="display: flex; align-items: center;">
    @include('components.alert')

    <nav id="nav" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid" style="max-width: 2080px;">
            <a title="Inicio" class="navbar-brand" href="{{ asset(route('servicios')) }}"><img decoding="async"
                    id="logo" src="{{ asset('img/logo-tu-repuesto.webp') }}" alt="Logo TuRepuestoYa"></a>
            <button class="navbar-toggler btn" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon ico-btn" style="width: 1.3rem;"></span>
            </button>
            <div class="collapse navbar-collapse container-op navbar-pc" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto flex-end-cel" style="box-sizing: border-box; font-size: 100%; gap: 1.5rem;">

                    <li class="nav-item">
                        <div class="container_nav" id="Cnav1">
                            <a class="nav-link nav_e1" href="{{ route('vistaFormulario') }}" aria-current="page" style="font-weight: bold !important;">Cotizar</a>
                            {{-- <div
                                        class="animate__animated animate__fadeInUp animate__delay-0s animate__faster nav_active">
                                    </div> --}}
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="container_nav" id="Cnav2">
                            <a class="nav-link nav_e1" href="#solicitud-de-repuestos" style="font-weight: bold !important;">¿Cómo
                                funciona?</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="container_nav" id="Cnav3">
                            <a class="nav-link nav_e1" href="#contacto" style="font-weight: bold !important;">Contacto</a>
                        </div>
                    </li>

                    @guest
                        <li id="container_user" class="nav-item dropdown no-arrow">
                            <div class="container_nav container_flex container_flex_user">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white; font-weight: bold !important;">
                                    <span class="nav_e1" class="mr-2 d-none d-lg-inline text-gray-600 small">¿Eres
                                        proveedor?</span>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu end-0 dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <span class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></span>
                                        Iniciar sesión
                                    </a>
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <span class="fas fa-user-plus fa-sm fa-fw mr-2 text-gray-400"></span>
                                        Registrarse
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">
                                        <span class="fas fa-info-circle fa-sm fa-fw mr-2 text-gray-400"></span>
                                        Saber cómo funciona
                                    </a>
                                </div>
                            </div>
                        </li>
                    @else
                        <li id="container_user" class="nav-item dropdown no-arrow">
                            <div class="container_nav container_flex container_flex_user">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white; font-weight: bold !important;">
                                    <i class="fas fa-user"></i>
                                    <span class="nav_e1"
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $name }}</span>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu end-0 dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Panel
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Perfil
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Configuraciones
                                    </a>
                                    <a class="dropdown-item" href="{{route('activityLog')}}">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Registro de actividades
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Cerrar sesión
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="collapse navbar-collapse container-op navbar-celular" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto flex-end-cel" style="box-sizing: border-box; font-size: 100%; gap: 1.5rem;">

            <li class="nav-item">
                <div class="container_nav" id="Cnav1">
                    <a class="nav-link nav_e1" href="{{ route('vistaFormulario') }}" aria-current="page" style="color: white !important;">Cotizar</a>
                    {{-- <div
                                class="animate__animated animate__fadeInUp animate__delay-0s animate__faster nav_active">
                            </div> --}}
                </div>
            </li>

            <li class="nav-item">
                <div class="container_nav" id="Cnav2">
                    <a class="nav-link nav_e1" href="#solicitud-de-repuestos" style="color: white !important;">¿Cómo
                        funciona?</a>
                </div>
            </li>

            <li class="nav-item">
                <div class="container_nav" id="Cnav3">
                    <a class="nav-link nav_e1" href="#contacto" style="color: white !important;">Contacto</a>
                </div>
            </li>

            @guest
                <li id="container_user" class="nav-item dropdown no-arrow" style="border-top: 1px solid; width: 100%;">
                    <div class="container_nav container_flex container_flex_user">
                        <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav2Dropdown" aria-controls="navbarNav2Dropdown" aria-expanded="false"
                        aria-label="Toggle navigation" style="color: var(--color-primary) !important;">
                            <span class="nav_e1" class="mr-2 d-none d-lg-inline text-gray-600 small"  style="color: var(--color-primary) !important;">¿Eres
                                proveedor?</span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="collapse navbar-collapse" style="color: white;"
                            aria-labelledby="userDropdown" id="navbarNav2Dropdown">
                            <a class="dropdown-item" href="{{ route('login') }}">
                                <span class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></span>
                                Iniciar sesión
                            </a>
                            <a class="dropdown-item" href="{{ route('register') }}">
                                <span class="fas fa-user-plus fa-sm fa-fw mr-2 text-gray-400"></span>
                                Registrarse
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <span class="fas fa-info-circle fa-sm fa-fw mr-2 text-gray-400"></span>
                                Saber cómo funciona
                            </a>
                        </div>
                    </div>
                </li>
            @else
                <li id="container_user" class="nav-item dropdown no-arrow" style="border-top: 1px solid; width: 100%">
                    <div class="container_nav container_flex container_flex_user">
                        <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav2Dropdown" aria-controls="navbarNav2Dropdown" aria-expanded="false"
                        aria-label="Toggle navigation" style="color: var(--color-primary) !important;">
                            <i class="fas fa-user"></i>
                            <span class="nav_e1"
                                class="mr-2 d-none d-lg-inline text-gray-600 small" style="color: var(--color-primary) !important;">{{ $name }}</span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="collapse navbar-collapse" style="color: white;"
                            aria-labelledby="userDropdown" id="navbarNav2Dropdown">
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                Panel
                            </a>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Perfil
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Configuraciones
                            </a>
                            <a class="dropdown-item" href="{{route('activityLog')}}">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Registro de actividades
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Cerrar sesión
                            </a>
                        </div>
                    </div>
                </li>
            @endguest
        </ul>
    </div>

    <div class="container-body">
        @yield('content')

        <div class="container-footer">
            <div class="footer w-100" style="background-color: white;">
                <div class="container-flex container-flex-col-cel">
                    <div class="container-items">
                        <a class="item" href="#">Términos y Condiciones</a>
                        <span class="item none">|</span>
                        <a class="item" href="{{ route('privacy-policy') }}">Política de privacidad</a>
                        <span class="item none">|</span>
                        <a class="item" href="#">Acerca de...</a>
                    </div>
                    <div class="container-icons-footer" id="contacto">
                        <a target="_blank" aria-label="Enviar mensaje por whatsapp a Tu Repuesto Ya"
                            href="https://api.whatsapp.com/send?phone=573249216736&text=%2A%C2%A1Hola%21%2A%20%E2%9C%8B%20Vengo%20de%20la%20p%C3%A1gina%20web%20de%20%2ATu%20Repuesto%20Ya%2A%20Me%20gustar%C3%ADa%20recibir%20cotizaciones%20sobre%20un%20repuesto%20que%20necesito."
                            class="item" id="whatsapp-icon"><i class="fab fa-whatsapp"></i></a>
                        <a aria-label="Ver perfil de instagram de Tu Repuesto Ya"
                            href="https://www.instagram.com/turepuestoya_col?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                            class="item" id="instagram-footer"><i class="fab fa-instagram"></i></a>
                        <a aria-label="Ver perfil de tik tok de Tu Repuesto Ya"
                            href="https://www.tiktok.com/@tu_repuesto_ya" class="item" id="tiktok-footer"><i
                                class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="clienteModal" tabindex="-1" role="dialog"
            style="max-height: 100vh; max-width: 100vw;">
            <div class="modal-dialog" role="document" style="max-width: 800px !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-weight: 700;">Crea tu solicitud</h5>
                        <button type="button" id="btn-close-cliente-modal" class="btn btn-close close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Pestañas del formulario -->
                        <ul class="nav nav-tabs" id="formTabs" style="justify-content: space-evenly; border: none; flex-wrap: nowrap; margin-bottom: 3rem;">
                            <li class="nav-item" id="nav-item1" onclick="changeTab1()">
                                <img decoding="auto" class="img-nav-link" src="{{asset('icon/vehiculo-icon.png')}}" height="100" width="100" alt="vehiculo icon">

                                <div class="nav-link text-secondary active paso_activo" style="border: none;"
                                    id="tab1"><span class="parts" id="part1">1. Vehículo</span></div>
                            </li>
                            <li class="nav-item" id="nav-item2" onclick="changeTab2()">
                                <img decoding="auto" class="img-nav-link" src="{{asset('icon/repuestos-icon.png')}}" height="100" width="100" alt="vehiculo icon">

                                <div class="nav-link text-secondary" style="border: none;"
                                    id="tab2"><span class="parts" id="part2">2. Repuesto</span></div>
                            </li>
                            <li class="nav-item" id="nav-item3" onclick="changeTab3()">
                                <img decoding="auto" class="img-nav-link" src="{{asset('icon/user-icon.png')}}" height="100" width="100" alt="vehiculo icon">

                                <div class="nav-link text-secondary" style="border: none;"
                                    id="tab3"><span class="parts" id="part3">3. Tus Datos</span></div>
                            </li>
                        </ul>

                        <!-- Contenido de las pestañas -->
                        <div class="tab-content">
                            <form id="form_client" method="POST" action="{{ route('validation') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- Parte 1 del formulario -->
                                <div class="tab-pane fade show active" id="tab-content1"
                                    style="transition: all 300ms ease;">

                                    <div class="form-group">
                                        <div class="flex flex-col mb-4">
                                            <label class="form-label" for="marca" style="margin: 0 0 .5rem 0; font-weight: 600;">Elige la marca de tu vehículo<span class="text-danger">*</span></label>
                                            <div style="display: flex;">
                                                <label for="check-marca" class="circular-checkbox">
                                                    <span class="check" id="check-marca" style="background-color: #25d366; border-radius: 50%; height: 100%; width: 100%; display: block;"></span>
                                                </label>
                                                <input title="Marca" id="marca-otro"
                                                    style="border-color: var(--bs-dark-border-subtle); border-radius: .375rem;"
                                                    class="form-control hide" value="{{ old('marca') }}"
                                                    placeholder="*Otra Marca" autofocus>
                                                <select name="marca" id="marca"
                                                    class="form-control"
                                                    style="color: var(--bs-secondary-color); border-color: transparent; background-color: rgb(235, 234, 234); border-radius: .375rem; appearance: auto;"
                                                    required>
                                                    <option value="" disabled selected>Selecciona</option>
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
                                                    <option value="Isuzu">Isuzu</option>
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

                                            @error('marca')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col mb-4">
                                            <label class="form-label" for="referencia" style="margin: 0 0 .5rem 0; font-weight: 600;">Referencia del vehículo<span class="text-danger">*</span></label>
                                            <div style="display: flex; align-items: center;">
                                                <label for="check-referencia" class="circular-checkbox">
                                                    <span id="check-referencia" class="check" style="background-color: #25d366; border-radius: 50%; height: 100%; width: 100%; display: block;"></span>
                                                </label>
                                                <input type="text" name="referencia" id="referencia"
                                                    class="form-control"
                                                    style="border-color: transparent; background-color: rgb(235, 234, 234); border-radius: .375rem;"
                                                    placeholder="Ejemplo: Joy, Captiva..."
                                                    aria-label="Referencia" value="{{ old('referencia') }}" required>
                                            </div>
                                            @error('referencia')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col mb-4">
                                            <label class="form-label" for="modelo" style="margin: 0 0 .5rem 0; font-weight: 600;">¿De que año es tu vehículo?<span class="text-danger">*</span></label>
                                            <div style="display: flex; align-items: center;">
                                                <label for="check-modelo" class="circular-checkbox">
                                                    <span id="check-modelo" class="check" style="background-color: #25d366; border-radius: 50%; height: 100%; width: 100%; display: block;"></span>
                                                </label>
                                                <select id="modelo" name="modelo"
                                                    class="form-control"
                                                    style="appearance: auto; color: var(--bs-secondary-color); border-color: transparent; background-color: rgb(235, 234, 234); border-radius: .375rem;"
                                                    required>
                                                    <option value='' disabled selected>Selecciona</option>
                                                    <?php
                                                    $anioActual = date('Y');
                                                    for ($modelo = $anioActual + 1; $modelo >= 1999; $modelo--) {
                                                        echo "<option value=\"$modelo\">$modelo</option>";
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                            @error('modelo')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col mb-4">
                                            <label class="form-label" for="tipo" style="margin: 0 0 .5rem 0; font-weight: 600;">Tipo de transmisión (Caja)<span class="text-danger">*</span></label>
                                            <div style="display: flex;">
                                                <label for="check-tipo" class="circular-checkbox">
                                                    <span id="check-tipo" class="check" style="background-color: #25d366; border-radius: 50%; height: 100%; width: 100%; display: block;"></span>
                                                </label>
                                                <select class="form-control" name="tipo" id="tipo"
                                                    name="tipo"
                                                    style="appearance: auto; color: var(--bs-secondary-color); border-color: transparent; background-color: rgb(235, 234, 234); border-radius: .375rem;"
                                                    required>
                                                    <option value="" disabled selected>Selecciona</option>
                                                    <option value="mecánica">Mecánica (Manual)</option>
                                                    <option value="automatica">Automática</option>
                                                </select>
                                            </div>

                                            @error('tipo')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div
                                        style="width:100%; height: max-content; display: flex; justify-content: flex-end;">
                                        <button id="btn_siguiente" type="button" class="btn btn-primary"
                                            onclick="changeTab2()">Siguiente</button>
                                    </div>

                                </div>

                                {{-- Parte 2 del formulario --}}
                                <div class="tab-pane fade" id="tab-content2" style="transition: all 300ms ease;">
                                    <div class="form-group">
                                        <?php
                                            $repuestos = [
                                                'Llantas' => ['Llantas', 'Llantas delanteras', 'Llantas traseras', 'Llantas de repuesto', 'Llantas de invierno', 'Llantas de verano', 'Llantas deportivas', 'Llantas de alta resistencia', 'Llantas de bajo perfil'],
                                                'Neumáticos' => ['Neumáticos', 'Neumáticos delanteros', 'Neumáticos traseros', 'Neumáticos de repuesto', 'Neumáticos de invierno', 'Neumáticos de verano', 'Neumáticos deportivos', 'Neumáticos de alta resistencia', 'Neumáticos de bajo perfil'],
                                                'Frenos' => ['Pastillas de freno delanteras', 'Pastillas de freno traseras', 'Discos de freno delanteros', 'Discos de freno traseros', 'Tambores de freno traseros', 'Bomba de freno', 'Servofreno'],
                                                'Suspensiones' => ['Amortiguadores delanteros', 'Amortiguadores traseros', 'Resortes delanteros', 'Resortes traseros', 'Barra estabilizadora delantera', 'Barra estabilizadora trasera', 'Bieletas'],
                                                'Direccion' => ['Cremallera de dirección', 'Mangueras de dirección', 'Bomba de dirección', 'Terminales de dirección', 'Juntas homocinéticas'],
                                                'Motor' => ['Filtros de aceite', 'Filtros de aire', 'Filtros de combustible', 'Bujías', 'Bobinas de encendido', 'Correas de distribución', 'Bomba de agua', 'Bomba de aceite', 'Turbocompresor', 'Alternador', 'Arrancador'],
                                                'Transmisión' => ['Aceite de transmisión', 'Filtro de transmisión', 'Embrague', 'Caja de cambios manual', 'Caja de cambios automática'],
                                                'Tren motriz' => ['Juntas homocinéticas', 'Diferencial', 'Semiejes'],
                                                'Chasis' => ['Puertas', 'Ventanas', 'Espejos retrovisores', 'Parachoques', 'Capó', 'Maletero', 'Faros', 'Luces traseras', 'Señales de giro', 'Defensa', 'Placa de matrícula'],
                                                'Electricidad' => ['Baterías', 'Faros', 'Luces traseras', 'Señales de giro', 'Limpiaparabrisas', 'Limpiaparabrisas traseros', 'A/C', 'Calefacción', 'Radio', 'Altavoces', 'Sistema de navegación'],
                                                'Otros' => ['Líquido de frenos', 'Líquido refrigerante', 'Líquido de dirección asistida', 'Líquido de transmisión', 'Limpiador de parabrisas', 'Anticongelante', 'Aceite de motor', 'Aditivos'],
                                            ];

                                            // Convierte a opciones
                                            $options = [];
                                            foreach ($repuestos as $categoria => $items) {
                                                foreach ($items as $item) {
                                                    $options[] = "<option value=\"$item\"></option>";
                                                }
                                            }
                                        ?>
                                        <div class="flex flex-col mb-4">
                                            <label class="form-label" for="repuesto" style="margin: 0 0 .5rem 0; font-weight: 600;">Nombre del repuesto<span class="text-danger">*</span></label>
                                            <div style="display: flex;">
                                                <label for="check-repuesto" class="circular-checkbox">
                                                    <span id="check-repuesto" class="check" style="background-color: #25d366; border-radius: 50%; height: 100%; width: 100%; display: block;"></span>
                                                </label>
                                                <input type="text" name="repuesto" id="repuesto"
                                                    style="border-radius: 0.375rem; border-color: transparent; background-color: rgb(235, 234, 234); border-radius: .375rem;"
                                                    class="form-control" list="lista_repuestos"
                                                    placeholder="Eje. Amortiguadores"
                                                    aria-label="Repuesto" value="{{ old('repuesto') }}">
                                                    {{-- <datalist id="lista_repuestos">
                                                        <option value="" selected disabled>Ejemplos:</option>
                                                        <?php
                                                            //echo implode("\n", $options);
                                                        ?>

                                                    </datalist> --}}
                                            </div>
                                        </div>

                                        <div class="flex flex-col mb-4">
                                            <label class="form-label" for="cantidad" style="margin: 0 0 .5rem 0; font-weight: 600;">Cantidad<span class="text-danger">*</span></label>
                                            <div style="display: flex;">
                                                <label for="check-cantidad" class="circular-checkbox">
                                                    <span id="check-cantidad" class="check" style="background-color: #25d366; border-radius: 50%; height: 100%; width: 100%; display: block;"></span>
                                                </label>
                                                <input type="number" name="cantidad" id="cantidad"
                                                    style="border-radius: 0.375rem; border-color: transparent; background-color: rgb(235, 234, 234); border-radius: .375rem;"
                                                    class="form-control"
                                                    placeholder="Ejemplo: 2"
                                                    aria-label="Repuesto" value="{{ old('cantidad') }}">
                                            </div>
                                        </div>

                                        <div class="flex flex-col mb-4">
                                            <div class="form control" style="background-color: rgb(235, 234, 234); padding: 1rem; border-radius: .375rem;">
                                                <div id="title-checks-container" style="text-align: center; font-weight: 700;">Definición del repuesto (Opcional)</div>
                                                <div class="checksContainer">
                                                    <div class="flex-container" id="flex-container-1">
                                                        <div class="contenedor-checksbox">
                                                            <div>
                                                                <input class="inputs-checks" type="checkbox" name="check_derecho" id="check-derecho">
                                                                <label for="check-derecho">Derecho</label>
                                                            </div>
                                                            <div>
                                                                <input class="inputs-checks" type="checkbox" name="check_izquierdo" id="check-izquierdo">
                                                                <label for="check-izquierdo">Izquiero</label>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="flex-container" id="flex-container-2">
                                                        <div class="contenedor-checksbox">
                                                            <div>
                                                                <input class="inputs-checks" type="checkbox" name="check_delantero" id="check-delantero">
                                                                <label for="check-delantero">Delantero</label>
                                                            </div>
                                                            <div>
                                                                <input class="inputs-checks" type="checkbox" name="check_trasero" id="check-trasero">
                                                                <label for="check-trasero">Trasero</label>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div style="display: flex; justify-content: center; width: 100%;">
                                            {{-- <div class="modal fade" id="ejemploModal" tabindex="-1" role="dialog"
                                                style="max-height: 100vh; max-width: 100vw;">
                                                <div class="modal-dialog" role="document" style="max-width: max-content !important; top: 0; top: 20vh;">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="padding: 0.25rem 1rem; justify-content: flex-end;">
                                                            <button type="button" id="btn-close-ejemplo-modal" class="btn btn-close close"
                                                                style="margin: 0;" data-dismiss="modal" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{asset('img/ver-mas.png')}}" alt="ejemplo para agregar repuestos">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div type="button" id="ejemplo_para_agregar_repuestos" data-toggle="modal"  data-target="#ejemploModal" style="color: var(--color-primary); text-decoration: underline; margin-top: .3rem; border-radius: 0 0 .50rem .50rem !important; padding: 0.3rem 0.8rem; font-size: 0.8rem; border: none; height: max-content;">Ver ejemplo</div>--}}
                                            <a name="agregar_repuesto" id="agregar_repuesto" class="mb-4"
                                                style="transition: all 300ms ease; border-radius: 0 0 .50rem .50rem !important; color: var(--color-primary); text-decoration: none; font-size: 1rem; border: none; background: none;">
                                                + Agrega otro repuesto
                                            </a>
                                        </div>

                                        <div class="flex flex-col">
                                            <div id="campo_repuestos">
                                                <div id="items_container" class="items_container form-control"
                                                    style="border: none;">
                                                    <div style="width: 100%; height: 1.5rem;"><small
                                                            class="text-xs text-secondary"
                                                            style="position: absolute;">Repuestos agregados:</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @error('json_repuestos')
                                            <div class="text-danger text-xs pb-2">{{ $message }}</div>
                                        @else
                                            <div id="text-maximo-repuestos"
                                                style="display: flex; width: 100%; justify-content: center;">
                                                <small class="text-xs mt-1 mb-4 text-secondary">Máximo 5 repuestos</small>
                                            </div>
                                        @enderror

                                        {{-- <div class="flex flex-col mb-3 text-center">
                                            <select class="form-control" name="categoria_repuesto"
                                                id="categoria_repuesto"
                                                style="color: var(--bs-secondary-color); text-align: center;" required>
                                                <option value="" disabled selected>*Categoría de los Repuestos
                                                </option>
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
                                            </select>
                                            <div id="categorias_preferencias" class="flex flex-col mb-3">
                                                <div id="items_container_categorias" class="form-control"></div>
                                            </div>
                                            @error('json_categorias')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div> --}}

                                        <div class="flex flex-col mb-3" style="display: flex; flex-wrap: nowrap;">
                                            <label id="btn" class="button" for="img_repuesto"
                                                style="margin-right: 1rem; cursor: pointer; color: var(--bs-secondary-color); border-radius: .375rem; padding: 1rem; background: rgb(235, 234, 234);">
                                                <img src="{{asset('icon/camara.icon.png')}}" height="100" alt="camara icono" style="height: 100px; width: auto;">
                                            </label>
                                            <input type="file" accept="image/*" name="img_repuesto[]"
                                                id="img_repuesto" class="form-control"
                                                aria-label="img_repuesto" style="display: none;" multiple>
                                            @error('img_repuesto')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @else
                                                <div class="pt-1">
                                                    <h6 style="font-weight: 700;" id="aclaraciones-title">Fotografía (Opcional)</h6>
                                                    <ul class="aclaraciones-list">
                                                        <li class="text-xs"><small>Máximo ( 3 ) imágenes del repuesto</small></li>
                                                        <li class="text-xs"><small>Fotografía de la tarjeta de propiedad para una mejor busqueda.</small></li>
                                                    </ul>
                                                    <small class="text-xs"></small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div
                                        style="width:100%; height: max-content; display: flex; justify-content: space-between;">
                                        <button type="button" class="btn btn-secondary"
                                            onclick="changeTab1()">Anterior</button>
                                        <button id="btn_siguiente2" type="button" class="btn btn-primary"
                                        onclick="changeTab3()">Siguiente</button>
                                    </div>
                                </div>

                                <!-- Parte 3 del formulario -->
                                <div class="tab-pane fade" id="tab-content3" style="transition: all 300ms ease;">

                                    <div class="form-group">
                                        <div class="flex flex-col mb-4">
                                            <label class="form-label" for="nombre" style="margin: 0 0 .5rem 0; font-weight: 600;">Nombre<span class="text-danger">*</span></label>
                                            <div style="display: flex; align-items: center;">
                                                <label for="check-nombre" class="circular-checkbox">
                                                    <span id="check-nombre" class="check" style="background-color: #25d366; border-radius: 50%; height: 100%; width: 100%; display: block;"></span>
                                                </label>
                                                <input type="text" class="form-control" id="nombre"
                                                    name="nombre" placeholder="Nombre"
                                                    style="background-color: rgb(235, 234, 234); border-radius: .375rem;"
                                                    aria-label="Nombre" value="{{ old('nombre') }}" required = "true">
                                            </div>

                                            @error('nombre')
                                                <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="group">
                                            <div class="flex flex-col mb-4">
                                                <label class="form-label" for="cel" style="margin: 0 0 .5rem 0; font-weight: 600;">Número de celular<span class="text-danger">*</span> <span class="text-secondary" style="font-weight: normal;">(Debe tener WhatsApp)</span></label>
                                                <div
                                                    style="display: flex; justify-content: space-between; align-items: center; padding: 0; margin-bottom: .3rem;">
                                                    <label for="check-cel" class="circular-checkbox">
                                                        <span id="check-cel" class="check" style="background-color: #25d366; border-radius: 50%; height: 100%; width: 100%; display: block;"></span>
                                                    </label>
                                                    <div style="display: flex; align-items: center; width: 100%;">
                                                        <span class="form-control" style="margin-right: .5rem; width: max-content; background-color: rgb(235, 234, 234); border-radius: .375rem;">
                                                            <select name="codigo_cel" id="codigo-cel" style="height: 100%; background: transparent !important; border: 1px solid rgb(235, 234, 234);">
                                                                @foreach ($codigos as $codigo)
                                                                    <option value="{{ $codigo->codigo }}"
                                                                        title="{{ $codigo->pais }}">
                                                                        {{ $codigo->codigo }}</option>
                                                                @endforeach
                                                            </select>
                                                        </span>
                                                        <input type="text" class="form-control"
                                                            id="cel" name="cel"
                                                            placeholder="Eje. 300XXX0000" aria-label='Cel'
                                                            value="{{ old('cel') }}"
                                                            style="width: 100%; background-color: rgb(235, 234, 234); border-radius: .375rem;"
                                                            required>
                                                    </div>

                                                </div>
                                                @error('cel')
                                                    <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div id="pais" class="flex flex-col mb-4 hide">
                                                <label class="form-label" for="text-pais" style="margin: 0 0 .5rem 0; font-weight: 600;">Pais</label>
                                                <div style="display: flex;">
                                                    <label for="check-pais" class="circular-checkbox">
                                                        <span id="check-pais" class="check" style="background-color: #25d366; border-radius: 50%; height: 100%; width: 100%; display: block;"></span>
                                                    </label>
                                                    <div class="form-control"
                                                        style="background-color: rgb(235, 234, 234);">
                                                        <span id="text-pais"></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="flex flex-col mb-4">
                                            <label class="form-label" for="email" style="margin: 0 0 .5rem 0; font-weight: 600;">E-mail</label>
                                            <div style="display: flex; align-items: center;">
                                                <label for="check-email" class="circular-checkbox">
                                                    <span id="check-email" class="check" style="background-color: #25d366; border-radius: 50%; height: 100%; width: 100%; display: block;"></span>
                                                </label>
                                                <input type="email" class="form-control" id="email"
                                                    name="email" placeholder="E-mail"
                                                    style="background-color: rgb(235, 234, 234); border-radius: .375rem;"
                                                    aria-label="Email" value="{{ old('email') }}">
                                            </div>

                                            @error('email')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col mb-4" id="contenedor_departamento">
                                            <label class="form-label" for="departamento" style="margin: 0 0 .5rem 0; font-weight: 600;">Departamento<span class="text-danger">*</span></label>
                                            <div style="display: flex; align-items: center;">
                                                <label for="check-departamento" class="circular-checkbox">
                                                    <span id="check-departamento" class="check" style="background-color: #25d366; border-radius: 50%; height: 100%; width: 100%; display: block;"></span>
                                                </label>
                                                <select id="departamento" name="departamento"
                                                    class="form-control"
                                                    style="appearance: auto; color: var(--bs-secondary-color); background-color: rgb(235, 234, 234); border-radius: .375rem;">
                                                    <option value="" disabled selected>Selecciona</option>
                                                    @foreach ($departamentos as $departamento)
                                                        <option value="{{ $departamento }}">{{ $departamento }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            @error('departamento')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col mb-4" id="contenedor_municipio">
                                            <label class="form-label" for="municipio" style="margin: 0 0 .5rem 0; font-weight: 600;">Municipio<span class="text-danger">*</span></label>
                                            <div style="display: flex; align-items: center;">
                                                <label for="check-municipio" class="circular-checkbox">
                                                    <span id="check-municipio" class="check" style="background-color: #25d366; border-radius: 50%; height: 100%; width: 100%; display: block;"></span>
                                                </label>
                                                <select name="municipio" id="municipio"
                                                    class="form-control"
                                                    style="appearance: auto; color: var(--bs-secondary-color); background-color: rgb(235, 234, 234); border-radius: .375rem;">
                                                    <option value="" disabled selected>Selecciona</option>
                                                </select>
                                            </div>

                                            @error('municipio')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col mb-4">
                                            <label class="form-label" for="comentario" style="margin: 0 0 .5rem 0; font-weight: 600;">Comentarios</label>
                                            <div style="display: flex; align-items: center;">
                                                <textarea name="comentario" id="comentario" class="form-control"
                                                    style="background-color: rgb(235, 234, 234);" placeholder="¿Tienes algun comentario?"
                                                    aria-label="Comentario" rows="5">{{ old('comentario') }}</textarea>
                                            </div>

                                            @error('comentario')
                                                <div class='text-danger text-xs pt-1'> {{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                    {{-- <div class="text-center">
                                        <button id="btn_modal_client" type="submit" class="btn btn-primary w-100 my-4 mb-2">Enviar</button>
                                    </div> --}}

                                    <div
                                        style="width:100%; height: max-content; display: flex; justify-content: space-between;">
                                        <button type="button" class="btn btn-secondary"
                                            onclick="changeTab2()">Anterior</button>
                                        <button id="btn_submit" type="submit" class="btn btn-primary">Enviar</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('includes.scripts')

        <script>
            // Obtener el formulario por su ID
            const formulario = document.getElementById('form_client');

            // Manejador de eventos para el evento 'submit'
            formulario.addEventListener('submit', function(event) {
                // Verificar si el formulario es válido
                if (formulario.checkValidity()) {
                    // Si el formulario es válido, borrar todos los datos en localStorage
                    localStorage.clear();
                } else {
                    // Si el formulario no es válido, prevenir la acción por defecto (la recarga de la página)
                    event.preventDefault();
                }
            });
        </script>

        <!-- Script para gestionar la selección y envío de repuestos -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Obtener referencias a elementos del DOM
                let campo_repuesto = document.getElementById('repuesto');
                let campo_cantidad = document.getElementById('cantidad');
                let btn_agregar = document.getElementById('agregar_repuesto');
                let campo_repuestos = document.getElementById('campo_repuestos');
                let container = document.getElementById('items_container');
                let text_maximo_repuestos = document.getElementById('text-maximo-repuestos');
                let check_i = document.getElementById('check-izquierdo');
                let check_d = document.getElementById('check-derecho');
                let check_t = document.getElementById('check-trasero');
                let check_del = document.getElementById('check-delantero');

                // Inicializar elementos ocultos
                campo_repuestos.classList.add('hide');
                btn_agregar.setAttribute('disabled', true);
                btn_agregar.style.cursor = "not-allowed";
                btn_agregar.setAttribute('title', 'Escribe el nombre del Repuesto.');
                text_maximo_repuestos.classList.add('hide');

                // Intentar recuperar los repuestos seleccionados del localStorage
                let seleccionados = JSON.parse(localStorage.getItem('seleccionados')) || {};

                // Función para agregar un botón
                function agregarBoton(item) {
                    let button = document.createElement('button');
                    button.classList.add('item_selected');
                    button.style.padding = 0;
                    button.style.height ='max-content';
                    button.setAttribute('name', 'item');
                    button.innerHTML = '<span style="padding: .5rem 1rem; height: 100%; background: #d3d3d3; border-radius: .25rem 0 0 .25rem;">' + item + "</span>" + '<img height="20" width="16" class="btn_borrar_item" src="{{asset("icon/trash.png")}}" alt="icono de basura" style="padding: .5rem; margin-top: auto; margin-bottom: auto; max-width: max-content; max-height: max-content; box-shadow: 7px 0px 8px -7px inset #00000099; border-radius: 0 .25rem .25rem 0; background: #ff5b5b;">';
                    btn_agregar.setAttribute('disabled', true);
                    btn_agregar.style.cursor = "not-allowed";
                    btn_agregar.setAttribute('title', 'Escribe el nombre del Repuesto.');

                    // Agregar un evento de escucha de clics al botón
                    button.addEventListener('click', function() {
                        // Eliminar el botón del contenedor
                        container.removeChild(button);

                        // Eliminar la opción del objeto seleccionados
                        delete seleccionados[item];

                        // Guardar las repuestos seleccionadas en el localStorage
                        localStorage.setItem('seleccionados', JSON.stringify(seleccionados));

                        if (container.children.length === 1 && campo_repuesto === 0) {
                            campo_repuestos.classList.add('hide');
                            text_maximo_repuestos.classList.add('hide');
                            btn_agregar.setAttribute('disabled', true);
                            btn_agregar.style.cursor = "not-allowed";
                            btn_agregar.setAttribute('title', 'Escribe el nombre del Repuesto.');
                            campo_repuesto.setCustomValidity('No has agregado ningún repuesto');
                        }

                    });

                    container.appendChild(button);

                    // Marcar la opción como seleccionada
                    seleccionados[item] = true;

                    // Guardar las repuestos seleccionadas en el localStorage
                    localStorage.setItem('seleccionados', JSON.stringify(seleccionados));
                }

                // Si hay repuestos seleccionadas, recrear los botones
                if (Object.keys(seleccionados).length > 0) {
                    campo_repuestos.classList.remove('hide');
                    text_maximo_repuestos.classList.remove('hide');
                    for (let item in seleccionados) {
                        agregarBoton(item);
                    }
                }

                campo_repuesto.addEventListener('input', function() {
                    if(campo_repuesto.value.length == 0){
                        btn_agregar.setAttribute('disabled', true);
                        btn_agregar.style.cursor = "not-allowed";
                        btn_agregar.setAttribute('title', 'Escribe el nombre del Repuesto.');
                        campo_repuesto.setCustomValidity('Escribe el nombre del repuesto.');
                    }else{
                        btn_agregar.removeAttribute('disabled');
                        btn_agregar.style.cursor = "pointer";
                        btn_agregar.removeAttribute('title');
                        campo_repuesto.setCustomValidity('')
                    }

                });

                // Escuchar el evento clic en el botón de agregar
                btn_agregar.addEventListener('click', function() {
                    if(campo_cantidad.value == 0){
                        campo_cantidad.setCustomValidity('La cantidad no puede ser igual a cero');
                        let form = document.getElementById('form_client');
                        if (!form.reportValidity()) {
                            return;
                        }
                    }else{
                        campo_cantidad.setCustomValidity('');
                    }
                    let definicion = [];

                    if (check_i.checked) {
                        definicion.push('izquierdo');
                    }

                    if (check_d.checked) {
                        definicion.push('derecho');
                    }

                    if (check_t.checked) {
                        definicion.push('trasero');
                    }

                    if (check_del.checked) {
                        definicion.push('delantero');
                    }

                    let def = definicion.join(', ');

                    let item = campo_repuesto.value;
                    let cant = campo_cantidad.value;
                    let btnSig = document.getElementById('btn_siguiente2');
                    campo_repuesto.value = "";
                    campo_cantidad.value = "";
                    check_i.checked = false;
                    check_d.checked = false;
                    check_t.checked = false;
                    check_del.checked = false;

                    if (item !== "") {
                        if (container.children.length < 6) {
                            if (!seleccionados[cant + ' ' + item + ' ' + def]) {
                                agregarBoton(cant + ' ' + item + ' ' + def);
                                campo_repuestos.classList.remove('hide');
                                text_maximo_repuestos.classList.remove('hide');
                            }
                        } else {
                            alert('Ya has agregado un máximo de 5 repuestos.');
                            return;
                        }
                    }

                });

                // Ocultar elementos si no hay repuestos seleccionadas
                if (container.children.length === 1) {
                    campo_repuestos.classList.add('hide');
                    text_maximo_repuestos.classList.add('hide');
                    btn_agregar.setAttribute('disabled', true);
                    btn_agregar.style.cursor = "not-allowed";
                    btn_agregar.setAttribute('title', 'Escribe el nombre del Repuesto.');
                    campo_repuesto.setAttribute('required', true);
                    campo_cantidad.setAttribute('required', true);
                }else if(container.children.length > 1 && campo_repuesto.length == 0){
                    campo_repuesto.removeAttribute('required');
                    campo_cantidad.removeAttribute('required');
                }else{
                    campo_repuesto.removeAttribute('required');
                }

                // Escuchar el evento de envío del formulario
                document.getElementById('form_client').addEventListener('submit', function(event) {
                    if((campo_cantidad.value == '' && campo_repuesto.value == '') || (campo_cantidad.value != '' && campo_repuesto.value != '') && container.children.length > 1){
                        // Evitar el envío del formulario para manejarlo manualmente
                        event.preventDefault();

                        // Obtener los textos de los botones en un arreglo
                        let textosSeleccionados = Object.keys(seleccionados);

                        // Convertir el arreglo a una cadena JSON
                        let jsonTextosSeleccionados = JSON.stringify(textosSeleccionados);

                        // Agregar un campo oculto al formulario y asignarle la cadena JSON
                        let inputJson = document.createElement('input');
                        inputJson.type = 'hidden';
                        inputJson.name = 'json_repuestos';
                        inputJson.value = jsonTextosSeleccionados.replace(/×/g, '').replace(/\n/g, '');
                        this.appendChild(inputJson);

                        // Limpiar los datos en localStorage después de enviar el formulario
                        localStorage.removeItem('seleccionados');

                        container.value = "";
                    }

                    // Ahora, puedes enviar el formulario
                    this.submit();
                });

            });
        </script>

        <script>
            //Tabs
            const tabId1 = document.getElementById('tab-content1');
            const tabId2 = document.getElementById('tab-content2');
            const tabId3 = document.getElementById('tab-content3');
            const tab1 = document.getElementById('tab1');
            const tab2 = document.getElementById('tab2');
            const tab3 = document.getElementById('tab3');
            const nav_item1 = document.getElementById('nav-item1');
            const nav_item2 = document.getElementById('nav-item2');
            const nav_item3 = document.getElementById('nav-item3');

            nav_item1.style.opacity = '.5';
            nav_item2.style.opacity = '.5';
            nav_item3.style.opacity = '.5';

            const container_checks = document.getElementsByClassName('circular-checkbox');
            const check = document.getElementsByClassName('check');

            for(let i = 0; i < container_checks.length; i++){
                container_checks[i].style.border = '2px rgb(235, 234, 234) solid';
            }
            for(let i = 0; i < check.length; i++){
                check[i].style.backgroundColor = 'rgb(235, 234, 234)';
            }

            const select_marca = document.getElementById('marca');
            const campo_marca_otro = document.getElementById('marca-otro');
            const campo_referencia = document.getElementById('referencia');
            const select_modelo = document.getElementById('modelo');
            const select_transmisión = document.getElementById('tipo');

            const campo_repuesto = document.getElementById('repuesto');
            const campo_cantidad = document.getElementById('cantidad');
            const container = document.getElementById('items_container');

            const campo_nombre = document.getElementById('nombre');
            const campo_cel = document.getElementById('cel');
            const campo_email = document.getElementById('email');
            const campo_departamento = document.getElementById('departamento');
            const campo_municipio = document.getElementById('municipio');


            function changeTab1() {

                if(select_marca.value !== ''){
                    container_checks[0].style.border = '2px #25d366 solid';
                    check[0].style.backgroundColor = '#25d366';
                }

                if (campo_referencia.value !== '') {
                    container_checks[1].style.border = '2px #25d366 solid';
                    check[1].style.backgroundColor = '#25d366';
                }


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

                nav_item1.style.opacity = '1';
                nav_item2.style.opacity = '.5';
                nav_item3.style.opacity = '.5';

            }

            function changeTab2() {

                campo_nombre.removeAttribute('required');
                campo_cel.setCustomValidity("");
                campo_cel.removeAttribute("required");
                campo_departamento.removeAttribute('required');
                campo_municipio.removeAttribute('required');
                campo_cantidad.removeAttribute('required');
                campo_cantidad.setCustomValidity('');
                campo_repuesto.removeAttribute('required');
                campo_repuesto.setCustomValidity('');

                const form = document.getElementById('form_client');
                if (!form.reportValidity()) {
                    return;
                }else{
                    tabId1.classList.add('hide');
                    tab1.classList.remove('active');
                    tab1.classList.remove('paso_activo');
                    tabId1.classList.remove('show');
                    tabId1.classList.remove('active');

                    tabId2.classList.remove('hide');
                    tabId2.classList.add('active');
                    tab2.classList.add('active');
                    tab2.classList.add('paso_activo');
                    tabId2.classList.add('show');

                    tabId3.classList.add('hide');
                    tabId3.classList.remove('active');
                    tab3.classList.remove('active');
                    tab3.classList.remove('paso_activo');
                    tabId3.classList.remove('show');
                }

                nav_item1.style.opacity = '.5';
                nav_item2.style.opacity = '1';
                nav_item3.style.opacity = '.5';
            }

            function changeTab3() {

                if(container.children.length > 1){
                    campo_repuesto.removeAttribute('required');
                    campo_cantidad.removeAttribute('required');
                }else{
                    campo_repuesto.setAttribute('required', true);
                    campo_cantidad.setAttribute('required', true);
                    if(campo_cantidad.value == 0){
                        campo_cantidad.setCustomValidity('La cantidad no puede ser igual a cero');
                    }else{
                        campo_cantidad.setCustomValidity('');
                    }

                }
                const form = document.getElementById('form_client');
                if (!form.reportValidity()) {
                    return;
                }else{
                    tabId1.classList.add('hide');
                    tab1.classList.remove('active');
                    tab1.classList.remove('paso_activo');
                    tabId1.classList.remove('show');
                    tabId1.classList.remove('active');

                    tabId2.classList.add('hide');
                    tabId2.classList.remove('active');
                    tab2.classList.remove('active');
                    tab2.classList.remove('paso_activo');
                    tabId2.classList.remove('show');

                    tabId3.classList.remove('hide');
                    tabId3.classList.add('active');
                    tab3.classList.add('active');
                    tab3.classList.add('paso_activo');
                    tabId3.classList.add('show');
                }

                nav_item1.style.opacity = '.5';
                nav_item2.style.opacity = '.5';
                nav_item3.style.opacity = '1';

                campo_nombre.setAttribute('required', true);
                campo_cel.setAttribute('required', true);
                campo_departamento.setAttribute('required', true);
                campo_municipio.setAttribute('required', true);

            }

            select_marca.addEventListener('change', () => {
                if(select_marca.value != ''){
                    container_checks[0].style.border = '2px #25d366 solid';
                    check[0].style.backgroundColor = '#25d366';
                }else{
                    container_checks[0].style.border = '2px #ff5a51 solid';
                    check[0].style.backgroundColor = '#ff5a51';
                }
            });
            campo_marca_otro.addEventListener('input', () => {
                if(campo_marca_otro.value != ''){
                    container_checks[0].style.border = '2px #25d366 solid';
                    check[0].style.backgroundColor = '#25d366';
                }else{
                    container_checks[0].style.border = '2px #ff5a51 solid';
                    check[0].style.backgroundColor = '#ff5a51';
                }
            });
            campo_referencia.addEventListener('input', () => {
                if (campo_referencia.value !== '') {
                    container_checks[1].style.border = '2px #25d366 solid';
                    check[1].style.backgroundColor = '#25d366';
                } else {
                    container_checks[1].style.border = '2px #ff5a51 solid';
                    check[1].style.backgroundColor = '#ff5a51';
                }
            });

            select_modelo.addEventListener('change', () => {
                if(select_modelo.value != ''){
                    container_checks[2].style.border = '2px #25d366 solid';
                    check[2].style.backgroundColor = '#25d366';
                }else{
                    container_checks[2].style.border = '2px #ff5a51 solid';
                    check[2].style.backgroundColor = '#ff5a51';
                }
            });
            select_transmisión.addEventListener('change', () => {
                if(select_transmisión.value != ''){
                    container_checks[3].style.border = '2px #25d366 solid';
                    check[3].style.backgroundColor = '#25d366';
                }else{
                    container_checks[3].style.border = '2px #ff5a51 solid';
                    check[3].style.backgroundColor = '#ff5a51';
                }
            });

            repuesto.addEventListener('input', function() {
                if (repuesto.value !== '') {
                    container_checks[4].style.border = '2px #25d366 solid';
                    check[4].style.backgroundColor = '#25d366';
                } else {
                    container_checks[4].style.border = '2px #ff5a51 solid';
                    check[4].style.backgroundColor = '#ff5a51';
                }
            });

            cantidad.addEventListener('input', function() {
                if (cantidad.value !== '') {
                    container_checks[5].style.border = '2px #25d366 solid';
                    check[5].style.backgroundColor = '#25d366';
                } else {
                    container_checks[5].style.border = '2px #ff5a51 solid';
                    check[5].style.backgroundColor = '#ff5a51';
                }
            });

            campo_nombre.addEventListener('input', function() {
                if (campo_nombre.value !== '') {
                    container_checks[6].style.border = '2px #25d366 solid';
                    check[6].style.backgroundColor = '#25d366';
                } else {
                    container_checks[6].style.border = '2px #ff5a51 solid';
                    check[6].style.backgroundColor = '#ff5a51';
                }
            });

            campo_cel.addEventListener('input', function() {
                if (campo_cel.value !== '') {
                    container_checks[7].style.border = '2px #25d366 solid';
                    check[7].style.backgroundColor = '#25d366';
                } else {
                    container_checks[7].style.border = '2px #ff5a51 solid';
                    check[7].style.backgroundColor = '#ff5a51';
                }
            });

            campo_email.addEventListener('input', function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (emailRegex.test(campo_email.value)) {
                    container_checks[9].style.border = '2px #25d366 solid';
                    check[9].style.backgroundColor = '#25d366';
                }else {
                    container_checks[9].style.border = '2px #ff5a51 solid';
                    check[9].style.backgroundColor = '#ff5a51';
                }

                if(campo_email.value === ''){
                    container_checks[9].style.border = '2px rgb(235, 234, 234) solid';
                    check[9].style.backgroundColor = 'rgb(235, 234, 234)';
                }
            });


            campo_departamento.addEventListener('change', function() {
                if (campo_departamento.value !== '') {
                    container_checks[10].style.border = '2px #25d366 solid';
                    check[10].style.backgroundColor = '#25d366';
                } else {
                    container_checks[10].style.border = '2px #ff5a51 solid';
                    check[10].style.backgroundColor = '#ff5a51';
                }
            });

            campo_municipio.addEventListener('change', function() {
                if (campo_municipio.value !== '') {
                    container_checks[11].style.border = '2px #25d366 solid';
                    check[11].style.backgroundColor = '#25d366';
                } else {
                    container_checks[11].style.border = '2px #ff5a51 solid';
                    check[11].style.backgroundColor = '#ff5a51';
                }
            });

            changeTab1();
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Obtener los elementos del DOM por su ID
                let marca = document.getElementById('marca');
                let otro = document.getElementById('marca-otro');

                function updateVisibility() {
                    // Verificar si el valor seleccionado es 'otro'
                    if (marca.value == 'otro') {
                        // Remover la clase 'hide' para mostrar el campo 'otro'
                        otro.classList.remove('hide');
                        otro.setAttribute('required', true);
                        otro.setAttribute('name', 'marca');

                        // Añadir la clase 'hide' para ocultar el campo 'marca'
                        marca.classList.add('hide');
                        marca.removeAttribute('required');
                        marca.removeAttribute('name');
                        marca.setAttribute('name', 'marca_otro');

                    } else {
                        // Añadir la clase 'hide' para ocultar el campo 'otro'
                        otro.classList.add('hide');
                        // Remover la clase 'hide' para mostrar el campo 'marca'
                        marca.classList.remove('hide');
                    }
                }

                // Agregar un 'event listener' para detectar cambios en el elemento 'marca'
                marca.addEventListener('change', updateVisibility);

                // Obtener el valor anterior de 'marca' almacenado en localStorage
                const storedMarca = localStorage.getItem('selectedMarca');

                // Verificar si hay un valor almacenado y establecerlo como la opción seleccionada
                if (storedMarca) {
                    marca.value = storedMarca;
                }

                // Añade un evento para inicializar el estado cuando la página se carga
                updateVisibility();

                // Guardar la selección actual en localStorage cuando cambia
                marca.addEventListener('change', function() {
                    localStorage.setItem('selectedMarca', marca.value);
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let codigo = document.getElementById('codigo-cel');
                let valorInicial = sessionStorage.getItem('codigo') || '+57';
                codigo.value = valorInicial;
                let cel = document.getElementById('cel');

                let pais = document.getElementById('pais');
                let textPais = document.getElementById('text-pais');
                let container_dep = document.getElementById('contenedor_departamento');
                let departamento = document.getElementById('departamento');
                let container_muni = document.getElementById('contenedor_municipio');
                let municipio = document.getElementById('municipio');

                // Establece los campos como obligatorios
                departamento.setAttribute('required', true);
                municipio.setAttribute('required', true);

                // Función para limpiar el número de celular
                function limpiarCelular() {
                    cel.value = cel.value.replace(/[^\d]/g, '');
                    if (codigo.value == '+54') {
                        cel.value = cel.value.slice(0, 10);
                    } else if (codigo.value == '+591') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+55') {
                        cel.value = cel.value.slice(0, 11);
                    } else if (codigo.value == '+56') {
                        cel.value = cel.value.slice(0, 9);
                    } else if (codigo.value == '+593') {
                        cel.value = cel.value.slice(0, 9);
                    } else if (codigo.value == '+594') {
                        cel.value = cel.value.slice(0, 9);
                    } else if (codigo.value == '+592') {
                        cel.value = cel.value.slice(0, 7);
                    } else if (codigo.value == '+595') {
                        cel.value = cel.value.slice(0, 9);
                    } else if (codigo.value == '+51') {
                        cel.value = cel.value.slice(0, 9);
                    } else if (codigo.value == '+597') {
                        cel.value = cel.value.slice(0, 7);
                    } else if (codigo.value == '+598') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+58') {
                        cel.value = cel.value.slice(0, 10);
                    } else if (codigo.value == '+57') {
                        cel.value = cel.value.slice(0, 10);
                    } else if (codigo.value == '+1') {
                        cel.value = cel.value.slice(0, 10);
                    } else if (codigo.value == '+506') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+503') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+502') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+504') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+52') {
                        cel.value = cel.value.slice(0, 10);
                    } else if (codigo.value == '+505') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+507') {
                        cel.value = cel.value.slice(0, 8);
                    }
                }

                // Asigna la función al evento input del campo de celular
                cel.addEventListener('input', limpiarCelular);

                function updateVisibility() {
                    sessionStorage.setItem('codigo', codigo.value);

                    if(codigo.value != '+57'){
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    }

                    if (codigo.value == '+54') {
                        if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Argentina';
                    } else if (codigo.value == '+591') {

                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Bolivia';

                    } else if (codigo.value == '+55') {

                        if (isNaN(cel.value) || cel.value.length != 11) {
                            cel.setCustomValidity("El número de celular debe tener 11 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Brasil';

                    } else if (codigo.value == '+56') {

                        if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Chile';

                    } else if (codigo.value == '+593') {

                        if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Ecuador';

                    } else if (codigo.value == '+594') {

                        if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Guayana Francesa';

                    } else if (codigo.value == '+592') {

                        if (isNaN(cel.value) || cel.value.length != 7) {
                            cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Guyana';

                    } else if (codigo.value == '+595') {

                        if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Paraguay';


                    } else if (codigo.value == '+51') {

                        if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        textPais.textContent = 'Perú';

                    } else if (codigo.value == '+597') {

                        if (isNaN(cel.value) || cel.value.length != 7) {
                            cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Surinam';

                    } else if (codigo.value == '+598') {

                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Uruguay';

                    } else if (codigo.value == '+58') {

                        if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Venezuela';

                    } else if (codigo.value == '+57') {
                        departamento.classList.remove('hide');
                        municipio.classList.remove('hide');
                        pais.classList.add('hide');
                        if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Colombia';

                        // Establece los campos como obligatorios
                        departamento.setAttribute('required', true);
                        municipio.setAttribute('required', true);
                        container_dep.classList.remove('hide');
                        container_muni.classList.remove('hide');
                    } else if (codigo.value == '+1') {

                        if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Estados Unidos';

                    } else if (codigo.value == '+506') {

                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Costa Rica';

                    } else if (codigo.value == '+503') {

                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'El Salvador';

                    } else if (codigo.value == '+502') {

                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Guatemala';

                    } else if (codigo.value == '+504') {

                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Honduras';

                    } else if (codigo.value == '+52') {

                        if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'México';

                    } else if (codigo.value == '+505') {

                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Nicaragua';

                    } else if (codigo.value == '+507') {

                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Panamá';

                    }
                }

                codigo.addEventListener('change', updateVisibility);
                cel.addEventListener('change', updateVisibility);

                updateVisibility();
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Paso 1
                let referencia = document.getElementById('referencia');
                let repuestos = document.getElementById('repuesto');

                // Paso 2
                let nombre = document.getElementById('nombre');
                let comentario = document.getElementById('comentario');

                // Funciones paso 1
                function restringirCaracteresReferencia() {
                    let texto = referencia.value;
                    let numEspacios = (texto.match(/ /g) || []).length;
                    let numSaltosLinea = (texto.match(/\n/g) || []).length;

                    if (numEspacios > 1) {
                        referencia.value = texto.replace(/ +/g, ' '.repeat(1));
                    }
                    if (numSaltosLinea > 0) {
                        referencia.value = texto.replace(/\n+/g, '\n'.repeat(0));
                    }
                    if (texto.length > 30) {
                        referencia.value = texto.slice(0, 30);
                    }
                }

                referencia.addEventListener('input', function() {
                    restringirCaracteresReferencia();
                });

                function restringirCaracteresRepuesto() {
                    let texto = repuestos.value;
                    let numEspacios = (texto.match(/ /g) || []).length;
                    let numSaltosLinea = (texto.match(/\n/g) || []).length;

                    if (numEspacios > 1) {
                        repuestos.value = texto.replace(/ +/g, ' '.repeat(1));
                    }
                    if (numSaltosLinea > 0) {
                        repuestos.value = texto.replace(/\n+/g, '\n'.repeat(0));
                    }
                    if (texto.length > 100) {
                        repuestos.value = texto.slice(0, 100);
                    }
                }

                repuestos.addEventListener('input', function() {
                    restringirCaracteresRepuesto();
                });

                function restringirCaracteresComentario() {
                    let texto = comentario.value;
                    let numEspacios = (texto.match(/ /g) || []).length;
                    let numSaltosLinea = (texto.match(/\n/g) || []).length;

                    if (numEspacios > 1) {
                        comentario.value = texto.replace(/ +/g, ' '.repeat(1));
                    }
                    if (numSaltosLinea > 1) {
                        comentario.value = texto.replace(/\n+/g, '\n'.repeat(1));
                    }
                    if (texto.length > 400) {
                        comentario.value = texto.slice(0, 400);
                    }
                }

                comentario.addEventListener('input', function() {
                    restringirCaracteresComentario();
                });

                // Funciones paso 2
                function restringirCaracteresNombre() {
                    let texto = nombre.value;
                    let numEspacios = (texto.match(/ /g) || []).length;
                    let numSaltosLinea = (texto.match(/\n/g) || []).length;

                    if (numEspacios > 1) {
                        nombre.value = texto.replace(/ +/g, ' '.repeat(1));
                    }
                    if (numSaltosLinea > 0) {
                        nombre.value = texto.replace(/\n+/g, '\n'.repeat(0));
                    }
                    if (texto.length > 35) {
                        nombre.value = texto.slice(0, 35);
                    }
                }

                nombre.addEventListener('input', function() {
                    restringirCaracteresNombre();
                });
            });
        </script>

        <script>
            // Obtener los elementos del formulario
            const departamentoSelect = document.getElementById('departamento');
            const municipioSelect = document.getElementById('municipio');

            // Función para cargar los municipios según el departamento seleccionado
            function cargarMunicipios(departamento) {

                municipioSelect.innerHTML = '<option value="">*Municipio</option>';

                // Obtener los municipios del departamento seleccionado de $group
                const municipios = {!! json_encode($group) !!}[departamento];

                if (municipios) {
                    // Agregar las opciones de los municipios al campo de municipio
                    municipios.forEach(municipio => {
                        const option = document.createElement('option');
                        option.value = municipio;
                        option.text = municipio;

                        // Verificar si el municipio coincide con el valor anterior
                        if (municipio === "{{ old('municipio') }}") {
                            option.selected = true;
                        }

                        municipioSelect.add(option);
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

            // Añade un evento para inicializar el estado cuando la página se carga
            document.addEventListener('DOMContentLoaded', function() {
                const selectedDepartamento = departamentoSelect.value;
                if (selectedDepartamento) {
                    cargarMunicipios(selectedDepartamento);
                }
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Obtener el elemento del DOM por su ID
                let departamento = document.getElementById('departamento');

                // Obtener el valor anterior de 'departamento' almacenado en localStorage
                const storedDepartamento = localStorage.getItem('selectedDepartamento');

                // Verificar si hay un valor almacenado y establecerlo como la opción seleccionada
                if (storedDepartamento) {
                    departamento.value = storedDepartamento;
                }

                // Guardar la selección actual en localStorage cuando cambia
                departamento.addEventListener('change', function() {
                    localStorage.setItem('selectedDepartamento', departamento.value);
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Obtener el elemento del DOM por su ID
                let tipo = document.getElementById('tipo');

                // Obtener el valor anterior de 'tipo' almacenado en localStorage
                const storedTipo = localStorage.getItem('selectedTipo');

                // Verificar si hay un valor almacenado y establecerlo como la opción seleccionada
                if (storedTipo) {
                    tipo.value = storedTipo;
                }

                // Guardar la selección actual en localStorage cuando cambia
                tipo.addEventListener('change', function() {
                    localStorage.setItem('selectedTipo', tipo.value);
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Obtener el elemento del DOM por su ID
                let modelo = document.getElementById('modelo');

                // Obtener el valor anterior de 'modelo' almacenado en localStorage
                const storedModelo = localStorage.getItem('selectedModelo');

                // Verificar si hay un valor almacenado y establecerlo como la opción seleccionada
                if (storedModelo) {
                    modelo.value = storedModelo;
                }

                // Guardar la selección actual en localStorage cuando cambia
                modelo.addEventListener('change', function() {
                    localStorage.setItem('selectedModelo', modelo.value);
                });
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let img_repuesto = document.getElementById('img_repuesto');
                const btn = document.getElementById('btn');

                img_repuesto.addEventListener('change', function() {
                    if (this.files.length > 0) {
                        console.log('Se ha seleccionado al menos un archivo.');
                        btn.style.borderColor = 'rgb(157, 232, 157)';
                        btn.innerHTML =
                            'Se ha seleccionado al menos un archivo <i id="check" class="fa fa-check" aria-hidden="true"></i>';
                    }
                });
            });
        </script>

        @if ($errors->any())
            <script>
                $(document).ready(function() {
                    $('#clienteModal').modal('show');
                });
            </script>
        @endif
    </div>
</body>

</html>
