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
                env('webpay_plus_cc'),
                env('webpay_plus_apy_key')
            );
        } else{
            WebpayPlus::configureForTesting();
        }
    }

    public function iniciar_compra(Request $request)
    {
        $nueva_compra = new Compra();
        $nueva_compra->session_id = "123456";
        $nueva_compra->total = 123456;
        $nueva_compra->save();
        $url_to_play = self::start_web_pay_plus_transaction( $nueva_compra );
        return $url_to_play;
    }

    public function start_web_pay_plus_transaction($nueva_compra)
    {
        $transaccion = (new Transaction)->create(
            $nueva_compra->id,
            $nueva_compra->session_id,
            $nueva_compra->total,
            route('confirmar_pago')
        );
        $url = $transaccion->getUrl(). '?token_ws=' .$transaccion->getToken();
        return $url;
    }
    
    public function confirmar_pago(Request $request)
    {
        $confirmacion = (new Transaction)->commit ( $request->get('token_ws'));

        $compra = Compra::where('id', $confirmacion->buyOrder)->first();

        if($confirmacion->isAproved()) {
            $compra->status =2;
            $compra->update();

            return redirect( env('URL_FRONTEND_AFTER_PAYMENT')."?compra_id={$compra->id}");

        } else{
            return redirect( env('URL_FRONTEND_AFTER_PAYMENT')."?compra_id={$compra->id}");
        }


    }
}


