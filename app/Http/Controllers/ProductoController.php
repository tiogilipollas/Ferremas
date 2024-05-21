<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Importa el modelo Producto
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Muestra los productos destacados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = DB::table('productos as p')
                    ->join('materialesbasicos as hm', 'p.id_producto', '=', 'hm.id_producto')
                    ->select('p.id_producto', 'p.nombre', 'p.precio','p.imagen','hm.*') 
                    ->get();

    
    
        return view('materiales', ['productos' => $productos]);
    }
}