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
    <div class="overlay"></div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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

            <div class="d-flex justify-content-center align-items-center w-100">
                <form class="form-inline my-2 my-lg-0 mx-auto w-50" action="{{ route('search') }}" method="GET">
                    <input class="form-control mr-sm-2 w-100" type="search" name="query" placeholder="Buscar" aria-label="Buscar">
                </form>

                <button type="button" id="cart-button" class="btn btn-success position-relative ml-4">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cart-count-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
                </button>
            </div>
        </div>
    </div>
</nav>
    <!-- Contenido -->
    <div class="container">
        <h2>Se rechazo el pago</h2>
    </div>

    <!-- Footer -->
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