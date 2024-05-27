<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferretería FERREMAS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .card-img-top {
            object-fit: cover;
            height: 250px;
        }
    </style>
</head>
<body>
<div id="overlay"></div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="text-center">
            <a href="{{ url('/inicio') }}">
                <img src="{{ asset('img/logo_ferremas_transparente.png') }}" style="width: 80px;" alt="logo">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                </li>
                <li class="nav-item">
                    <button type="button" id="cart-button" class="btn btn-success">Ver carrito</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<aside id="cart" class="cart-panel">
    <h2>Mi carro</h2>
    <div id="cart-items">
        <!-- Los ítems del carrito van aquí -->
    </div>
    <div id="cart-total">
        <!-- El total va aquí -->
    </div>
    <div id="cart-product-total">
        <!-- El total de productos va aquí -->
    </div>
</aside>


<header class="header">
    <div class="container">
        <div class="header-content text-center">
                <h1 class="header-title">Herramientas</h1>
            </div>
        </div>
    </header>

    <section class="featured-products">
        <div class="container">
            <h2 class="section-title">Materiales Destacados</h2>
            <div class="row">
                @foreach ($productos as $producto)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        @if ($producto->imagen)
                        <img src="{{ asset('img/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                        @else
                        <p class="text-center">Imagen no disponible</p>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">Precio: ${{ $producto->precio }}</p>
                            <p class="card-text">Stock: {{ $producto->stock }}</p>
                            <div class="btn-group" role="group" aria-label="Acciones">
                            <button type="button" class="btn btn-success add-to-cart" data-name="{{ $producto->nombre }}" data-price="{{ $producto->precio }}" data-img="{{ asset('img/' . $producto->imagen) }}">Agregar al carrito</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="footer mt-5 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-contact">
                        <h3>Contacto</h3>
                        <p>Dirección: Santiago, Chile</p>
                        <p>Teléfono: +56 2 1234 5678</p>
                        <p>Correo electrónico: info@ferremas.cl</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-links">
                        <h3>Enlaces</h3>
                        <ul class="list-unstyled">
                            <li><a href="#">Acerca de nosotros</a></li>
                            <li><a href="#">Términos y condiciones</a></li>
                            <li><a href="#">Política de privacidad</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/carrito.js') }}"></script>
</body>
</html>
