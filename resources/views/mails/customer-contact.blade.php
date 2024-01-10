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

    <h1 style="text-align: center;">Nuevo Mensaje de Contacto</h1>
    <p style="text-align: center;">Has recibido un nuevo mensaje a través del formulario de contacto de cliente.</p>

    <h3>Detalles del Mensaje:</h3>
    <p><strong>Nombre del Cliente:</strong> {{ $name }}</p>
    <p><strong>Email del Cliente:</strong> {{ $email }}</p>
    <p><strong>Teléfono del Cliente:</strong> {{ $phone }}</p>
    <p><strong>Asunto:</strong> {{ $subject }}</p>

    <h3>Mensaje:</h3>
    <p>{{ $message_body }}</p>

    <p>Por favor, considera este mensaje para su pronta respuesta y seguimiento.</p>

    <hr>

    <p style="font-size: small;">
        Este correo electrónico se ha generado automáticamente. Por favor, no respondas a este mensaje.
    </p>
</body>
</html>
