<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferretería FERREMAS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <style>
        .card-img-top {
            object-fit: cover;
            height: 250px; 
        }
    </style>
</head>
<body>
<div id="overlay"></div>
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


    @yield('content')
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/carrito.js') }}"></script>

</body>
</html>