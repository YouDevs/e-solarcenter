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

    <h1 style="text-align: center;">El cliente: {{$order->customer->user->name}} ha realizado una orden.</h1>
    <p style="text-align: center;"> <strong>Id Netsuite</strong>: {{ $order->customer->netsuite_key }}</p>
    <p style="text-align: center;"> <strong>Folio</strong>: {{ $order->folio() }}.</p>
    <p style="text-align: center;"> <strong>Concepto de pago</strong>: {{$order->payment_concept}} </p>

    <h3>Detalle de la Orden:</h3>
    <ul>
        @foreach ($order->items as $item)
            <li>{{$item->product->name}} - Cantidad: {{$item->quantity}} </li>
        @endforeach
    </ul>

    <p>Total Pagado: <strong>${{ number_format($order->total, 2) }}</strong></p>
    <hr>

    <p style="font-size: small;">
        Este correo electrónico se ha generado automáticamente. Por favor, no respondas a este mensaje.
    </p>
</body>
</html>