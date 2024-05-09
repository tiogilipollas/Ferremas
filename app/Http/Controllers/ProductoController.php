<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Importa el modelo Producto

class ProductoController extends Controller
{
    /**
     * Muestra los productos destacados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::whereIn('id_producto', [6, 7, 9, 10])
                             ->select('nombre', 'precio')
                             ->get();
        
        return view('materiales', ['productos' => $productos]);
    }
}
