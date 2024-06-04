<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Models\Compra;
use App\Models\Pago;
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
        $transaction = new Transaction();
        $response = $transaction->create(
            $compra->id,
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
        \Log::info('Respuesta de la pasarela de pago', ['confirmacion' => $confirmacion]);

        // Obtener la compra según el id
        $compra = Compra::where('token', $request->get('token_ws'))->first();

        if ($compra === null) {
            \Log::error('Compra no encontrada', ['token' => $request->get('token_ws')]);
            return view('rechazo', ['error' => 'Compra no encontrada']);
        }

        if ($confirmacion->isApproved()) {
            $compra->status = 2;
            $compra->update();
            \Log::info('Compra actualizada', ['compra' => $compra]);

            // Crear un nuevo registro de pago
            $pago = new Pago;
            $pago->_id_pedido = $compra->id;
            $pago->monto = $confirmacion->getAmount();
            $pago->fecha = $confirmacion->getTransactionDate();

            // Obtener el tipo de pago
            $paymentTypeCode = $confirmacion->getPaymentTypeCode();
            if ($paymentTypeCode == 'VD') {
                $pago->tipo_pago = 'Crédito';
            } elseif ($paymentTypeCode == 'VN') {
                $pago->tipo_pago = 'Débito';
            } else {
                $pago->tipo_pago = 'Desconocido'; // O cualquier valor por defecto que quieras usar
            }

            $pago->cuotas = $confirmacion->getInstallmentsNumber();
            $pago->numero_tarjeta = $confirmacion->getCardDetail()['card_number'];
            $pago->save();
            \Log::info('Pago registrado', ['pago' => $pago]);

            return view('confirmar', ['compra_id' => $compra->id]);
        } else {
            // No se cambia el estado de la compra si la transacción no es aprobada
            return view('rechazo', ['compra_id' => $compra->id]);
        }
    } catch (\Exception $e) {
        \Log::error('Error confirmando transacción con Webpay: ' . $e->getMessage());
        return view('rechazo', ['error' => 'Hubo un problema confirmando el pago.']);
    }
}



    

    
    
    
}
