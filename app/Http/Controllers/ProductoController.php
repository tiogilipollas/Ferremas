<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Importa el modelo Producto
use App\Models\TipoProducto; // Importa el modelo TipoProducto
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Muestra los productos destacados.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Muestra la lista de todos los productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $request)
{
    $categoria = $request->input('categoria');

    // Si se selecciona una categoría, filtramos los productos por esa categoría
    if ($categoria) {
        $categorias = [
            'herramientas' => [1, 2],
            'materiales' => [3, 4],
            'equipos' => [5, 6],
        ];

        $tipoIds = $categorias[$categoria] ?? [];

        $productos = Producto::whereIn('ID_tipo', $tipoIds)->get();
    } else {
        // Si no se selecciona ninguna categoría, mostramos todos los productos
        $productos = Producto::all();
    }

    return view('productos.index', compact('productos', 'categoria'));
}



    /**
     * Muestra el formulario para editar un producto existente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $tipos = TipoProducto::all();
        return view('productos.edit', compact('producto', 'tipos'));
    }

    /**
     * Actualiza un producto existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->ID_tipo = $request->ID_tipo; // Aquí se asigna el valor del campo ID_tipo del formulario
        $producto->save();
        return redirect()->route('productos.listar');
    }
    

    /**
     * Elimina un producto existente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return redirect()->route('productos.listar');
    }
}