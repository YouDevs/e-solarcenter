<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orden Realizada</title>
</head>
<body>
    <div style="text-align: center;">
        <img
            src="https://www.solar-center.mx/cdn/shop/files/solar-center-logotipo_200x.png?v=1665157051"
            alt="Logotipo de Solar Center"
            style="max-width: 180px;">
    </div>

    <h1 style="text-align: center;">¡Gracias por tu orden!</h1>
    <p style="text-align: center;">Hola {{ $order->customer->user->name }}, hemos recibido tu orden con folio <strong>{{ $order->folio() }}</strong>.</p>
    <p style="text-align: center;"><strong>Tu pago será confirmado por un representante de Solar Center y se comenzará con el proceso de tu orden.</strong></p>

    <h3>Detalle de la Orden:</h3>
    <ul>
        @foreach ($order->items as $item)
            <li>{{$item->product->name}} - Cantidad: {{$item->quantity}} </li>
        @endforeach
    </ul>

    <p>Total Pagado: <strong>${{ number_format($order->total, 2) }}</strong></p>

    <p>Gracias por elegir a Solar Center.</p>

    <hr>

    <p style="font-size: small;">
        Este correo electrónico se ha generado automáticamente. Por favor, no respondas a este mensaje.
    </p>
</body>
</html>