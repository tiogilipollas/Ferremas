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
<div class="overlay"></div>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <div class="navbar-brand">
            <a href="{{ url('/inicio') }}">
                <img src="{{ asset('img/logo_ferremas_transparente.png') }}" style="width: 80px;" alt="logo">
            </a>
        </div>

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
                    <li class="nav-item">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <img src="{{ asset('img/user_login.png') }}" style="width: 40px;" alt="logo">
                            <a class="nav-link ml-2" href="{{ route('login') }}">{{ Auth::user()->name }}</a>
                        </div>
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
            
            <div class="d-flex justify-content-center align-items-center w-75">
                <form class="form-inline my-2 my-lg-0 mx-auto w-75" action="{{ route('search') }}" method="GET">
                    <input class="form-control mr-sm-2 w-100" type="search" name="query" placeholder="Buscar" aria-label="Buscar">
                </form> 
            </div>
            <div class="d-flex justify-content-center align-items-center w-75">
                

                
            </div>
            <button type="button" id="cart-button" class="btn btn-success position-relative ml-4">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cart-count-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
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
        <button type="button" id="go-to-cart" class="btn btn-secondary">Ir al carro de compras</button>
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

<section class="py-5">
    <div class="container">
        <h2 class="h3 mb-4">Sobre FERREMAS</h2>
        <p>Ferretería FERREMAS es una distribuidora de productos de ferretería y construcción establecida en Santiago desde la década de los 80. Contamos con 4 sucursales en la región metropolitana y 3 sucursales en regiones, con planes de expansión en todo Chile.</p>
        <p>En FERREMAS ofrecemos una amplia gama de productos, desde herramientas manuales y eléctricas, hasta materiales de construcción, pinturas, materiales eléctricos y accesorios diversos. Trabajamos con marcas reconocidas del sector, garantizando calidad y diversidad en nuestros productos.</p>
    </div>
</section>

<footer class="footer bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Contacto</h3>
                <p>Dirección: Santiago, Chile</p>
                <p>Teléfono: +56 2 1234 5678</p>
                <p>Correo electrónico: info@ferremas.cl</p>
            </div>
            <div class="col-md-6">
                <h3>Enlaces</h3>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Acerca de nosotros</a></li>
                    <li><a href="#" class="text-white">Términos y condiciones</a></li>
                    <li><a href="#" class="text-white">Política de privacidad</a></li>
                </ul>
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