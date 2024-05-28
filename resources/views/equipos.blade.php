@extends('layouts.productos')

@section('content')
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

    <!-- Resto del contenido de la página -->

@endsection