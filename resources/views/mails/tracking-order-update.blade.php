{{-- resources/views/emails/contactFormReceived.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Contacto Recibido</title>
</head>
<body>
    <div style="text-align: center;">
        <img
            src="https://www.solar-center.mx/cdn/shop/files/solar-center-logotipo_200x.png?v=1665157051"
            alt="Logotipo de Solar Center"
            style="max-width: 180px;">
    </div>

    <h1 style="text-align: center;">Actualización de paquete</h1>
    <p style="text-align: center;">Un paquete enviado a recibido una actualización de status</p>

    <h3>Detalles:</h3>
    <p><strong>Número de guía:</strong> {{ $number }}</p>
    <p><strong>Evento:</strong> {{ $event }}</p>
    <p><strong>Último status:</strong> {{ $latestStatus }}</p>

    <hr>

    <p style="font-size: small;">
        Este correo electrónico se ha generado automáticamente. Por favor, no respondas a este mensaje.
    </p>
</body>
</html>
