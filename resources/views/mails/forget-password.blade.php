<!DOCTYPE html>
<html>
<head>
    <title>Reestablecer contraseña</title>
</head>
<body>
    <div style="text-align: center;">
        <img
            src="https://www.solar-center.mx/cdn/shop/files/solar-center-logotipo_200x.png?v=1665157051"
            alt="Logotipo de Solar Center"
            style="max-width: 180px;">
    </div>

    <h1 style="text-align: center;">Reestablece tu contraseña</h1>
    <p style="text-align: center;">Puedes reestablecer tu contraseña haciendo click en el link:
        <a href="{{ route('reset.password.get', $token) }}">Reestablecer Contraseña</a>
    </p>
    <hr>

    <p style="font-size: small;">
        Este correo electrónico se ha generado automáticamente. Por favor, no respondas a este mensaje.
    </p>
</body>
</html>