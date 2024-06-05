<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferretería FERREMAS</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div id="overlay"></div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/inicio') }}">
            <img src="{{ asset('img/logo_ferremas_transparente.png') }}" style="width: 80px;" alt="logo">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @else
                    <li class="nav-item d-flex align-items-center">
                        <img src="{{ asset('img/user_login.png') }}" style="width: 40px;" class="rounded-circle" alt="user">
                        <span class="nav-link mb-0">{{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>

            <form class="form-inline my-2 my-lg-0 mx-3" action="{{ route('search') }}" method="GET">
                <input class="form-control mr-sm-2" type="search" name="query" placeholder="Buscar" aria-label="Buscar">
            </form>

            <button type="button" id="cart-button" class="btn btn-success">
                <i class="fas fa-shopping-cart"></i>
                <span id="cart-count-badge" class="badge rounded-pill bg-danger">0</span>
            </button>
        </div>
    </div>
</nav>

<aside id="cart" class="cart-panel">
    <div id="cart-header">
        <h2>Mi carro</h2>
        <p id="cart-count">0 productos</p>
    </div>
    <div id="cart-items-container">
        <div id="cart-items">
            
        </div>
    </div>
    <div id="cart-footer">
        <p id="cart-total">Total: $0</p>
        <button type="button" id="buy-now" class="btn btn-success" onclick="window.location.href='{{ route('pago') }}'">Comprar ahora</button>
    </div>
</aside>



<aside id="herramientasAside">
    <h5 class="mt-3">Herramientas</h5>
    <ul>
        <li><a href="{{ route('herramientas') }}" class="btn btn-primary btn-block mt-2">Herramientas Manuales</a></li>
        <li><a href="{{ route('materiales') }}" class="btn btn-primary btn-block mt-2">Materiales Básicos</a></li>
        <li><a href="{{ route('equipos') }}" class="btn btn-primary btn-block mt-2">Equipos de Seguridad</a></li>
    </ul>
</aside>

<header class="bg-light py-3">
    <div class="container text-center">
        <h1 class="display-4">Bienvenido a FERREMAS</h1>
        <p class="lead">Tu distribuidora de productos de ferretería y construcción en Santiago y todo Chile.</p>
        
        <style>
.carousel-item {
  height: 600px; /* Ajusta este valor según tus necesidades */
  overflow: hidden;
}

.carousel-item img {
  height: 100%;
  object-fit: cover;
}
</style>

<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active" data-interval="5000">
            <img src="https://d100mj7v0l85u5.cloudfront.net/s3fs-public/2023-04/funciones-del-jefe-de-compras-6.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-interval="5000">
            <img src="https://www.zarla.com/images/Zarla-hardware-store-logos-5184x3456-2022015.jpeg?crop=21:16,smart&width=420&dpr=2" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-interval="5000">
            <img src="https://www.nortonabrasives.com/sites/sga.na.com/files/styles/node__field_blog_image__full/public/blog/que-vender-en-una-%20ferreteria_0.jpg?itok=Uup553v7" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center px-2">
                <a href="{{ route('herramientas') }}" class="text-decoration-none text-dark">
                    <div class="card" style="width: 18rem; transition: transform .2s; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); border-radius: 10px;" onmouseover="this.style.transform='scale(1.05)'; this.style.backgroundColor='#f8f9fa';" onmouseout="this.style.transform='scale(1)'; this.style.backgroundColor='';">
                        <img class="card-img-top" src="{{ asset('img/herramientas.png') }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Herramientas</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 text-center px-2">
                <a href="{{ route('materiales') }}" class="text-decoration-none text-dark">
                    <div class="card" style="width: 18rem; transition: transform .2s; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); border-radius: 10px;" onmouseover="this.style.transform='scale(1.05)'; this.style.backgroundColor='#f8f9fa';" onmouseout="this.style.transform='scale(1)'; this.style.backgroundColor='';">
                        <img class="card-img-top" src="{{ asset('img/materiales.png') }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Materiales</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 text-center px-2">
                <a href="{{ route('equipos') }}" class="text-decoration-none text-dark">
                    <div class="card" style="width: 18rem; transition: transform .2s; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); border-radius: 10px;" onmouseover="this.style.transform='scale(1.05)'; this.style.backgroundColor='#f8f9fa';" onmouseout="this.style.transform='scale(1)'; this.style.backgroundColor='';">
                        <img class="card-img-top" src="{{ asset('img/equipos.png') }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Equipos</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="text-center mb-5">
                    <h2 class="h3 mb-3">Sobre FERREMAS</h2>
                    <hr class="divider my-4" />
                </div>
                <p class="lead text-justify">Ferretería FERREMAS es una distribuidora de productos de ferretería y construcción establecida en Santiago desde la década de los 80. Contamos con 4 sucursales en la región metropolitana y 3 sucursales en regiones, con planes de expansión en todo Chile.</p>
                <p class="lead text-justify">En FERREMAS ofrecemos una amplia gama de productos, desde herramientas manuales y eléctricas, hasta materiales de construcción, pinturas, materiales eléctricos y accesorios diversos. Trabajamos con marcas reconocidas del sector, garantizando calidad y diversidad en nuestros productos.</p>
            </div>
        </div>
    </div>
</section>

<footer class="footer bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3 class="text-uppercase">FERREMAS</h3>
                <p>Somos una distribuidora de productos de ferretería y construcción con más de 30 años de experiencia en el mercado. Nuestro objetivo es ofrecer productos de alta calidad a precios competitivos.</p>
            </div>
            <div class="col-md-4">
                <h3 class="text-uppercase">Contacto</h3>
                <p><i class="fas fa-map-marker-alt mr-2"></i> Santiago, Chile</p>
                <p><i class="fas fa-phone-alt mr-2"></i> +56 2 1234 5678</p>
                <p><i class="fas fa-envelope mr-2"></i> info@ferremas.cl</p>
            </div>
            <div class="col-md-4">
                <h3 class="text-uppercase">Enlaces</h3>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white"><i class="fas fa-chevron-right mr-2"></i>Acerca de nosotros</a></li>
                    <li><a href="#" class="text-white"><i class="fas fa-chevron-right mr-2"></i>Términos y condiciones</a></li>
                    <li><a href="#" class="text-white"><i class="fas fa-chevron-right mr-2"></i>Política de privacidad</a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <p class="small">&copy; 2022 FERREMAS. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('js/carrito.js') }}"></script>
<script src="{{ asset('js/inicio.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>