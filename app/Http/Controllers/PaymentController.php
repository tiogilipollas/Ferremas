<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
   
    public function showPaymentPage()
    {
        if (Auth::check()) {
            return view('pago');
        } else {
            return redirect()->route('login');
        }
        $carrito = $request->input('carrito');

        foreach ($carrito as $item) {
            $producto = Producto::find($item['id']);
            if ($producto && $producto->stock >= $item['cantidad']) {
                $producto->stock -= $item['cantidad'];
                $producto->save();
            } else {
                return response()->json(['success' => false, 'message' => 'Stock insuficiente para uno o más productos.']);
            }
        }

        return response()->json(['success' => true, 'message' => 'Compra realizada con éxito.']);
    }
}
   
