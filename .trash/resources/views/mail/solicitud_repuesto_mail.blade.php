<!DOCTYPE html>
<html>
<head>
    <title>Solicitud de repuesto</title>
</head>
<body style="box-sizing: border-box; padding: 0; margin: 0; font-family: system-ui;">
    <header class="header" style="height: 3%; padding: 1% 15%; background-color: black;">
        <div class="container" style="height: auto; width: 100%">
            <div class="img_container" style="height: 80px; width: auto;">
                <img decoding="async" id="logo" src="{{ asset('img/logo-tu-repuesto.webp') }}" alt="Logo TuRepuestoYa" style="height: 100%; width: auto;">
            </div>
        </div>
    </header>

    <div class="container-text" style="height: 100%; width: 100%; margin-top: 3%; display: grid; grid-template-rows: auto 1fr auto;">
        <div class="text-center" style="text-align: center;">
            <h1 class="title" style="font-size: 28px; letter-spacing: 0.6px; font-weight: 700; color: #105ea8;">¡Solicitud de Repuesto!</h1>
            <div class="img_like_container" style="margin: 0 0 2.5% 0;">
                <img id="like" height="50" width="50" src="{{ asset('icon/formulario.png') }}" alt="check" style="height: 100%; width: 18%;">
            </div>
        </div>

        <div class="container-text-body" style="display: grid; grid-template-rows: auto 1fr auto;">
            <div class="color-text-gray" style="color: gray; font-size: 130%; line-height: 1; font-weight: 400; margin: auto; text-align: center;">
                <p class="color-text-dark-gray" style="font-weight: 700; letter-spacing: 0.6px; color: gray; font-size: 120%; margin-bottom: 4%;">Tenemos un nuevo pedido para ti 🔔<br>¡Aquí están los detalles!</p>

                <p class="color-text-dark-gray" style="font-weight: 700; letter-spacing: 0.6px; color: gray; font-size: 110%; margin-bottom: 1%; margin-left: auto; margin-right: auto; text-align: start;">🔩 Datos del Repuesto:</p>
                @php
                    $repuesto = is_array($data['repuesto']) ? implode(',', $data['repuesto']) : $data['repuesto'];
                    $repuesto = str_replace(array("[", "]", "\"", ","), array("", "", "", ", "), $repuesto);
                @endphp
                <p style="text-align: start; margin-bottom: 4%; margin-left: auto; margin-right: auto;">- Repuestos: {{$repuesto}} <br>- Marca: {{$data['marca']}} <br>- Referencia: {{$data['referencia']}} <br>- Modelo (Año): {{$data['modelo']}} <br>-Comentarios: {{$data['comentarios']}}</p>

                <p class="color-text-dark-gray" style="font-weight: 700; letter-spacing: 0.6px; color: gray; font-size: 110%; margin-bottom: 1%; margin-left: auto; margin-right: auto; text-align: start;">📝 Datos del Cliente:</p>
                <p style="text-align: start; margin-bottom: 4%; margin-left: auto; margin-right: auto;">- Nombre: {{$data['nombre']}} <br>- País: {{$data['pais']}} <br>- Departamento: {{$data['departamento']}} <br>- Ciudad: {{$data['municipio']}}"</p>

                <p style="letter-spacing: 0.6px; font-weight: 500; color: #105ea8; margin-bottom: 4%;">Gracias por ser parte de nuestro equipo 👥 <br> <br> Con esta alianza le ofrecemos un EXCELENTE servicio a nuestros clientes ✅</p>
                <p style="letter-spacing: 0.6px; font-size: 120%; font-weight: 700; margin-bottom: 4%;">Si tienes este repuesto disponible, puedes cotizarlo directamente al cliente utilizando el botón inferior ⬇</p>

                <div style="margin-top: 4%;">
                    <a href="{{ route('solicitud',  $data['codigo'] )}}" style="font-weight: 900;color: black;text-decoration: none;background-color: #25D366;border-radius: 5px;padding: 1.5%;letter-spacing: 0.5px;font-size: 115%;">¡Cotizar!</a>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p style="letter-spacing: 0.6px; font-size: 100%; font-weight: 700; color: #105ea8; text-align: center;">Saludos, El equipo de Tu Repuesto Ya</p>
      <div id="icons-container" class="container-flex justify-content-center" style="height: 55px; margin-top: 2%; display: flex; align-items: center; justify-content: space-between;">
        <div class="icon-world-container" style="margin: auto 0 auto auto;">
          <a href="{{route('servicios')}}"><img src="{{asset('icon/sitio_web.png')}}" alt="sitio web" width="30" height="30"></a>
        </div>
        <span style="color: gray; font-size: 110%; height: 55%; width: 0; border: 0.1rem solid darkgray; margin: auto 10px auto 10px;"></span>
        <div class="icon-whatsapp-container" style="margin: auto auto auto 0;">
          <a href="https://api.whatsapp.com/send?phone=573249216736"><img src="{{asset('icon/whatsapp.png')}}" alt="whatsapp" width="30" height="30"></a>
        </div>
      </div>
    </footer>
