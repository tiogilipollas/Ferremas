<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pago</title>
    <link rel="stylesheet" href="{{ asset('css/pago.css') }}">
</head>
<body>
    <nav>
        <a href="{{ url('/inicio') }}">
            <img src="{{ asset('img/logo_ferremas_transparente.png') }}" style="width: 80px;" alt="logo">
        </a>
    </nav>
    <div class="container">
        <h1>Resumen de Compra</h1>
        <div id="cart-summary">
            <!-- El resumen del carrito se renderizará aquí -->
        </div>
        <button id="checkout-button" class="btn btn-primary">Ir a pagar</button>
    </div>
    <!-- Asegúrate de incluir jQuery antes de tus scripts personalizados -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/carrito.js') }}"></script>
    <script src="{{ asset('js/pago.js') }}"></script>
</body>
</html>