<!DOCTYPE html>
<html>

<head>
    <title>Proveedor activado</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body style=" box-sizing: border-box;padding: 0;margin: 0;font-family: system-ui;">
    <header class="header" style="height: 3%;padding: 1% 15%;background-color: black;">
        <div class="container" style="height: auto;width: 100%">
            <div class="img_container" style="height: 80px;width: auto;">
                <img decoding="async" id="logo" src="{{ asset('img/logo_tu_repuesto.png') }}"
                    alt="Logo_TuRepuestoYa" style="height: 100%; width: auto;">
            </div>
        </div>
    </header>
    <div class="container-text" style="height: 100%;width: 100%;margin-top: 3%; display: grid; grid-template-rows: auto 1fr auto;">
        <div class="text-center" style="text-align: center;">
            <h1 class="title" style="font-size: 28px;letter-spacing: 0.6px;font-weight: 700;color: #105ea8;">¡Su cuenta ha sido activada!</h1>
            <div class="img_like_container" style="margin: 0 0 5% 0;">
                <div>
                    <img id="like" height="50" width="50" src="{{ asset('icon/aprobado.png') }}"
                        alt="like" style="height: 100%;width: 18%;">
                </div>
            </div>
        </div>

        <div class="container-text-body" style=" display: grid; grid-template-rows: auto 1fr auto;">
            <div class="color-text-gray" style="color: gray;font-size: 130%;line-height: 1;font-weight: 400; margin: auto;">
                <p class="color-text-dark-gray" style="font-weight: 700;letter-spacing: 0.5px;margin-bottom: 6%;color: gray;">Su cuenta ha sido activada y está lista para usar.</p>
                <p>A continuación se muestran sus credenciales de inicio de sesión:</p>
                <p>Correo electrónico: {{$email}}</p>
                <p>Contraseña: {{$password}}</p>
                <p style="margin-top: 6%; letter-spacing: 0.6px; font-weight: 500; color: #105ea8;">Inicie sesión en su
                    cuenta para empezar a utilizar nuestros servicios.</p>
            </div>
        </div>

    </div>
    <footer>
      <div id="icons-container" class="container-flex justify-content-center" style="height: 55px; margin-top: 1.8%; display: flex; align-items: center; justify-content: space-between;">
        <div class="icon-world-container" style="margin: auto 0 auto auto;">
          <a href="{{route('servicios')}}"><img src="{{asset('icon/sitio_web.png')}}" alt="sitio web" width="20" height="20"></a>
        </div>
        <span style="color: gray; font-size: 110%; height: 55%; width: 0; border: 0.1rem solid darkgray; margin: auto 10px auto 10px;"></span>
        <div class="icon-whatsapp-container" style="margin: auto auto auto 0;">
          <a href="https://api.whatsapp.com/send?phone=573249216736"><img src="{{asset('icon/whatsapp.png')}}" alt="whatsapp" width="20" height="20"></a>
        </div>
      </div>
    </footer>
</body>

</html>
