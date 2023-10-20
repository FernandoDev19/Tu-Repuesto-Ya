<footer id="footer" style="width: 100% !important; max-width: 2080px;">
    <div class="content_f">

        <div>
            <img decoding="async" class="logo_footer"
                src="{{ asset('img/logo tu repuesto ya/logo tu repuesto.png') }}" alt="Imagen_TuRepuestoYa">
        </div>

        <div id="font_size_acerca_de">
            <h1><span class="t_blue">ACERCA DE</span> NOSOTROS</h1>
            <ul id="acerca_de">
                <li><a class="li_acerca" href="{{ route('mi-empresa') }}#article_que_es">Compañia</a></li><br>
                <li><a class="li_acerca" href="{{ route('servicios') }}#sesion-de-envío-de-requerimientos">Servicios</a></li><br>
                <li><a class="li_acerca" href="{{ route('proveedor') }}#sesion-de-proveedores">Proveedores</a></li>
            </ul>
        </div>

        <hr>

        <div class="content_contactos">
            <div class="content_contacto">
                <h1><span class="t_blue">CONTACTO</span></h1>
                <ul class="list_contacto">
                    <li>
                        <a href="https://www.google.com/maps/place/Cra.+46+%2385-61,+Nte.+Centro+Historico,+Barranquilla,+Atl%C3%A1ntico/@11.0022525,-74.8243522,17z/data=!3m1!4b1!4m6!3m5!1s0x8ef42daa1f233333:0x1045fc1611f02e18!8m2!3d11.0022472!4d-74.8217773!16s%2Fg%2F11rxnh717q?hl=es&entry=ttu"
                            target="blank"><span class="t_white"><img class="img_icon"
                                    src="{{ asset('icon/iconos_footer/location-dot-solid.png') }}"
                                    alt="ubicacion">Barranquilla,
                                Colombia.</span> </a>
                    </li>

                    <li>
                        <a href="tel:+573053238666"><span class="t_white"><img class="img_icon"
                                    src="{{ asset('icon/iconos_footer/phone-solid.png') }}" alt="telefono">Tel:
                                (+57)
                                305 323
                                8666</span></a>
                    </li>
                    <li>
                        <a href="mailto:reservas@milanocar.com"><span class="t_white"><img class="img_icon"
                                    src="{{ asset('icon/iconos_footer/email.png') }}"
                                    alt="email">reservas@milanocar.com</span></a>
                    </li>
                </ul>
            </div>

            <div class="contenedor_icons">

                <div class="contenedor_icon"><a href=""><img class="icons_footer" decoding="async"
                            src="{{ asset('icon/icon_facebook.png') }}" alt="red-social"></a>
                </div>

                <div class="contenedor_icon"><a href=""><img class="icons_footer" decoding="async"
                            src="{{ asset('icon/icon_twitter.png') }}" alt="red-social"></a></div>

                <div class="contenedor_icon"><a href=""><img class="icons_footer" decoding="async"
                            src="{{ asset('icon/icon_google.png') }}" alt="red-social"></a></div>

                <div class="contenedor_icon"><a href=""><img class="icons_footer" decoding="async"
                            src="{{ asset('icon/linkedin.png') }}" alt="red-social"></a></div>

                <div class="contenedor_icon"><a href=""><img class="icons_footer" decoding="async"
                            src="{{ asset('icon/youtube.png') }}" alt="red-social"></a></div>
            </div>

        </div>

    </div>
</footer>

