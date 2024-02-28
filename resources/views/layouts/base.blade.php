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
                <span class="navbar-toggler-icon ico-btn"></span>
            </button>
            <div class="collapse navbar-collapse container-op" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto flex-end-cel"
                    style="align-items: center;box-sizing: border-box; font-size: 120%;">

                    <li class="nav-item">
                        <div class="container_nav" id="Cnav1">
                            <a class="nav-link active" href="{{ route('servicios') }}" id="nav_e"
                                aria-current="page">Inicio</a>
                            <div
                                class="animate__animated animate__fadeInUp animate__delay-0s animate__faster nav_active">
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="container_nav" id="Cnav2">
                            <a class="nav-link nav_e1" href="#solicitud-de-repuestos">¿Cómo
                                funciona?</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="container_nav" id="Cnav3">
                            <a class="nav-link nav_e1" href="#contacto">Contacto</a>
                        </div>
                    </li>

                    @guest
                        <li id="container_user" class="nav-item dropdown no-arrow">
                            <div class="container_nav container_flex container_flex_user">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                                <i class="fas fa-user" style="color: #b3b3b3 !important;"></i>
                                <span class="nav_e1"
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $name }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu end-0 dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Administrador
                                </a>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuraciones
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-body">
        @yield('content')

        <div class="container-footer">
            <div class="footer w-100">
                <div class="container-flex container-flex-col-cel">
                    <div class="container-items">
                        <a class="item" href="#">Terminos y condiciones</a>
                        <span class="item none">|</span>
                        <a class="item" href="{{ route('privacy-policy') }}">Politica de privacidad</a>
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
                        <h5 class="modal-title" style="font-weight: 700;">Crea tu solicitud</h5>
                        <button type="button" id="btn-close-cliente-modal" class="btn btn-close close"
                            data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Pestañas del formulario -->
                        <ul class="nav nav-tabs" id="formTabs">
                            <li class="nav-item">
                                <a class="nav-link text-secondary active paso_activo" href="#"
                                    onclick="changeTab2()" id="tab1">Paso 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="#" onclick="validateForm1()"
                                    id="tab2">Paso 2</a>
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

                                    <fieldset class="form-group">
                                        <legend class="text-center" style="display: flex; justify-content: center;">
                                            <h5
                                                style="background: var(--color-primary);
                                            color: white;
                                            width: max-content;
                                            padding: .3rem 1.5rem;
                                            border-radius: 0 0 1rem 1rem;
                                            font-weight: 600;">
                                                Datos del vehiculo</h5>
                                        </legend>
                                        <div class="flex flex-col mb-4 text-center">
                                            <div style="display: flex; align-items: center;">
                                                <span class="form-control numeros_campos">1</span>
                                                <input title="Marca" id="marca-otro"
                                                    style="border-color: var(--bs-dark-border-subtle); border-radius: 0 .375rem .375rem 0;"
                                                    class="form-control text-center hide" value="{{ old('marca') }}"
                                                    placeholder="*Otra Marca" autofocus>
                                                <select name="marca" id="marca"
                                                    class="form-control text-center"
                                                    style="color: var(--bs-secondary-color); border-color: var(--bs-dark-border-subtle); border-radius: 0 .375rem .375rem 0;"
                                                    required>
                                                    <option value="" disabled selected>*Marca del vehiculo
                                                    </option>
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

                                            @error('marca')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col mb-4 text-center">
                                            <div style="display: flex; align-items: center;">
                                                <span class="form-control numeros_campos">2</span>
                                                <input type="text" name="referencia" id="referencia"
                                                    class="form-control text-center"
                                                    style="border-color: var(--bs-dark-border-subtle); border-radius: 0 .375rem .375rem 0;"
                                                    placeholder="*Referencia del vehiculo (Ej. Joy)"
                                                    aria-label="Referencia" value="{{ old('referencia') }}" required>
                                            </div>
                                            @error('referencia')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col mb-4 text-center">

                                            <div style="display: flex; align-items: center;">
                                                <span class="form-control numeros_campos">3</span>
                                                <select id="modelo" name="modelo"
                                                    class="form-control text-center"
                                                    style="color: var(--bs-secondary-color); border-color: var(--bs-dark-border-subtle); border-radius: 0 .375rem .375rem 0;"
                                                    required>
                                                    <option value='' disabled selected>*Modelo del vehiculo (Año)
                                                    </option>
                                                    <?php
                                                    $anioActual = date('Y');
                                                    for ($modelo = $anioActual + 1; $modelo >= 1950; $modelo--) {
                                                        echo "<option value=\"$modelo\">$modelo</option>";
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                            @error('modelo')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col mb-4 text-center">
                                            <div style="display: flex; align-items: center;">
                                                <span class="form-control numeros_campos">4</span>
                                                <select class="form-control" name="tipo" id="tipo"
                                                    name="tipo"
                                                    style="color: var(--bs-secondary-color); text-align: center; border-color: var(--bs-dark-border-subtle); border-radius: 0 .375rem .375rem 0;"
                                                    required>
                                                    <option value="" disabled selected>*Tipo de transmisión
                                                        (Caja)
                                                    </option>
                                                    <option value="mecánica">Mecánica (Manual)</option>
                                                    <option value="automatica">Automática</option>
                                                </select>
                                            </div>

                                            @error('tipo')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <?php
                                        // $repuestos = [
                                        //     'Llantas' => ['Llantas', 'Llantas delanteras', 'Llantas traseras', 'Llantas de repuesto', 'Llantas de invierno', 'Llantas de verano', 'Llantas deportivas', 'Llantas de alta resistencia', 'Llantas de bajo perfil'],
                                        //     'Neumáticos' => ['Neumáticos', 'Neumáticos delanteros', 'Neumáticos traseros', 'Neumáticos de repuesto', 'Neumáticos de invierno', 'Neumáticos de verano', 'Neumáticos deportivos', 'Neumáticos de alta resistencia', 'Neumáticos de bajo perfil'],
                                        //     'Frenos' => ['Pastillas de freno delanteras', 'Pastillas de freno traseras', 'Discos de freno delanteros', 'Discos de freno traseros', 'Tambores de freno traseros', 'Bomba de freno', 'Servofreno'],
                                        //     'Suspensiones' => ['Amortiguadores delanteros', 'Amortiguadores traseros', 'Resortes delanteros', 'Resortes traseros', 'Barra estabilizadora delantera', 'Barra estabilizadora trasera', 'Bieletas'],
                                        //     'Direccion' => ['Cremallera de dirección', 'Mangueras de dirección', 'Bomba de dirección', 'Terminales de dirección', 'Juntas homocinéticas'],
                                        //     'Motor' => ['Filtros de aceite', 'Filtros de aire', 'Filtros de combustible', 'Bujías', 'Bobinas de encendido', 'Correas de distribución', 'Bomba de agua', 'Bomba de aceite', 'Turbocompresor', 'Alternador', 'Arrancador'],
                                        //     'Transmisión' => ['Aceite de transmisión', 'Filtro de transmisión', 'Embrague', 'Caja de cambios manual', 'Caja de cambios automática'],
                                        //     'Tren motriz' => ['Juntas homocinéticas', 'Diferencial', 'Semiejes'],
                                        //     'Chasis' => ['Puertas', 'Ventanas', 'Espejos retrovisores', 'Parachoques', 'Capó', 'Maletero', 'Faros', 'Luces traseras', 'Señales de giro', 'Defensa', 'Placa de matrícula'],
                                        //     'Electricidad' => ['Baterías', 'Faros', 'Luces traseras', 'Señales de giro', 'Limpiaparabrisas', 'Limpiaparabrisas traseros', 'A/C', 'Calefacción', 'Radio', 'Altavoces', 'Sistema de navegación'],
                                        //     'Otros' => ['Líquido de frenos', 'Líquido refrigerante', 'Líquido de dirección asistida', 'Líquido de transmisión', 'Limpiador de parabrisas', 'Anticongelante', 'Aceite de motor', 'Aditivos'],
                                        // ];

                                        // // Convierte a opciones
                                        // $options = [];
                                        // foreach ($repuestos as $categoria => $items) {
                                        //     foreach ($items as $item) {
                                        //         $options[] = "<option value=\"$item\"></option>";
                                        //     }
                                        // }
                                        ?>

                                        <div class="flex flex-col text-center">
                                            <div style="display: flex; align-items: center;">
                                                <span class="form-control numeros_campos"
                                                    style="height: 5rem; display: flex; align-items: center;">5</span>
                                                <input name="repuesto" id="repuesto"
                                                    style="height: 5rem; border-radius: 0.375rem 0.375rem 0 0.375rem; border-color: var(--bs-dark-border-subtle); border-radius: 0 .375rem .375rem 0;"
                                                    class="form-control text-center"
                                                    placeholder="*Agrega uno a uno tus repuestos"
                                                    aria-label="Repuesto" value="{{ old('repuesto') }}">
                                                {{-- <datalist id="lista_repuestos">

                                                    <?php
                                                    //echo implode("\n", $options);
                                                    ?>

                                                </datalist> --}}
                                            </div>
                                        </div>

                                        <div style="display: flex; justify-content: flex-end; width: 100%;">
                                            <button type="button" name="agregar_repuesto" id="agregar_repuesto"
                                                class="btn btn-primary mb-3"
                                                style="transform: translate(-1.5%, 0); transition: all 300ms ease; border-radius: 0 0 .50rem .50rem !important;">
                                                Agregar
                                            </button>
                                        </div>

                                        <div class="text-ejemplo-for-repuestos w-100 text-center mb-4" class="hide">
                                            <small class="text-xs text-secondary">Ejemplo: 3 Bujías</small>
                                        </div>

                                        <div class="flex flex-col">
                                            <div id="campo_repuestos">
                                                <div id="items_container" class="items_container form-control"
                                                    style="border-color: var(--bs-dark-border-subtle);">
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
                                                <small class="text-xs mb-4 text-secondary">Máximo 5 repuestos</small>
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

                                        <div class="flex flex-col mb-3 text-center">
                                            <label id="btn" class="button form-control" for="img_repuesto"
                                                style="margin: 0; cursor: pointer; color: var(--bs-secondary-color); border-color: var(--bs-dark-border-subtle);">
                                                Sube imágen(es) de repuesto(s) (Opcional)
                                            </label>
                                            <input type="file" accept="image/*" name="img_repuesto[]"
                                                id="img_repuesto" class="form-control text-center"
                                                aria-label="img_repuesto" style="display: none;" multiple>
                                            @error('img_repuesto')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @else
                                                <small class="text-primary tex-xs pt-1">Máximo ( 3 ) imágenes del repuesto;
                                                    formato
                                                    png/jpg/jpeg.</small>
                                            @enderror
                                        </div>
                                    </fieldset>

                                    <div
                                        style="width:100%; height: max-content; display: flex; justify-content: flex-end;">
                                        <button id="btn_siguiente" type="button" class="btn btn-primary"
                                            onclick="validateForm1()">Siguiente</button>
                                    </div>

                                </div>

                                <!-- Parte 2 del formulario -->
                                <div class="tab-pane fade" id="tab-content2" style="transition: all 300ms ease;">

                                    <fieldset class="form-group">
                                        <legend class="text-center" style="display: flex; justify-content: center;">
                                            <h5
                                                style="background: var(--color-primary);
                                                    color: white;
                                                    width: max-content;
                                                    padding: .3rem 1.5rem;
                                                    border-radius: 0 0 1rem 1rem;
                                                    font-weight: 600;">
                                                Datos personales</h5>
                                        </legend>
                                        <div class="flex flex-col mb-4 text-center">
                                            <div style="display: flex; align-items: center;">
                                                <span class="form-control numeros_campos">1</span>
                                                <input type="text" class="form-control text-center" id="nombre"
                                                    name="nombre" placeholder="*Nombre"
                                                    style="border-color: var(--bs-dark-border-subtle); border-radius: 0 .375rem .375rem 0;"
                                                    aria-label="Nombre" value="{{ old('nombre') }}" required>
                                            </div>

                                            @error('nombre')
                                                <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="group">
                                            <div class="flex flex-col mb-4 text-center">
                                                <div
                                                    style="display: flex; justify-content: space-between; align-items: center; padding: 0; margin-bottom: .3rem;">
                                                    <div style="display: flex; align-items: center; width: 100%;">
                                                        <span class="form-control numeros_campos">2</span>
                                                        <select name="codigo_cel" id="codigo-cel"
                                                            style="border: none; transform: translate(2.3rem, 0px); position: absolute;">
                                                            @foreach ($codigos as $codigo)
                                                                <option value="{{ $codigo->codigo }}"
                                                                    title="{{ $codigo->pais }}">
                                                                    {{ $codigo->iso . ' ' . $codigo->codigo }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="text" class="text-center form-control"
                                                            id="cel" name="cel"
                                                            placeholder="*Número de celular" aria-label='Cel'
                                                            value="{{ old('cel') }}"
                                                            style="width: 100%; border-color: var(--bs-dark-border-subtle); border-radius: 0 .375rem .375rem 0;"
                                                            required>
                                                    </div>

                                                </div>
                                                @error('cel')
                                                    <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                                @else
                                                    <small class="text-xs text-color-secondary">¡Debe tener Whatsapp! <i
                                                            class="fa fa-whatsapp" aria-hidden="true"
                                                            style="color: #25D366; font-size: 15px; transform: translate(0px, 2.4px);">
                                                        </i></small>
                                                @enderror
                                            </div>

                                            <div id="pais" class="flex flex-col mb-4 text-center hide">
                                                <div class="form-control"
                                                    style="border-color: var(--bs-dark-border-subtle);">
                                                    <span id="text-pais"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-col mb-4 text-center">
                                            <div style="display: flex; align-items: center;">
                                                <span class="form-control numeros_campos">3</span>
                                                <input type="email" class="form-control text-center" id="email"
                                                    name="email" placeholder="E-mail"
                                                    style="border-color: var(--bs-dark-border-subtle); border-radius: 0 .375rem .375rem 0;"
                                                    aria-label="Email" value="{{ old('email') }}">
                                            </div>

                                            @error('email')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col mb-4 text-center" id="contenedor_departamento">
                                            <div style="display: flex; align-items: center;">
                                                <span class="form-control numeros_campos"
                                                    id="numero_campo_departamento">4</span>
                                                <select id="departamento" name="departamento"
                                                    class="form-control text-center"
                                                    style="color: var(--bs-secondary-color); border-color: var(--bs-dark-border-subtle); border-radius: 0 .375rem .375rem 0;">
                                                    <option value="" disabled selected>*Departamento</option>
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

                                        <div class="flex flex-col mb-4 text-center" id="contenedor_municipio">
                                            <div style="display: flex; align-items: center;">
                                                <span class="form-control numeros_campos"
                                                    id="numero_campo_municipio">5</span>
                                                <select name="municipio" id="municipio"
                                                    class="form-control text-center"
                                                    style="color: var(--bs-secondary-color); border-color: var(--bs-dark-border-subtle); border-radius: 0 .375rem .375rem 0;">
                                                    <option value="" disabled selected>*Municipio</option>
                                                </select>
                                            </div>

                                            @error('municipio')
                                                <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col mb-4 text-center">
                                            <div style="display: flex; align-items: center;">
                                                <textarea name="comentario" id="comentario" class="form-control text-center"
                                                    style="border-color: var(--bs-dark-border-subtle);" placeholder="¿Tienes algun comentario?"
                                                    aria-label="Comentario" rows="5">{{ old('comentario') }}</textarea>
                                            </div>

                                            @error('comentario')
                                                <div class='text-danger text-xs pt-1'> {{ $message }} </div>
                                            @enderror
                                        </div>

                                    </fieldset>
                                    {{-- <div class="text-center">
                                        <button id="btn_modal_client" type="submit" class="btn btn-primary w-100 my-4 mb-2">Enviar</button>
                                    </div> --}}

                                    <div
                                        style="width:100%; height: max-content; display: flex; justify-content: flex-end; gap: 5px;">
                                        <button type="button" class="btn btn-secondary"
                                            onclick="changeTab2()">Anterior</button>
                                        <button id="btn_submit" type="submit" class="btn btn-primary"
                                            onclick="validateForm2()">Enviar</button>
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
                let btn_agregar = document.getElementById('agregar_repuesto');
                let campo_repuestos = document.getElementById('campo_repuestos');
                let container = document.getElementById('items_container');
                let text_maximo_repuestos = document.getElementById('text-maximo-repuestos');

                // Inicializar elementos ocultos
                campo_repuestos.classList.add('hide');
                btn_agregar.classList.add('hide');
                text_maximo_repuestos.classList.add('hide');

                // Intentar recuperar los repuestos seleccionados del localStorage
                let seleccionados = JSON.parse(localStorage.getItem('seleccionados')) || {};

                // Función para agregar un botón
                function agregarBoton(item) {
                    let button = document.createElement('button');
                    button.classList.add('item_selected');
                    button.setAttribute('name', 'item');
                    button.innerHTML = item + '<span class="btn_borrar_item">×</span>';

                    // Agregar un evento de escucha de clics al botón
                    button.addEventListener('click', function() {
                        // Eliminar el botón del contenedor
                        container.removeChild(button);

                        // Eliminar la opción del objeto seleccionados
                        delete seleccionados[item];

                        // Guardar las repuestos seleccionadas en el localStorage
                        localStorage.setItem('seleccionados', JSON.stringify(seleccionados));

                        if (container.children.length === 1) {
                            campo_repuestos.classList.add('hide');
                            text_maximo_repuestos.classList.add('hide');
                            btn_agregar.classList.add('hide');
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

                // Escuchar el evento clic en el campo de repuestos
                campo_repuesto.addEventListener('click', function() {
                    btn_agregar.classList.remove('hide');
                });

                // Escuchar el evento clic en el botón de agregar
                btn_agregar.addEventListener('click', function() {
                    let item = campo_repuesto.value;
                    let btnSig = document.getElementById('btn_siguiente');
                    campo_repuesto.value = "";

                    if (item !== "") {
                        if (container.children.length < 6) {
                            if (!seleccionados[item]) {
                                agregarBoton(item);
                                campo_repuestos.classList.remove('hide');
                                text_maximo_repuestos.classList.remove('hide');
                            }
                        } else {
                            alert('Ya has agregado un máximo de 5 repuestos.');
                            return; // Salir de la función para evitar ejecutar el código adicional
                        }
                    }

                    if (container.children.length > 1) {
                        campo_repuesto.setCustomValidity('');
                    } else {
                        campo_repuesto.setCustomValidity('No has agregado ningún repuesto');
                    }
                });

                // Ocultar elementos si no hay repuestos seleccionadas
                if (container.children.length === 1) {
                    campo_repuestos.classList.add('hide');
                    text_maximo_repuestos.classList.add('hide');
                    btn_agregar.classList.add('hide');
                    campo_repuesto.setCustomValidity('No has agregado ningún repuesto');
                }

                // Escuchar el evento de envío del formulario
                document.getElementById('form_client').addEventListener('submit', function(event) {
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

                    // Ahora, puedes enviar el formulario
                    this.submit();
                });

            });
        </script>
        {{--
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let categoria = document.getElementById('categoria_repuesto');
                let container = document.getElementById('items_container_categorias');
                let categorias_preferencias = document.getElementById('categorias_preferencias');
                let btnSig = document.getElementById('btn_siguiente');
                categorias_preferencias.classList.add('hide');

                // Intentar recuperar las categorias seleccionadas del localStorage
                let categoriaSeleccionados = JSON.parse(localStorage.getItem('categoriaSeleccionados')) || {};

                // Función para agregar un botón
                function agregarBoton(item_category) {
                    let button = document.createElement('button');
                    button.classList.add('item_selected');
                    button.setAttribute('name', 'item_category');
                    button.textContent = item_category;

                    // Agregar un evento de escucha de clics al botón
                    button.addEventListener('click', function() {
                        // Eliminar el botón del contenedor
                        container.removeChild(button);

                        // Eliminar la opción del objeto seleccionados
                        delete categoriaSeleccionados[item_category];

                        // Guardar las categorias seleccionadas en el localStorage
                        localStorage.setItem('categoriaSeleccionados', JSON.stringify(categoriaSeleccionados));

                        if (container.children.length > 0 && container.children.length > 0) {
                            btnSig.removeAttribute('disabled');
                        } else {
                            btnSig.setAttribute('disabled', true);
                        }

                        if (Object.keys(categoriaSeleccionados).length === 0) {
                            categoria.setAttribute('required', true);
                        }

                        if (container.children.length === 0) {
                            categorias_preferencias.classList.add('hide');
                            categoria.setAttribute('required', true);
                        }
                    });

                    container.appendChild(button);

                    // Marcar la opción como seleccionada
                    categoriaSeleccionados[item_category] = true;

                    // Guardar las categorias seleccionadas en el localStorage
                    localStorage.setItem('categoriaSeleccionados', JSON.stringify(categoriaSeleccionados));
                }

                // Si hay categorias seleccionadas, recrear los botones
                if (Object.keys(categoriaSeleccionados).length > 0) {
                    categorias_preferencias.classList.remove('hide');
                    categoria.removeAttribute('required');
                    for (let item_category in categoriaSeleccionados) {
                        agregarBoton(item_category);
                    }
                }

                categoria.addEventListener('change', function() {
                    let item_category = categoria.value;
                    if (item_category !== "") {
                        if (!categoriaSeleccionados[item_category]) {
                            agregarBoton(item_category);
                            categorias_preferencias.classList.remove('hide');
                            categoria.removeAttribute('required');
                        }
                    }
                    if (container.children.length > 0 && container.children.length > 0) {
                        btnSig.removeAttribute('disabled');
                    } else {
                        btnSig.setAttribute('disabled', true);
                    }
                });

                if (Object.keys(categoriaSeleccionados).length === 0) {
                    categoria.setAttribute('required', true);
                } else {
                    categoria.removeAttribute('required');
                }

                document.getElementById('form_client').addEventListener('submit', function(event) {
                    event.preventDefault(); // Evitar el envío del formulario para manejarlo manualmente

                    // Obtener los textos de los botones en un arreglo
                    let textosSeleccionados = Object.keys(categoriaSeleccionados);

                    // Convertir el arreglo a una cadena JSON
                    let jsonTextosSeleccionados = JSON.stringify(textosSeleccionados);

                    // Agregar un campo oculto al formulario y asignarle la cadena JSON
                    let inputJson = document.createElement('input');
                    inputJson.type = 'hidden';
                    inputJson.name = 'json_categorias';
                    inputJson.value = jsonTextosSeleccionados.replace(/×/g, '').replace(/\n/g, '');
                    this.appendChild(inputJson);

                    // Limpiar los datos en localStorage después de enviar el formulario
                    localStorage.removeItem('categoriaSeleccionados');

                    // Ahora, puedes enviar el formulario
                    this.submit();
                });
            });
        </script> --}}

        <script>
            //Tabs
            let tabId1 = document.getElementById('tab-content1');
            let tabId2 = document.getElementById('tab-content2');
            let tab1 = document.getElementById('tab1');
            let tab2 = document.getElementById('tab2');

            //Campos parte 2
            let campo_nombre = document.getElementById('nombre');
            let campo_cel = document.getElementById('cel');
            let campo_departamento = document.getElementById('departamento');
            let campo_municipio = document.getElementById('municipio');

            function changeTab1() {
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
            }

            function changeTab2() {
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
            }

            function validateForm1() {
                campo_nombre.removeAttribute('required');
                campo_cel.setCustomValidity("");
                campo_cel.removeAttribute("required");
                campo_departamento.removeAttribute('required');
                campo_municipio.removeAttribute('required');

                let form = document.getElementById('form_client');
                if (!form.reportValidity()) {
                    return;
                }

                // Cambiar a la siguiente pestaña solo si todos los campos son válidos
                changeTab1();
            }

            function validateForm2() {
                campo_nombre.setAttribute('required', true);
                campo_cel.setAttribute("required", true);

                let form = document.getElementById('form_client');
                if (!form.reportValidity()) {
                    return;
                }
            }

            // campo_marca.addEventListener('change', validar_datos_1);
            // campo_referencia.addEventListener('change', validar_datos_1);
            // campo_modelo.addEventListener('change', validar_datos_1);
            // campo_caja.addEventListener('change', validar_datos_1);
            // campo_repuestos.addEventListener('change', validar_datos_1);
            // // campo_categorias.addEventListener('change', validar_datos_1);

            // campo_nombre.addEventListener('change', validar_datos_2);
            // campo_cel.addEventListener('change', validar_datos_2);
            // campo_departamento.addEventListener('change', validar_datos_2);
            // campo_municipio.addEventListener('change', validar_datos_2);

            // validar_datos_1();
            // validar_datos_2();

            changeTab2();
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
                let numero_dep = document.getElementById('numero_campo_departamento');
                let container_muni = document.getElementById('contenedor_municipio');
                let municipio = document.getElementById('municipio');
                let numero_muni = document.getElementById('numero_campo_municipio');

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
                        cel.value = cel.value.slice(0, 10);
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

                    if (codigo.value == '+54') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');

                        if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Argentina';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+591') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');


                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Bolivia';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+55') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');

                        if (isNaN(cel.value) || cel.value.length != 11) {
                            cel.setCustomValidity("El número de celular debe tener 11 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Brasil';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+56') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');

                        if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Chile';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+593') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Ecuador';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+594') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Guayana Francesa';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+592') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 7) {
                            cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Guyana';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+595') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        textPais.textContent = 'Paraguay';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+51') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        textPais.textContent = 'Perú';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+597') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 7) {
                            cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Surinam';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+598') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Uruguay';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+58') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Venezuela';

                        // Elimina el atributo 'required'
                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
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
                        numero_dep.classList.remove('hide');
                        numero_muni.classList.remove('hide');
                        container_dep.classList.remove('hide');
                        container_muni.classList.remove('hide');
                    } else if (codigo.value == '+1') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Estados Unidos';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+506') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Costa Rica';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+503') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'El Salvador';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+502') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Guatemala';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+504') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        textPais.textContent = 'Honduras';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+52') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'México';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+505') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Nicaragua';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
                    } else if (codigo.value == '+507') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        textPais.textContent = 'Panamá';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                        numero_dep.classList.add('hide');
                        numero_muni.classList.add('hide');
                        container_dep.classList.add('hide');
                        container_muni.classList.add('hide');
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
