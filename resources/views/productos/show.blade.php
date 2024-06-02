@extends('layouts.productos')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            @if ($producto->imagen)
            <img src="{{ asset('img/' . $producto->imagen) }}" class="img-fluid" alt="{{ $producto->nombre }}">
            @else
            <p class="text-center">Imagen no disponible</p>
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $producto->nombre }}</h2>
            <p>Precio: ${{ $producto->precio }}</p>
            <p>Stock: {{ $producto->stock }}</p>
            <button type="button" class="btn btn-success add-to-cart" data-name="{{ $producto->nombre }}" data-price="{{ $producto->precio }}" data-img="{{ asset('img/' . $producto->imagen) }}">Agregar al carrito</button>
        </div>
    </div>
</div>

@endsection