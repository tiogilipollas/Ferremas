<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $productos = DB::table('productos as p')
            ->join('tipo_producto as tp', 'p.ID_tipo', '=', 'tp.ID_tipo')
            ->whereIn('p.estado', ['activo', 'descontinuado'])
            ->where('p.nombre', 'LIKE', "%{$query}%")
            ->select('p.ID_producto', 'p.nombre', 'p.precio', 'p.stock', 'p.estado', 'tp.descripcion as tipo_producto', 'p.imagen')
            ->get();

        return view('search_results', compact('productos'));
    }
}