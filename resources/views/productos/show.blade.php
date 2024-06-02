
@extends('layouts.productos')

@section('content')

<div class="container mt-5">
    <div class="card" style="border: 1px solid #ddd; border-radius: 10px;">
        <div class="row no-gutters">
            <div class="col-md-6">
                @if ($producto->imagen)
                <img src="{{ asset('img/' . $producto->imagen) }}" class="img-fluid rounded" alt="{{ $producto->nombre }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                <p class="text-center m-5">Imagen no disponible</p>
                @endif
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><strong>Precio:</strong> ${{ $producto->precio }}</h6>
                    <p class="card-text"><strong>Stock:</strong> {{ $producto->stock }}</p>
                    <p class="card-text"><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                    <button type="button" class="btn btn-primary add-to-cart" data-name="{{ $producto->nombre }}" data-price="{{ $producto->precio }}" data-img="{{ asset('img/' . $producto->imagen) }}">Agregar al carrito</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

