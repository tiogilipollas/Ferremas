<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $productos = Producto::where('nombre', 'LIKE', "%{$query}%")->get();

        return view('search_results', compact('productos'));
    }
}