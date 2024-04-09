<!DOCTYPE html>
@extends('layouts.base')

@section('title', 'Repuestos para Carros | Tu Repuesto Ya')

@section('content')

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
                            {{-- <span class="none">OLVÍDATE DE IR A BUSCAR TUS</span> <br> --}}
                            OLVÍDATE DE IR A BUSCAR TUS <br> REPUESTOS PARA CARROS</p>
                            <div class="flex-j-center-cel w-100">
                                <a title="Crear solicitud de repuesto" class="WSP" href="{{route('vistaFormulario')}}">
                                    <span class="none">¡Busca aquí!</span> <span class="none-pc">¡Buscalos aquí!</span>
                                    <i class="fab fa-whatsapp" style="font-size: 40px;" aria-hidden="true"></i>
                                </a>
                            </div>
                            <h6 id="parrafo-3-sesion-de-contacto-por-whatsapp" style="width: 100%;">
                                Nosotros enviaremos tu solicitud <br> a 500 almacenes.

                                Recibirás <br> las 5 mejores Cotizaciones 🏆
                            </h6>
                    </div>
                </article>
                <div id="container-img">
                    <img src="{{asset('img/turepuestoya-repuestos-para-carros.webp')}}"
                        alt="celular" width="736">
                </div>
            </div>
        </section>

        <section data-aos="fade-right" data-aos-duration="700" id="sesion-de-marcas-y-cotizaciones">
            <div id="article_marcas">
                <div class="row align-items-center" style="width: 100%;">
                    <div class="col-md-14" style="padding: 0;">
                        <div id="text">
                            <p><span class="font_size_article_marcas2">REPUESTOS PARA CARROS CON LOS MEJORES PRECIOS DEL MERCADO DE MANERA FÁCIL Y RÁPIDA</span></p>
                        </div>
                    </div>
                </div>
                <div class="swiper content_marcas">
                    <div class="swiper-wrapper">
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="kia" src="{{ asset('icon/iconos_marcas/kia.webp') }}" alt="Logo Kia"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="hyundai" src="{{ asset('icon/iconos_marcas/hyundai.webp') }}" alt="Logo Hyundai"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="nissan" src="{{ asset('icon/iconos_marcas/nissan.webp') }}" alt="Logo Nissan"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="volkswagen" src="{{ asset('icon/iconos_marcas/volkswagen.webp') }}"
                                alt="Logo Volkswagen" decoding="async">
                        </div>
                        <div id="logo_marca_audi" class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="audi" src="{{ asset('icon/iconos_marcas/audi-logo.webp') }}" alt="Logo Audi"
                                decoding="async">
                        </div>
                        <div id="logo_marca_bmw" class="swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="bmw" src="{{ asset('icon/iconos_marcas/bmw-logo.webp') }}" alt="Logo BMW"
                                decoding="async">
                        </div>
                        <div id="logo_marca_f" class="swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="ferrari" src="{{ asset('icon/iconos_marcas/Ferrari_logo.webp') }}"
                                alt="Logo Ferrari" decoding="async">
                        </div>
                        <div id="logo_marca_jaguar" class="swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="jaguar" src="{{ asset('icon/iconos_marcas/jaguar-logo.webp') }}"
                                alt="Logo Jaguar" decoding="async">
                        </div>
                        <div id="logo_marca_lambo" class="swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="lamborghini" src="{{ asset('icon/iconos_marcas/lamborghini-logo.webp') }}"
                                alt="Logo Lamborghini" decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="rolls-royce" src="{{ asset('icon/iconos_marcas/rolls-royce-logo.webp') }}"
                                alt="Logo Rolls Royce" decoding="async">
                        </div>
                        {{-- <div id="logo_marca_suba" class="swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="subaru" src="{{ asset('icon/iconos_marcas/subaru-icon.webp') }}" alt="logo_subaru"
                                decoding="async">
                        </div> --}}
                        <div id="logo_marca_susu" class="swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="suzuki" src="{{ asset('icon/iconos_marcas/suzuki-logo.webp') }}" alt="Logo Susuki"
                                decoding="async">
                        </div>
                        <div id="logo_marca_volvo" class="swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="volvo" src="{{ asset('icon/iconos_marcas/volvo-logo.webp') }}" alt="Logo Volvo"
                                decoding="async">
                        </div>
                        <!--<div id="logo_marca_kawa" class="swiper-slide">
                            <img title="kawasaki" src="{{ asset('icon/iconos_marcas/Kawasaki-Logo.webp') }}"
                                alt="logo_kawasaki" decoding="async">
                        </div>-->
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="renault" src="{{ asset('icon/iconos_marcas/renault.webp') }}" alt="Logo Renault"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="ford" src="{{ asset('icon/iconos_marcas/ford.webp') }}" alt="Logo Ford"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="honda" src="{{ asset('icon/iconos_marcas/honda.webp') }}" alt="Logo Honda"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="mazda" src="{{ asset('icon/iconos_marcas/mazda.webp') }}" alt="Logo Mazda"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="toyota" src="{{ asset('icon/iconos_marcas/toyota.webp') }}" alt="Logo Toyota"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="ssangyong" src="{{ asset('icon/iconos_marcas/ssangyong.webp') }}" alt="Logo Ssangyong"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="chevrolet" src="{{ asset('icon/iconos_marcas/chevrolet.webp') }}" alt="Logo Chevrolet"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="mercedes" src="{{ asset('icon/iconos_marcas/mercedes.webp') }}" alt="Logo Mercedes"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="foton" src="{{ asset('icon/iconos_marcas/foton.webp') }}" alt="Logo Foton"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="kenworth" src="{{ asset('icon/iconos_marcas/kenworth.webp') }}" alt="Logo Kenworth"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="byd" src="{{ asset('icon/iconos_marcas/byd.webp') }}" alt="Logo BYD"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="dfsk" src="{{ asset('icon/iconos_marcas/dfsk.webp') }}" alt="Logo DFSK"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="dodge" src="{{ asset('icon/iconos_marcas/dodge.webp') }}" alt="Logo Dodge"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="mitsubishi" src="{{ asset('icon/iconos_marcas/mitsubishi.webp') }}" alt="Logo Mitsubishi"
                                decoding="async">
                        </div>
                        <!--<div class="logo_marca swiper-slide">
                            <img title="yamaha" src="{{ asset('icon/iconos_marcas/yamaha.webp') }}" alt="logo_yamaha"
                                decoding="async">
                        </div>-->
                        <!--<div class="logo_marca swiper-slide">
                            <img title="auteco" src="{{ asset('icon/iconos_marcas/auteco.webp') }}" alt="logo_auteco"
                                decoding="async">
                        </div>-->
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="jeep" src="{{ asset('icon/iconos_marcas/jeep.webp') }}" alt="Logo Jeep"
                                decoding="async">
                        </div>
                        <div class="logo_marca swiper-slide" data-toggle="modal"
                        data-target="#clienteModal">
                            <img title="peugeot" src="{{ asset('icon/iconos_marcas/peugeot.webp') }}" alt="Logo Peugeot"
                                decoding="async">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="solicitud-de-repuestos" data-aos="fade-right" data-aos-duration="700">
            <div class="container-flex">
                <div class="w-50" id="container-text-cuentanos">
                    <h2>1. CUÉNTANOS:</h2>
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
                    <div class="container-btn-solicitud-cel w-100">
                        <a title="Crear solicitud de repuesto" class="WSP" href="{{route('vistaFormulario')}}" style="margin-bottom: 0;">
                        ¡Busca aquí!
                        <i class="fa fa-search" style="font-size: 40px;" aria-hidden="true"></i></a>
                    </div>
                </div>

                <div class="w-40" id="container-img-cuentanos">
                    <img src="{{asset('img/img-carro.webp')}}"
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
                    <img src="{{asset('img/img-correo.webp')}}"
                        alt="correo" width="736">
                </div>
                <div class="w-50" id="container-text-envia-tu-requerimiento">
                    <h3>2. ENVÍA TU <br> REQUERIMIENTO:</h3>

                    <p>Los almacenes afiliados del país recibirán
                        tu solicitud y en menos de 24 horas
                        TU REPUESTO YA te enviará las 5 mejores
                        cotizaciones.</p>

                    <div class="container-btn-solicitud-cel w-100">
                        <a title="Crear solicitud de repuesto" class="WSP" href="{{route('vistaFormulario')}}" style="margin-bottom: 0;">
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
                    <h4>3. ELIGE TU MEJOR OPCIÓN:</h4>

                    <p>Ponte de acuerdo con el establecimiento <br>
                        para el pago y el envío.</p>

                        <div class="container-btn-solicitud-cel w-100">
                            <a title="Crear solicitud de repuesto" class="WSP" href="{{route('vistaFormulario')}}" style="margin-bottom: 0;">
                            ¡Busca aquí!
                            <i class="fa fa-search" style="font-size: 40px;" aria-hidden="true"></i></a>
                        </div>
                </div>
                <div class="w-40" id="container-img-elige-tu-mejor-opcion">
                    <img src="{{asset('img/cel-mano.webp')}}"
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
                <h1 style="text-align: center;">¿BUSCAS ALGO DIFERENTE A REPUESTOS PARA CARROS?</h1>
                <div class="footer-sesion-de-contacto-por-whatsapp w-100">
                    <a style="width: 300px; height: 70px; background-color: #25D366; margin-top: 4% !important; margin-bottom: 0;" title="Crear solicitud de repuesto" class="WSP" href="https://api.whatsapp.com/send?phone=+573249216736&text=%2A%C2%A1Hola%21%2A%20%E2%9C%8B%20Vengo%20de%20la%20p%C3%A1gina%20web%20de%20%2ATu%20Repuesto%20Ya%2A%20Estoy%20buscando%20lo%20siguiente%3A">
                        ¡Busca aquí!
                        <i class="fab fa-whatsapp" style="font-size: 40px;" aria-hidden="true"></i>

                    </a>
                </div>
            </div>
            <div id="container-text-body-busqueda-de-productos-diferentes">
                <p><span style="font-weight: 700;">Cuéntale a tus amigos</span><br>y por cada compra de repuestos para carros que realicen tus referidos,<br>gánate un obsequio</p>
                <div id="container-img-busqueda-de-productos-diferentes">
                    <img class="icon_chat" id='icon_chat' src="{{ asset('img/img-megafono.webp') }}" alt="megafono">
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
                    <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
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
    <a href="https://api.whatsapp.com/send?phone=573249216736&text=%2A%C2%A1Hola%21%2A%20%E2%9C%8B%20Vengo%20de%20la%20p%C3%A1gina%20web%20de%20%2ATu%20Repuesto%20Ya%2A%20Me%20gustar%C3%ADa%20recibir%20cotizaciones%20sobre%20un%20repuesto%20que%20necesito." id="btn_whatsapp_kommo"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>

    <!-- Enviar cierre de sesión-->
    <script>
        document.getElementById('logoutForm').addEventListener('submit',function(event){event.preventDefault();this.submit();});
    </script>
    <!-- ................................................................................................. -->
@endsection
