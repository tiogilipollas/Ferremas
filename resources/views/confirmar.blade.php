@extends('layouts.productos')

@section('content')


    <div class="container">
    <h2>Confirmación de Pago</h2>
    <p>Nombre del Comercio: Ferremas</p>
    <p>Orden de Pedido: {{ $compra->ID_pedido }}</p>
    <p>Monto Pagado: {{ $compra->total }}</p>
    <p>Fecha del Pago: {{ $compra->updated_at }}</p>
    <p>Tipo de Pago: {{ $pago->tipo_pago }}</p>
    @if($pago->cuotas > 0)
        <p>Cuotas: {{ $pago->cuotas }}</p>
        <p>Monto por Cuota: {{ $pago->monto / $pago->cuotas }}</p>
    @else
        <p>Sin Cuotas</p>
    @endif
    </div>
@endsection
