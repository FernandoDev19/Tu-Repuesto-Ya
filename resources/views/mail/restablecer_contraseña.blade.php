<!DOCTYPE html>
<html>
<head>
    <title>Restablecer contraseña</title>
</head>
<body>
    <h1>¡Cambie su contraseña <a href="{{ route('change-password-token', ['token' => $token]) }}">aquí</a></h1>
    <p>Inicie sesión en su cuenta para comenzar a utilizar nuestros servicios.</p>
</body>
</html>
