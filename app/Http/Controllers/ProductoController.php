<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Importa el modelo Producto
use App\Models\TipoProducto; // Importa el modelo TipoProducto
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function listar(Request $request)
    {
        $categoria = $request->input('categoria');

        if ($categoria) {
            $categorias = [
                'herramientas' => [1, 2],
                'materiales' => [3, 4],
                'equipos' => [5, 6],
            ];

            $tipoIds = $categorias[$categoria] ?? [];

            $productos = Producto::whereIn('ID_tipo', $tipoIds)->get();
        } else {
            $productos = Producto::all();
        }

        return view('productos.index', compact('productos', 'categoria'));
    }

    public function edit($id)
    {
        $producto = Producto::find($id);
        $tipos = TipoProducto::all();
        return view('productos.edit', compact('producto', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion; // Agregado aquí
        $producto->ID_tipo = $request->ID_tipo;
        $producto->save();
        return redirect()->route('productos.listar');
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return redirect()->route('productos.listar');
    }

    public function listaadmin(Request $request)
    {
        $categoria = $request->input('categoria');

        if ($categoria) {
            $categorias = [
                'herramientas' => [1, 2],
                'materiales' => [3, 4],
                'equipos' => [5, 6],
            ];

            $tipoIds = $categorias[$categoria] ?? [];

            $productos = Producto::whereIn('ID_tipo', $tipoIds)->get();
        } else {
            $productos = Producto::all();
        }

        return view('productos.adminindex', compact('productos', 'categoria'));
    }

    public function editadmin($id)
    {
        $producto = Producto::find($id);
        $tipos = TipoProducto::all();
        return view('productos.editadmin', compact('producto', 'tipos'));
    }

    public function updateadmin(Request $request, $id)
    {
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion; // Agregado aquí
        $producto->ID_tipo = $request->ID_tipo; 
        $producto->save();
        return redirect()->route('administracionproductos.listaadmin');
    }

    public function destroyadmin($id)
    {
        DB::table('detallepedidos')->where('id_producto', $id)->delete();
        DB::table('detalleproveedor')->where('ID_producto', $id)->delete();

        $producto = Producto::find($id);
        $producto->delete();

        return redirect()->route('administracionproductos.listaadmin');
    }

    public function getCarouselProducts()
    {
        $productos = Producto::limit(1000)->get(); // Obtiene los primeros 5 productos
        return $productos;
    }
    public function show($ID_producto)
    {
        $producto = Producto::find($ID_producto);
        $productosCarousel = $this->getCarouselProducts(); // Obtiene los productos para el carrusel

        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado');
        }

        return view('productos.show', compact('producto', 'productosCarousel'));
    }
}