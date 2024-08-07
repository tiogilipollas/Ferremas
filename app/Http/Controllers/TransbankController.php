<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Models\Compra;
use App\Models\Pago;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
        $validated = $request->validate([
            'total' => 'required|numeric',
        ]);
    
        $totalCarrito = floatval($request->input('total'));
    
        // Crear una nueva instancia de Compra
        $nueva_compra = new Compra();
        $nueva_compra->session_id = session()->getId();
        $nueva_compra->total = $totalCarrito;
    
        try {
            $nueva_compra->save();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar la compra: ' . $e->getMessage()], 500);
        }
    
        try {
            $response = $this->start_webpay_plus_transaction($nueva_compra);
            if (!$response) {
                throw new \Exception('No se recibió respuesta de start_webpay_plus_transaction');
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al iniciar la transacción: ' . $e->getMessage()], 500);
        }
    
        return response()->json(['success' => true, 'token' => $response->getToken(), 'url' => $response->getUrl()]);
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
    
            // Obtener la compra según el token
            $compra = Compra::where('token', $request->get('token_ws'))->first();
    
            if ($compra === null) {
                \Log::error('Compra no encontrada', ['token' => $request->get('token_ws')]);
                return view('rechazo', ['error' => 'Compra no encontrada']);
            }
    
            if ($confirmacion->isApproved()) {
                  // Crear el pedido
                    $pedido = new Pedido;
                    $pedido->ID_pedido = $confirmacion->getBuyOrder();
                    $pedido->fecha = date('Y-m-d H:i:s'); // Añade la fecha actual
                    $pedido->estado = 'algún valor'; // Añade un valor para 'estado'
                    $pedido->total = $confirmacion->getAmount(); // Añade el total de la transacción
                    $pedido->save();
        
    
                // Ahora que el pedido existe, puedes actualizar la compra
                $compra->status = 2;
                $compra->ID_pedido = $pedido->ID_pedido;
                $compra->save();
                \Log::info('Compra actualizada', ['compra' => $compra]);

                // Crear un nuevo registro de pago
                $pago = new Pago;
                $pago->ID_pedido = $compra->id;
                $pago->monto = $confirmacion->getAmount();
                $pago->fecha = Carbon::parse($confirmacion->getTransactionDate())->format('Y-m-d H:i:s');
                $paymentTypeCode = $confirmacion->getPaymentTypeCode();
                if ($paymentTypeCode == 'VD') {
                    $pago->tipo_pago = 'Débito';
                } elseif ($paymentTypeCode == 'VN') {
                    $pago->tipo_pago = 'Crédito';       
                } else {
                    $pago->tipo_pago = 'Desconocido'; 
                }
                $pago->cuotas = $confirmacion->getInstallmentsNumber();
                $pago->numero_tarjeta = $confirmacion->getCardDetail()['card_number'];
                $pago->save();
                \Log::info('Pago guardado', ['pago' => $pago]);
    
                // Redirigir a la vista de confirmación
                return view('confirmar', ['pago' => $pago, 'compra' => $compra]);
            } else {
                \Log::error('Pago rechazado', ['confirmacion' => $confirmacion]);
                return view('rechazo', ['error' => 'Pago rechazado']);
            }
        } catch (\Exception $e) {
            \Log::error('Error confirmando transacción con Webpay', ['error' => $e->getMessage()]);
            return view('rechazo', ['error' => 'Error confirmando transacción con Webpay']);
        }
    }
    


}
