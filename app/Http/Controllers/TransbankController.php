<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Models\Compra;
use Illuminate\Support\Facades\Log;

class TransbankController extends Controller
{
    public function __construct()
    {
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(
                env('webpay_plus_cc'),
                env('webpay_plus_api_key')
            );
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function iniciar_compra(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric',
        ]);

        $totalCarrito = floatval($request->input('total'));

        // Crear una nueva instancia de Compra
        $nueva_compra = new Compra();
        $nueva_compra->session_id = session()->getId(); // Usar un identificador de sesión real
        $nueva_compra->total = $totalCarrito;
        $nueva_compra->save();

        // Iniciar la transacción en Webpay Plus
        $response = $this->start_webpay_plus_transaction($nueva_compra);

        if ($response) {
            return response()->json(['token' => $response->getToken(), 'url' => $response->getUrl()]);
        } else {
            return response()->json(['error' => 'Error al iniciar la transacción'], 500);
        }
    }

    private function start_webpay_plus_transaction($compra)
    {
        $transaction = new WebpayPlus\Transaction();
        $response = $transaction->create(
            'Orden' . $compra->id,
            $compra->session_id,
            $compra->total,
            route('confirmar_pago')
        );

        // Guardar el token en la base de datos
        $compra->token = $response->getToken();
        $compra->save();

        // Registrar la respuesta en los logs
        Log::info('Transacción iniciada', ['response' => $response]);

        // Devolver la respuesta completa
        return $response;
    }

    public function confirmar_pago(Request $request)
    {
        try {
            $confirmacion = (new Transaction)->commit($request->get('token_ws'));

            $compra = Compra::where('id', $confirmacion->getBuyOrder())->first();

            if ($confirmacion->isApproved()) {
                $compra->status = 2;
                $compra->update();

                return redirect(env('URL_FRONTEND_AFTER_PAYMENT') . "?compra_id={$compra->id}");
            } else {
                return redirect(env('URL_FRONTEND_AFTER_PAYMENT') . "?compra_id={$compra->id}");
            }
        } catch (\Exception $e) {
            // Capturar y registrar cualquier error
            \Log::error('Error confirmando transacción con Webpay: ' . $e->getMessage());
            return redirect(env('URL_FRONTEND_AFTER_PAYMENT'))->withErrors(['error' => 'Hubo un problema confirmando el pago.']);
        }
    }
}
