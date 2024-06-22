@extends('layouts.productos')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Resultados de búsqueda</h1>

        <section class="featured-products">
            <div class="container">
                <div class="row justify-content-center">
                    @php
                    $productosOrdenados = $productos->sort(function ($a, $b) {
                        return $a->estado == 'descontinuado' ? 1 : -1;
                    });
                    @endphp

                    @foreach ($productosOrdenados as $producto)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            @if ($producto->imagen)
                            <img src="{{ asset('img/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                            @else
                            <p class="text-center">Imagen no disponible</p>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $producto->nombre }}</h5>
                                <p class="card-text">Precio: ${{ $producto->precio }}</p>
                                @if ($producto->estado == 'descontinuado')
                                <p class="card-text text-danger">Fuera de stock</p>
                                @else
                                <p class="card-text">Stock: {{ $producto->stock }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('productos.show', $producto->ID_producto) }}" class="btn btn-primary" target="_blank">Ver más</a>
                                    <button type="button" class="btn btn-success add-to-cart w-100" data-name="{{ $producto->nombre }}" data-price="{{ $producto->precio }}" data-img="{{ asset('img/' . $producto->imagen) }}">Agregar al carrito</button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($loop->iteration % 4 == 0)
                        </div><div class="row justify-content-center">
                    @endif
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection