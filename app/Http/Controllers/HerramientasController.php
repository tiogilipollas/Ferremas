<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Importa el modelo Producto
use Illuminate\Support\Facades\DB;

class HerramientasController extends Controller
{
    /**
     * Muestra los productos destacados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = DB::table('productos as p')
        ->join('tipo_producto as tp', 'p.ID_tipo', '=', 'tp.ID_tipo')
        ->whereIn('p.ID_tipo', [1, 2])
        ->whereIn('p.estado', ['activo', 'descontinuado']) 
        ->select('p.ID_producto', 'p.nombre', 'p.precio', 'p.stock','p.estado', 'tp.descripcion as tipo_producto', 'p.imagen')
        ->get();

        return view('herramientas', ['productos' => $productos]);
    }
}