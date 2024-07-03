@extends('layouts.productos')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center"><h2>Confirmación de Pago</h2></div>
                    <div class="card-body">
                        <p><strong>Nombre del Comercio:</strong> Ferremas</p>
                        <p><strong>Orden de Pedido:</strong> {{ $compra->ID_pedido }}</p>
                        <p><strong>Monto Pagado:</strong> ${{ number_format($compra->total, 0, ',', '.') }}</p>
                        <p><strong>Fecha del Pago:</strong> {{ $compra->updated_at }}</p>
                        <p><strong>Tipo de Pago:</strong> {{ $pago->tipo_pago }}</p>
                        @if($pago->cuotas > 0)
                            <p><strong>Cuotas:</strong> {{ $pago->cuotas }}</p>
                            <p><strong>Monto por Cuota:</strong> ${{ number_format(round($pago->monto / $pago->cuotas), 0, ',', '.') }}</p>
                        @else
                            <p><strong>Sin Cuotas</strong></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/carrito.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Confirmación de pago cargada');
            emptyCart();
        });
    </script>
@endsection
