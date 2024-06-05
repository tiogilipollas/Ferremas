@extends('layouts.productos')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-danger text-white"><h2>Pago Rechazado</h2></div>
                    <div class="card-body">
                        <p class="text-center">Lo sentimos, tu pago ha sido rechazado.</p>
                        <p>Por favor, revisa los detalles de tu pago e intenta nuevamente. Si el problema persiste, te recomendamos que te pongas en contacto con tu banco o entidad emisora de la tarjeta para obtener más información.</p>
                        <div class="text-center">
                            <a href="{{ route('inicio') }}" class="btn btn-primary">Volver a la tienda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection