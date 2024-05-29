<!doctype html>
<html lang="en">
<head>
    <title>Registro</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset ('css/login.css') }}">
</head>
<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <a href="{{ url('/inicio') }}">
                                        <img src="{{ asset('img/logo_ferremas.png') }}" style="width: 185px;" alt="logo">
                                        </a>
                                        <h4 class="mt-1 mb-5 pb-1">Bienvenido a Ferremas</h4>
                                    </div>
                                    <form action="{{ route('register') }}" method="post">
                                        @csrf
                                        <p>Creación de cuenta</p>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="name">Nombre</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Ingresar nombre" value="{{ old('name') }}" />
                                            @if ($errors->has('name'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email">Correo</label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Ingresar correo" value="{{ old('email') }}" />
                                            @if ($errors->has('email'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Contraseña</label>
                                            <input type="password" name="password" id="password" class="form-control" />
                                            @if ($errors->has('password'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Registrarse</button>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Ir al login</p>
                                            <a href="{{ route('login') }}" class="btn btn-outline-danger">Login</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">¿Quienes somos?</h4>
                                    <p class="small mb-0">
                                        Bienvenidos a Ferremas, su distribuidora de confianza para todos los productos de ferretería y construcción. Fundada en la comuna de Santiago en la década de los 80, FerreMas ha crecido de manera constante, estableciéndose como un referente en la región metropolitana y más allá. Contamos con 4 sucursales en la región metropolitana y 3 en otras regiones del país, con planes de seguir expandiéndonos para llegar a cada rincón de Chile.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
