<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferretería FERREMAS</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="overlay"></div>
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
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                </li>
            </ul>
            <button type="button" class="btn btn-primary ml-2" id="toggleAsideButton">Herramientas</button>
        </div>
    </div>
</nav>


<aside id="herramientasAside">
    <h5 class="mt-3">Herramientas</h5>
    <ul>
        <li><a href="{{ route('herramientas') }}" class="btn btn-primary btn-block mt-2">Herramientas Manuales</a></li>
        <li><a href="{{ route('materiales') }}" class="btn btn-primary btn-block mt-2">Materiales Básicos</a></li>
        <li><a href="{{ route('equipos') }}" class="btn btn-primary btn-block mt-2">Equipos de Seguridad</a></li>
    </ul>
</aside>

<header class="header">
    <div class="container">
        <div class="header-content">
            <h1 class="header-title">Bienvenido a FERREMAS</h1>
            <p class="header-description">Tu distribuidora de productos de ferretería y construcción en Santiago y todo Chile.</p>
        </div>
    </div>
</header>

<section class="featured-products">
    <div class="container">
        <h2 class="section-title">Productos Destacados</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="product">
                    <img src="https://dojiw2m9tvv09.cloudfront.net/90227/product/aguarras-medio-litro3423.jpg" alt="Producto 1" class="img-fluid">
                    <h3 class="product-title">Aguarras</h3>
                    <p class="product-price">$3000</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product">
                    <img src="https://www.uyustools.cl/wp-content/uploads/2017/01/MAT16YX_1.jpg" alt="Producto 2" class="img-fluid">
                    <h3 class="product-title">Martillo</h3>
                    <p class="product-price">$5000</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product">
                    <img src="https://motosierraselbosque.cl/wp-content/uploads/2020/07/967-1569-78-1-scaled.jpg" alt="Producto 3" class="img-fluid">
                    <h3 class="product-title">Motosierra</h3>
                    <p class="product-price">$30000</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="company-info">
    <div class="container">
        <h2 class="section-title">Sobre FERREMAS</h2>
        <p>Ferretería FERREMAS es una distribuidora de productos de ferretería y construcción establecida en Santiago desde la década de los 80. Contamos con 4 sucursales en la región metropolitana y 3 sucursales en regiones, con planes de expansión en todo Chile.</p>
        <p>En FERREMAS ofrecemos una amplia gama de productos, desde herramientas manuales y eléctricas, hasta materiales de construcción, pinturas, materiales eléctricos y accesorios diversos. Trabajamos con marcas reconocidas del sector, garantizando calidad y diversidad en nuestros productos.</p>
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

<script src="{{ asset('js/inicio.js') }}"></script>
</body>
</html>
