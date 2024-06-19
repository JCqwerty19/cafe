<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('order.create') }}">Order</a>
    <a href="{{ route('kitchen.index') }}">Kitchen</a>
    <a href="{{ route('main.table') }}">Hall</a>
    <a href="{{ route('hall.list') }}">Hall list</a>
    <a href="{{ route('delivery.list') }}">Delivery list</a>
    <a href="{{ route('delivery.orders') }}">Delivery orders</a>
    <a href="{{ route('pickup.list') }}">Pickup list</a>
</body>
</html>