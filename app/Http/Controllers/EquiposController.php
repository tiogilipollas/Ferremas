<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Importa el modelo Producto
use Illuminate\Support\Facades\DB;

class EquiposController extends Controller
{
    /**
     * Muestra los productos destacados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = DB::table('productos as p')
                    ->join('equiposseguridad as hm', 'p.id_producto', '=', 'hm.id_producto')
                    ->select('p.id_producto', 'p.nombre', 'p.precio', 'hm.*') 
                    ->get();
                    
        $imagenes = [
            13 => '/img/cascos.jfif',
            14 => '/img/guantes.jfif',
            15 => '/img/lentes.webp ',
            16 => '/img/tornillos_anclajes.jpg',
            17 => '/img/fijaciones_adhesivos.jpg',
            18 => '/img/medicion.png'
        ];

        return view('equipos', ['productos' => $productos, 'imagenes' => $imagenes]);
    }
}