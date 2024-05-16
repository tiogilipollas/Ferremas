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
                    ->join('herramientasmanuales as hm', 'p.id_producto', '=', 'hm.id_producto')
                    ->select('p.id_producto', 'p.nombre', 'p.precio', 'hm.*') 
                    ->get();
                    
        $imagenes = [
            1 => '/img/martillo.jpg',
            2 => '/img/destornillador.jpg',
            3 => '/img/llave.jpg',
            4 => '/img/taladro.jpg',
            5 => '/img/sierra.jpg',
            6 => '/img/lijadora.jpg'
        ];

        return view('herramientas', ['productos' => $productos, 'imagenes' => $imagenes]);
    }
}