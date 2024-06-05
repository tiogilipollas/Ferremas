<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Models\Pedido;
use App\Models\Pago;

class Confirmarpago extends Controller
{
    public function confirmarPago(Request $request) {
        $token = $request->input('token_ws');
        $transactionResultOutput = Transaction::commit($token);

        if ($transactionResultOutput->getResponseCode() == 0) {
            // El pago fue aprobado
            // Aquí puedes actualizar el estado del pedido en la base de datos
            $orderId = $transactionResultOutput->getBuyOrder();
            $pedido = Pedido::findOrFail($orderId);
            $pedido->estado = 'Pagado';
            $pedido->total = intval($transactionResultOutput->getAmount());
            $pedido->save();

            // Guardar los detalles del pago en la base de datos
           
            $pago = new Pago;
            $pago->_id_pedido = $pedido->id;
            $pago->monto = $transactionResultOutput->getAmount();
            $pago->fecha = $transactionResultOutput->getTransactionDate();
            $pago->cuotas = $transactionResultOutput->getInstallmentsNumber();
            
            // Obtener el tipo de pago
            $paymentTypeCode = $transactionResultOutput->getPaymentTypeCode();
            if ($paymentTypeCode == 'VD') {
                $pago->tipo_pago = 'Crédito';
            } elseif ($paymentTypeCode == 'VN') {
                $pago->tipo_pago = 'Débito';
            } else {
                $pago->tipo_pago = 'Desconocido'; // O cualquier valor por defecto que quieras usar
            }
            
            $pago->numero_tarjeta = $transactionResultOutput->getCardDetail()->getCardNumber();
            $pago->save();
           


            // y luego redirigir al usuario a la página de confirmación
            return redirect()->route('confirmar', ['orderId' => $orderId]);
        } else {
            // El pago fue rechazado
            // Aquí puedes mostrar un mensaje de error al usuario
            return redirect()->route('error', ['message' => 'El pago fue rechazado.']);
        }
    }
}
