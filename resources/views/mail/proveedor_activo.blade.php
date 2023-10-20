<!DOCTYPE html>
<html>
<head>
    <title>Proveedor activado</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="text-header">
                <h1 style="font-size:30px; font-weight: 900;">¡Su cuenta está activada!</h1>
            </div>
        </div>
        <div class="container">
                    <p>Su cuenta ha sido activada y está lista para usar.</p>
        <p>A continuación se muestran sus credenciales de inicio de sesión:</p>
        <p>Correo electrónico: {{ $email }}</p>
        <p>Contraseña: {{ $password }}</p>
        <p>Inicie sesión en su cuenta para comenzar a utilizar nuestros servicios.</p>
        </div>

        <footer>

        </footer>

    </div>
</body>
</html>