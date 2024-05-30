<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Models\Compra;

class TransbankController extends Controller
{
    public function __construct()
    {
        if(app()->environment('production')){
            WebpayPlus::configureForProduction(
                env('WEBPAY_PLUS_CC'),
                env('WEBPAY_PLUS_API_KEY')
            );
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function iniciar_compra(Request $request)
    {
        $totalCarrito = $request->input('total');
    
        $nueva_compra = new Compra();
        $nueva_compra->session_id = "123456"; // Deberías usar un identificador de sesión real aquí
        $nueva_compra->total = $totalCarrito;
        $nueva_compra->save();
    
        $url_to_pay = $this->start_webpay_plus_transaction($nueva_compra);
        return response()->json(['url' => $url_to_pay]);
    }
    
    
    
    

    public function start_webpay_plus_transaction($nueva_compra)
    {
        $transaccion = (new Transaction)->create(
            $nueva_compra->id,
            $nueva_compra->session_id,
            $nueva_compra->total, // Aquí es donde debes pasar el total de la compra
            route('confirmar_pago')
        );
        return $transaccion->getUrl();
    }
 
    

    public function confirmar_pago(Request $request)
    {
        $confirmacion = (new Transaction)->commit($request->get('token_ws'));

        $compra = Compra::where('id', $confirmacion->getBuyOrder())->first();

        if ($confirmacion->isApproved()) {
            $compra->status = 2;
            $compra->update();

            return redirect(env('URL_FRONTEND_AFTER_PAYMENT') . "?compra_id={$compra->id}");
        } else {
            return redirect(env('URL_FRONTEND_AFTER_PAYMENT') . "?compra_id={$compra->id}");
        }
    }
}



