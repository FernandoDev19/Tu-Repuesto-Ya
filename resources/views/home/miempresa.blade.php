@extends('layouts.base')
<link rel="stylesheet" type="text/css" href="{{ asset('css/home/styles_for_miempresa.css') }}">
@section('title', 'MI EMPRESA - Tu Respuesto Ya')
@section('content')


    @if (session('message'))
        <div class="alert alert-info" id="registration-message">
            {{ session('message') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="error">
            {{ session('error') }}
        </div>
    @endif

    <div id="overlay" class="overlay" style="display:flex; flex-direction:column;">
        <div class="loader"></div>
        <div style="margin-top: 10px; color: white; font-size:15px;"><small>Cargando...</small></div>
    </div>

    <nav id="nav" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div id="void1">
            </div>
            <a title="Inicio" class="navbar-brand" href="{{ asset(route('servicios')) }}"><img decoding="async"
                    id="logo" src="{{ asset('img/logo tu repuesto ya/logo tu repuesto.png') }}"
                    alt="Logo_TuRepuestoYa"></a>
            <div id="void2"> </div>
            <button class="navbar-toggler btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon ico-btn"></span>
            </button>
            <div class="collapse navbar-collapse container-op" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto" style="align-items: center">

                    <div class="container_nav" id="Cnav1">
                        <li class="nav-item">
                            <a class="nav-link nav_e1" aria-current="page"
                                href="{{ asset(route('servicios')) }}">SERVICIOS</a>
                        </li>
                    </div>

                    <div class="container_nav" id="Cnav2">
                        <li class="nav-item">
                            <p class="nav-link active" id="nav_e">MI EMPRESA</p>
                        </li>
                        <div class="animate__animated animate__fadeInUp animate__delay-0s animate__faster nav_active"></div>
                    </div>

                    <div class="container_nav" id="Cnav3">
                        <li class="nav-item">
                            <a class="nav-link nav_e1" href="{{ asset(route('proveedor')) }}">PROVEEDOR</a>
                        </li>
                    </div>

                    <div class="container_nav container_flex container_flex_user">
                        @guest
                            <li class="nav-item">
                                <a class="nav_link nav_e1" href="{{ route('login') }}">
                                    <i class="fas fa-solid fa-user"></i>
                                    Iniciar sesión
                                </a>
                            </li>
                        @else
                            <li id="container_user" class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span id="nav_e2"
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $name }}</span>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu end-0 dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Administrador
                                        </a>
                                    <a class="dropdown-item" href="{{route('profile')}}">
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
                    </div>

                </ul>
            </div>
        </div>
    </nav>

    <!-- ................................................................................................. -->

    <section data-aos="zoom-in" data-aos-duration="800" id="sesion-de-contacto-por-whatsapp">
        <div id="article_wsp">
            <h1 class="t1">TU REPUESTO YA</h1>
            <br>
            <H3 class="t2">FÁCIL Y RÁPIDO</H3>
            <br>
            <a title="Crear solicitud de repuesto" id="WSP" class="animate__animated animate__pulse btn"
                href="#" data-toggle="modal" data-target="#clienteModal">
                <i class="fas fa-search" style="font-size: 40px;"></i>
                <span class="typed"></span>
            </a>
        </div>
    </section>

    <section data-aos="fade-right" data-aos-duration="800" id="sesion-de-marcas-y-cotizaciones">
        <div id="article_marcas">
            <div id="text">
                <h1>AHORRA <span class="typed2"></span></h1>
                <p style="color: rgb(215, 155, 3);"><span class="font_size_article_marcas">Olvídate de ir a buscar los
                        respuestos <br> de tu carro, moto, camión o camioneta</span></p>
                <p>Cuéntanos que repuesto necesitas, envíanos los datos y recibiras las mejores cotizaciones.</p>
            </div>

            <div class="swiper content_marcas">
                <div class="swiper-wrapper">
                    <div class="logo_marca swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/kia.webp') }}" alt="logo_kia" decoding="async">
                    </div>
                    <div class="logo_marca swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/hyundai.webp') }}" alt="logo_hyundai" decoding="async">
                    </div>
                    <div class="logo_marca swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/nissan.webp') }}" alt="logo_nissan" decoding="async">
                    </div>
                    <div class="logo_marca swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/volkswagen.webp') }}" alt="logo_volkswagen"
                            decoding="async">
                    </div>
                    <div id="logo_marca_audi" class="logo_marca swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/audi-logo.png') }}" alt="logo-audi" decoding="async">
                    </div>
                    <div id="logo_marca_bmw" class="swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/bmw-logo.png') }}" alt="logo_bmw" decoding="async">
                    </div>
                    <div id="logo_marca_f" class="swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/Ferrari_logo.png') }}" alt="logo_ferrari"
                            decoding="async">
                    </div>
                    <div id="logo_marca_jaguar" class="swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/jaguar-logo.webp') }}" alt="logo_jaguar"
                            decoding="async">
                    </div>
                    <div id="logo_marca_lambo" class="swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/lamborghini-logo.png') }}" alt="logo_lambo"
                            decoding="async">
                    </div>
                    <div class="logo_marca swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/rolls-royce-logo.png') }}" alt="logo_rr"
                            decoding="async">
                    </div>
                    <div id="logo_marca_suba" class="swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/subaru-icon.jpeg') }}" alt="logo_kia" decoding="async">
                    </div>
                    <div id="logo_marca_susu" class="swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/suzuki-logo.webp') }}" alt="logo_kia" decoding="async">
                    </div>
                    <div id="logo_marca_volvo" class="swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/volvo-logo.webp') }}" alt="logo_kia" decoding="async">
                    </div>
                    <div id="logo_marca_kawa" class="swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/Kawasaki-Logo.png') }}" alt="logo_kawasaki"
                            decoding="async">
                    </div>
                    <div class="logo_marca swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/renault.webp') }}" alt="logo_kia" decoding="async">
                    </div>
                    <div class="logo_marca swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/ford.webp') }}" alt="logo_kia" decoding="async">
                    </div>
                    <div class="logo_marca swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/honda.webp') }}" alt="logo_kia" decoding="async">
                    </div>
                    <div class="logo_marca swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/mazda.webp') }}" alt="logo_kia" decoding="async">
                    </div>
                    <div class="logo_marca swiper-slide">
                        <img src="{{ asset('icon/iconos_marcas/toyota.webp') }}" alt="logo_kia" decoding="async">
                    </div>

                </div>
            </div>

            <p><span class="font_size_article_marcas2">REPUESTOS DISPONIBLES PARA TODO TIPO DE CARROS</span></p>
        </div>
    </section>

    <section id="sesion-informativa" style="box-sizing: border-box;">
        <article data-aos="fade-right" data-aos-duration="800" id="article_que_es">
            <img id="flechas-azules" decoding="async" src="{{ asset('icon/flechas azules de.png') }}" alt="flechas">
            <h1>¿QUE ES<br><span class="amarillo">TUREPUESTOYA?</span></h1>
            <P>Somos la nueva y más completa tienda online rapida y dinamica que conecta la
                necesidad de un repuesto y accesorios que estás necesitando para tu carro o camioneta. <br>
                con los almacenes. <br>
                Navega por nuestro menú y encuentra los mejores precios.</P>
        </article>
        <article data-aos="fade-right" data-aos-duration="800" id="article_como_funciona">
            <img id="puntos" decoding="async" src="{{ asset('icon/list.png') }}" alt="tres-puntos">
            <img id="flechas-azules-de" decoding="async" src="{{ asset('icon/flechas azules iz.png') }}"
                alt="flecha-azul">
            <h1>¿COMO FUNCIONA<br><span class="azul">TUREPUESTOYA?</span></h1>
            <p>Un cliente en cualquier parte del pais, solicita un repuesto y <br>
                la plataforma se encarga de direccionar la necesidad a los <br>
                especialistas de la marca.</p>
            <img id="flechas-grises" decoding="async" src="{{ asset('icon/flecha-de-gris.png') }}" alt="flecha-gris">
        </article>
    </section>

    <section data-aos="fade-right" data-aos-duration="800" id="sesion-de-iconos" style="box-sizing: border-box;">
        <div id="section-icons">
            <div class="container_items">

                <div class="item"><img class="icon-item" decoding="async"
                        src="{{ asset('icon/carro_averiado.png') }}" alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_cambios.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_re.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_inf.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_battery.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_herr.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_lim.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_lav.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_neu.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_gas.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_part.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_mot.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_sat.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_per.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_part2.png') }}"
                        alt=""></div>

                <div class="item"><img class="icon-item" decoding="async" src="{{ asset('icon/icon_neum.png') }}"
                        alt=""></div>

            </div>
        </div>

    </section>
            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Seguro que deseas cerrar esta sesión?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Cerrar sesión</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Botón para volver arriba -->
    <button id="scrollButton" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></button>


            <!-- Enviar cierre de sesión-->
            <script>
                document.getElementById('logoutForm').addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    // You can add any additional logic here if needed

                    this.submit(); // Submit the form
                });
            </script>
    <!-- ................................................................................................. -->
@endsection
