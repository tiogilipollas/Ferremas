<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgregarProductosController extends Controller
{
    public function create()
    {
        // Obtener todas las descripciones de tipo de producto desde la base de datos
        $tiposProductos = DB::table('Tipo_producto')->pluck('descripcion', 'ID_tipo');

        return view('agregarproductos', compact('tiposProductos'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'ID_producto' => 'required|integer',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'ID_tipo' => 'required|integer',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verificar si el ID del producto ya existe en la base de datos
        if (DB::table('Productos')->where('ID_producto', $request->ID_producto)->exists()) {
            // Si el ID del producto ya existe, mostrar un mensaje de error y redirigir de vuelta al formulario
            return back()->withInput()->with('error', 'La ID del producto ya existe en la base de datos');
        }

        // Almacenar la imagen en el sistema de archivos de Laravel
        $nombreImagen = time() . '_' . $request->file('imagen')->getClientOriginalName();
        $request->file('imagen')->move(public_path('img'), $nombreImagen);

        // Insertar el producto en la base de datos
        DB::table('Productos')->insert([
            'ID_producto' => $request->ID_producto,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'nombre' => $request->nombre,
            'ID_tipo' => $request->ID_tipo,
            'imagen' => $nombreImagen,
        ]);

        // Redirigir al usuario a donde desees después de la inserción
        return redirect()->route('agregarproductos.create')->with('success', 'Producto agregado exitosamente');
    }
}