<!DOCTYPE html>
<html>
<head>
    <title>Orden Entregada</title>
</head>
<body>
    <div style="text-align: center;">
        <img
            src="https://www.solar-center.mx/cdn/shop/files/solar-center-logotipo_200x.png?v=1665157051"
            alt="Logotipo de Solar Center"
            style="max-width: 180px;">
    </div>
    <h1>¡Tu Orden Ha Sido Entregada!</h1>
    <p>Estamos felices de informarte que tu orden con folio <strong>{{ $order->folio() }}</strong> ha sido entregada.</p>

    <h3>Detalles de la entrega:</h3>
    <ul>
        @foreach ($order->items as $item)
            <li>{{$item->product->name}} - Cantidad: {{$item->quantity}} </li>
        @endforeach
    </ul>

    <p>Por favor, revisa tu pedido para asegurarte de que todo está en orden y conforme a lo esperado. En caso de cualquier inconformidad o consulta, no dudes en contactarnos.</p>

    <p>¡Gracias por confiar en nosotros!</p>

    <p style="font-size: small;">
        Este correo electrónico se ha generado automáticamente. Por favor, no respondas a este mensaje.
    </p>
</body>
</html>
