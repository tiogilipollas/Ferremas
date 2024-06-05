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
        .payment-methods {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .payment-method {
            width: 50px; 
            height: auto;
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
                        <img src="{{ asset('img/user_login.png') }}" style="width: 40px;" alt="logo">
                            <a class="nav-link ml-2" href="{{ route('login') }}">{{ Auth::user()->name }}</a>
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
            
            <div class="col-md-3">
                <h3 class="text-uppercase">Servicio al cliente</h3>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white"><i class="fas fa-chevron-right mr-2"></i>Contáctanos</a></li>
                    <li><a href="#" class="text-white"><i class="fas fa-chevron-right mr-2"></i>Devoluciones y reembolsos</a></li>
                    <li><a href="#" class="text-white"><i class="fas fa-chevron-right mr-2"></i>Envío y entrega</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3 class="text-uppercase">Información de la tienda</h3>
                <p><i class="fas fa-map-marker-alt mr-2"></i> Santiago, Chile</p>
                <p><i class="fas fa-phone-alt mr-2"></i> +56 2 1234 5678</p>
                <p><i class="fas fa-envelope mr-2"></i> info@ferremas.cl</p>
            </div>
            <div class="col-md-3">
                <h3 class="text-uppercase">Categorías de productos</h3>
                <ul class="list-unstyled">
                    <li><a href="{{ route('herramientas') }}" class="text-white"><i class="fas fa-chevron-right mr-2"></i>Herramientas</a></li>
                    <li><a href="{{ route('materiales') }}" class="text-white"><i class="fas fa-chevron-right mr-2"></i>Materiales</a></li>
                    <li><a href="{{ route('equipos') }}" class="text-white"><i class="fas fa-chevron-right mr-2"></i>Equipos</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3 class="text-uppercase">Medios de Pago</h3>
                <div class="payment-methods">
                    <img class="payment-method" src="https://easycl.vtexassets.com/assets/vtex/assets-builder/easycl.store-theme/7.0.46/footer/Logo-04___64c6f337fae628fd8d570153b0d90da6.svg" alt="Medio de pago ScotiaBank">
                    <img class="payment-method" src="https://easycl.vtexassets.com/assets/vtex/assets-builder/easycl.store-theme/7.0.46/footer/Logo-03___35ba0fbaa9b3b09a7c4cd1060c1833b9.svg" alt="Medio de pago MasterCard">
                    <img class="payment-method" src="https://easycl.vtexassets.com/assets/vtex/assets-builder/easycl.store-theme/7.0.46/footer/Logo-01___7be2be91eea77f9694ea89142ceb6d36.svg" alt="Medio de pago VISA">
                    <img class="payment-method" src="https://easycl.vtexassets.com/assets/vtex/assets-builder/easycl.store-theme/7.0.46/footer/Logo-05___e0b22fb60d3c1a8c1f583c01655eaaf3.svg" alt="Medio de pago American Express">
                    <img class="payment-method" src="https://easycl.vtexassets.com/assets/vtex/assets-builder/easycl.store-theme/7.0.46/footer/Logo-02___068200029cfbe613d668e18f000c7786.svg" alt="Medio de pago Red Compra">
                </div>
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