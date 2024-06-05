<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferremas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Nombre del Comercio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="container">
        <h2>Confirmación de Pago</h2>
        <p>Nombre del Comercio: Ferremas</p>
        <p>Orden de Pedido: {{ $order->nro_pedido }}</p>
        <p>Monto Pagado: {{ $order->pago->monto }}</p>
        <p>Fecha del Pago: {{ $order->pago->fecha }}</p>
        <p>Tipo de Pago: {{ $order->pago->tipo_pago }}</p>
        @if($order->pago->cuotas > 0)
            <p>Cuotas: {{ $order->pago->cuotas }}</p>
            <p>Monto por Cuota: {{ $order->pago->monto / $order->pago->cuotas }}</p>
        @else
            <p>Sin Cuotas</p>
        @endif
        <p>Número de Tarjeta: **** **** **** {{ substr($order->pago->numero_tarjeta, -4) }}</p>
    </div>

    <!-- Footer -->
    <footer class="footer bg-light mt-5 p-3">
        <div class="container">
            <p class="text-center">Nombre del Comercio © 2022. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>