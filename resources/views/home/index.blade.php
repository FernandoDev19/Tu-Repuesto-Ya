@extends('layouts.base')
<link rel="stylesheet" type="text/css" href="../css/home/styles_for_servicios.css">
@section('title', 'inicio | Tu Respuesto Ya')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div id="overlay" class="overlay" style="display:flex; flex-direction:column;">
        <div class="loader"></div>
        <div style="margin-top: 10px; color: white; font-size:15px;"><small>Cargando...</small></div>
    </div>
    <!-- ................................................................................................. -->
    <div class="container-sections">
        <section data-aos="zoom-in" data-aos-duration="700" id="sesion-de-contacto-por-whatsapp">
            <div class="container-flex container-flex-col-cel">
                <article id="container-text">
                    <div class="text-center">
                        <h1 style="margin-bottom: 10px;">AHORRA <span class="typed"></span></h1>
                        <p class="text-color-primary">
                            <span class="none">OLVÍDATE DE IR A BUSCAR</span> <br>
                            TUS
                            REPUESTOS</p>
                            <div class="flex-j-center-cel w-100">
                            <a title="Crear solicitud de repuesto" id="WSP" href="#" data-toggle="modal"
                                data-target="#clienteModal">
                                <span class="none">¡Busca aquí!</span> <span class="none-pc">¡Buscalos aquí!</span> 
                                <i class="fa fa-search" style="font-size: 40px;" aria-hidden="true"></i>
                                </a>
                        </div>
                        <p id="parrafo-3-sesion-de-contacto-por-whatsapp" style="width: 100%;">
                            Nosotros enviaremos tu solicitud <br> a 500 almacenes.

                            Recibirás <br> las 5 mejores Cotizaciones 🏆
                        </p>
                    </div>
                </article>
                <div id="container-img">
                    <img src="{{asset('img/App.png')}}"
                        alt="celular" width="736">
                </div>
            </div>
        </section>

        <section data-aos="fade-right" data-aos-duration="700" id="sesion-de-marcas-y-cotizaciones">
            <div id="article_marcas">
                <div class="row align-items-center" style="width: 100%;">
                    <div class="col-md-14" style="padding: 0;">
                        <div id="text">
                            <p><span class="font_size_article_marcas2">REPUESTOS DISPONIBLES PARA TODO TIPO DE
                                    CARROS</span></p>
                        </div>
                    </div>
                </div>
                <div class="swiper content_marcas">
                    <div class="swiper-wrapper">
                        <div class="logo_marca swiper-slide">
                            <img title="kia" src="{{ asset('icon/iconos_marcas/kia.webp') }}" alt="logo_kia"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="hyundai" src="{{ asset('icon/iconos_marcas/hyundai.webp') }}" alt="logo_hyundai"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="nissan" src="{{ asset('icon/iconos_marcas/nissan.webp') }}" alt="logo_nissan"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="volkswagen" src="{{ asset('icon/iconos_marcas/volkswagen.webp') }}"
                                alt="logo_volkswagen" decoding="async">
                        </div>
                        <div id="logo_marca_audi" class="logo_marca swiper-slide">
                            <img title="audi" src="{{ asset('icon/iconos_marcas/audi-logo.png') }}" alt="logo-audi"
                                decoding="async">
                        </div>
                        <div id="logo_marca_bmw" class="swiper-slide">
                            <img title="bmw" src="{{ asset('icon/iconos_marcas/bmw-logo.png') }}" alt="logo_bmw"
                                decoding="async">
                        </div>
                        <div id="logo_marca_f" class="swiper-slide">
                            <img title="ferrari" src="{{ asset('icon/iconos_marcas/Ferrari_logo.png') }}"
                                alt="logo_ferrari" decoding="async">
                        </div>
                        <div id="logo_marca_jaguar" class="swiper-slide">
                            <img title="jaguar" src="{{ asset('icon/iconos_marcas/jaguar-logo.webp') }}"
                                alt="logo_jaguar" decoding="async">
                        </div>
                        <div id="logo_marca_lambo" class="swiper-slide">
                            <img title="lamborghini" src="{{ asset('icon/iconos_marcas/lamborghini-logo.png') }}"
                                alt="logo_lambo" decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="rolls-royce" src="{{ asset('icon/iconos_marcas/rolls-royce-logo.png') }}"
                                alt="logo_rolls-royce" decoding="async">
                        </div>
                        <div id="logo_marca_suba" class="swiper-slide">
                            <img title="subaru" src="{{ asset('icon/iconos_marcas/subaru-icon.jpeg') }}" alt="logo_subaru"
                                decoding="async">
                        </div>
                        <div id="logo_marca_susu" class="swiper-slide">
                            <img title="suzuki" src="{{ asset('icon/iconos_marcas/suzuki-logo.webp') }}" alt="logo_susuki"
                                decoding="async">
                        </div>
                        <div id="logo_marca_volvo" class="swiper-slide">
                            <img title="volvo" src="{{ asset('icon/iconos_marcas/volvo-logo.webp') }}" alt="logo_volvo"
                                decoding="async">
                        </div>
                        <!--<div id="logo_marca_kawa" class="swiper-slide">
                            <img title="kawasaki" src="{{ asset('icon/iconos_marcas/Kawasaki-Logo.png') }}"
                                alt="logo_kawasaki" decoding="async">
                        </div>-->
                        <div class="logo_marca swiper-slide">
                            <img title="renault" src="{{ asset('icon/iconos_marcas/renault.webp') }}" alt="logo_renault"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="ford" src="{{ asset('icon/iconos_marcas/ford.webp') }}" alt="logo_ford"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="honda" src="{{ asset('icon/iconos_marcas/honda.webp') }}" alt="logo_honda"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="mazda" src="{{ asset('icon/iconos_marcas/mazda.webp') }}" alt="logo_mazda"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="toyota" src="{{ asset('icon/iconos_marcas/toyota.webp') }}" alt="logo_toyota"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="ssangyong" src="{{ asset('icon/iconos_marcas/ssangyong.png') }}" alt="logo_ssangyong"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="chevrolet" src="{{ asset('icon/iconos_marcas/chevrolet.png') }}" alt="logo_chevrolet"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="mercedes" src="{{ asset('icon/iconos_marcas/mercedes.png') }}" alt="logo_mercedes"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="foton" src="{{ asset('icon/iconos_marcas/foton.png') }}" alt="logo_foton"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="kenworth" src="{{ asset('icon/iconos_marcas/kenworth.png') }}" alt="logo_kenworth"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="byd" src="{{ asset('icon/iconos_marcas/byd.png') }}" alt="logo_byd"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="dfsk" src="{{ asset('icon/iconos_marcas/dfsk.png') }}" alt="logo_dfsk"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="dodge" src="{{ asset('icon/iconos_marcas/dodge.png') }}" alt="logo_dodge"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="mitsubishi" src="{{ asset('icon/iconos_marcas/mitsubishi.png') }}" alt="logo_mitsubishi"
                                decoding="async">
                        </div>
                        <!--<div class="logo_marca swiper-slide">
                            <img title="yamaha" src="{{ asset('icon/iconos_marcas/yamaha.png') }}" alt="logo_yamaha"
                                decoding="async">
                        </div>-->
                        <!--<div class="logo_marca swiper-slide">
                            <img title="auteco" src="{{ asset('icon/iconos_marcas/auteco.png') }}" alt="logo_auteco"
                                decoding="async">
                        </div>-->
                        <div class="logo_marca swiper-slide">
                            <img title="jeep" src="{{ asset('icon/iconos_marcas/jeep.png') }}" alt="logo_jeep"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide">
                            <img title="peugeot" src="{{ asset('icon/iconos_marcas/peugeot.png') }}" alt="logo_peugeot"
                                decoding="async">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="sesion-de-inf-de-solicitud-de-repuestos" data-aos="fade-right" data-aos-duration="700">
            <div class="container-flex">
                <div class="w-50" id="container-text-cuentanos">
                    <h1>1. CUENTANOS:</h1>
                    <div id="container-list-cuentanos">
                        <ul id="list-cuentanos">
                            <li style='display: flex;'><i class="check-list-sesion-de-marcas-y-cotizaciones fas fa-check-circle"
                                    style="margin-right: 2%; padding-top: 1.5%;"> </i> La Marca de tu carro</li>
                                    
                            <li style='display: flex;'><i class="check-list-sesion-de-marcas-y-cotizaciones fas fa-check-circle"
                                    style="margin-right: 2%; padding-top: 1.5%;"> </i> Modelo (Año)</li>
                                    
                            <li style='display: flex;'><i class="check-list-sesion-de-marcas-y-cotizaciones fas fa-check-circle"
                                    style="margin-right: 2%; padding-top: 1.5%;"> </i> Referencia o línea como aparece en la tarjeta de
                                propiedad</li>
                                
                            <li style='display: flex;'><i class="check-list-sesion-de-marcas-y-cotizaciones fas fa-check-circle"
                                    style="margin-right: 2%; padding-top: 1.5%;"> </i> Describe tu repuesto</li>
                                    
                            <li style='display: flex;'><i class="check-list-sesion-de-marcas-y-cotizaciones fas fa-check-circle"
                                    style="margin-right: 2%; padding-top: 1.5%;"> </i> Agrega fotos del repuesto (opcional)</li>
                        </ul>
                    </div>
                </div>

                <div class="w-40" id="container-img-cuentanos">
                    <img src="{{asset('img/img-carro.png')}}"
                        alt="carro" width="736">
                </div>
            </div>
        </section>

        <div class="separator" style="width:100%; padding: 0 5%;">
            <hr>
        </div>

        <section id="sesion-de-envio-de-requerimientos" data-aos="fade-right" data-aos-duration="700">
            <div class="container-flex">
                <div class="w-40" id="container-img-envia-tu-requerimiento">
                    <img src="{{asset('img/img-correo.png')}}"
                        alt="correo" width="736">
                </div>
                <div class="w-50" id="container-text-envia-tu-requerimiento">
                    <h1>2. ENVÍA TU <br> REQUERIMIENTO:</h1>

                    <p>Los almacenes afiliados del pais recibirán
                        tu solicitud y en menos de 24 horas
                        TU REPUESTO YA te enviará las 5 mejores
                        cotizaciones.</p>

                    <div class="container-btn-solicitud-cel w-100">
                        <a title="Crear solicitud de repuesto" id="WSP" href="#" data-toggle="modal"
                        data-target="#clienteModal" style="margin-bottom: 0;">
                        ¡Busca aquí! 
                        <i class="fa fa-search" style="font-size: 40px;" aria-hidden="true"></i></a>

                    </div>        
                </div>
            </div>
        </section>

        <div class="separator" style="width:100%; padding: 0 5%;" >
            <hr>
        </div>

        <section id="sesion-de-eleccion-de-opciones" data-aos="fade-right" data-aos-duration="700">
            <div class="container-flex">
                <div class="w-50" id="container-text-elige-tu-mejor-opcion">
                    <h1>3. ELIGE TU MEJOR OPCION:</h1>

                    <p>Ponte de acuerdo con el establecimiento <br>
                        para el pago y el envío.</p>
                </div>
                <div class="w-40" id="container-img-elige-tu-mejor-opcion">
                    <img src="{{asset('img/cel-mano.png')}}"
                        alt="cel-mano" width="736">
                </div>
            </div>
        </section>

        <div class="separator" style="width:100%; padding: 0 5%;">
            <hr>
        </div>

    </div>

    <footer id="sesion-de-busqueda-de-productos-diferentes" data-aos="zoom-in" data-aos-duration="600">
        <div class="container-flex-col">
            <div id="container-text-header-busqueda-de-productos-diferentes">
                <h1 style="text-align: center;">¿BUSCAS ALGO DIFERENTE A REPUESTOS?</h1>
                <div class="footer-sesion-de-contacto-por-whatsapp w-100">
                    <a style="width: 300px; height: 70px; background-color: #25D366; margin-top: 4% !important; margin-bottom: 0;" title="Crear solicitud de repuesto" id="WSP" href="https://api.whatsapp.com/send?phone=+573249216736&text=%2A%C2%A1Hola%21%2A%20%E2%9C%8B%20Vengo%20de%20la%20p%C3%A1gina%20web%20de%20%2ATu%20Repuesto%20Ya%2A%20Estoy%20buscando%20lo%20siguiente%3A">
                        ¡Busca aquí! 
                        <i class="fa fa-whatsapp" style="font-size: 40px;" aria-hidden="true"></i>

                    </a>
                </div>
            </div>
            <div id="container-text-body-busqueda-de-productos-diferentes">
                <p><span style="font-weight: 700;">Cuentale a tus amigos</span><br>y por cada compra de tus referidos,<br>gánate un obsequio</p>
                <div id="container-img-busqueda-de-productos-diferentes">
                    <img class="icon_chat" id='icon_chat' src="{{ asset('img/img-megafono.png') }}" alt="megafono">
                </div>
            </div>
        </div>
    </footer>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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

        <!-- Botón whatsapp -->
    <!--<a href="https://api.whatsapp.com/send?phone=573249216736&text=%2A%C2%A1Hola%21%2A%20%E2%9C%8B%20Vengo%20de%20la%20p%C3%A1gina%20web%20de%20%2ATu%20Repuesto%20Ya%2A%20Me%20gustar%C3%ADa%20recibir%20cotizaciones%20sobre%20un%20repuesto%20que%20necesito." id="btn_whatsapp_kommo"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>-->

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
