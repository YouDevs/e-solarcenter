{{-- resources/views/emails/contactFormReceived.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Contacto de Integrador Recibido</title>
</head>
<body>
    <div style="text-align: center;">
        <img
            src="https://www.solar-center.mx/cdn/shop/files/solar-center-logotipo_200x.png?v=1665157051"
            alt="Logotipo de Solar Center"
            style="max-width: 180px;">
    </div>

    <h1 style="text-align: center;">Nuevo Mensaje de Contacto</h1>
    <p style="text-align: center;">Has recibido un nuevo mensaje a través del formulario de contacto de <span style="font-weight: bold">integrador</span>.</p>

    <h3>Detalles del Mensaje:</h3>
    <p><strong>Nombre:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Teléfono / WhatsApp:</strong> {{ $phone }}</p>
    <p><strong>Estado:</strong> {{ $state }}</p>
    <p><strong>Empresa:</strong> {{ $company }}</p>

    <h3>Mensaje:</h3>
    <p>{{ $message_body }}</p>

    <p>Por favor, considera este mensaje para su pronta respuesta y seguimiento.</p>

    <hr>

    <p style="font-size: small;">
        Este correo electrónico se ha generado automáticamente. Por favor, no respondas a este mensaje.
    </p>
</body>
</html>
