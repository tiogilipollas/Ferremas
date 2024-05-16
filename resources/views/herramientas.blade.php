<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferretería FERREMAS</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <span class="brand">FERREMAS</span>
            <ul class="nav-links">
                <li><a href="{{ route('index') }}">Inicio</a></li>
                <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
            </ul>
        </div>
    </nav>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <h1 class="header-title">Herramientas</h1>
            </div>
        </div>
    </header>

    <section class="featured-products">
        <div class="container">
            <h2 class="section-title">Herramientas Destacadas</h2>
            <div class="product-grid">
                @foreach ($productos as $producto)
                    <div class="product">
                        <img src="{{ asset($imagenes[$producto->id_producto]) }}" alt="{{ $producto->nombre }}">
                        <h3 class="product-title">{{ $producto->nombre }}</h3>
                        <p class="product-price">${{ $producto->precio }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-contact">
                <h3>Contacto</h3>
                <p>Dirección: Santiago, Chile</p>
                <p>Teléfono: +56 2 1234 5678</p>
                <p>Correo electrónico: info@ferremas.cl</p>
            </div>
            <div class="footer-links">
                <ul>
                    <li><a href="#">Acerca de nosotros</a></li>
                    <li><a href="#">Términos y condiciones</a></li>
                    <li><a href="#">Política de privacidad</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>
