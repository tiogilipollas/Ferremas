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
        $producto->descripcion = $request->descripcion; 
        $producto->ID_tipo = $request->ID_tipo;
    
        // Verificar si el stock es 0 y actualizar el estado a 'descontinuado'
        if ($request->stock == 0) {
            $producto->estado = 'descontinuado';
            $producto->stock = 0; // Asegurar que el stock se actualice a 0
        } else {
            $producto->stock = $request->stock; // Actualizar el stock con el valor proporcionado
            // Si el estado es 'activo', asegurar que el stock sea al menos 1
            if ($request->estado == 'activo' && $producto->stock < 1) {
                $producto->stock = 1;
            }
            $producto->estado = $request->estado; // Actualizar el estado con el valor proporcionado
        }
    
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
        $producto->descripcion = $request->descripcion;
        $producto->ID_tipo = $request->ID_tipo;

        // Verificar si el stock es 0 y actualizar el estado a 'descontinuado'
        if ($producto->stock == 0) {
            $producto->estado = 'descontinuado';
        } 

        $producto->save();
        return redirect()->route('administracionproductos.listaadmin');
    }

    public function destroyadmin($id)
    {

        DB::table('detalleproveedor')->where('ID_producto', $id)->delete();

        $producto = Producto::find($id);
        $producto->delete();

        return redirect()->route('administracionproductos.listaadmin');
    }

        public function getCarouselProducts()
    {
        // Obtiene solo los productos activos para el carrusel
        $productos = Producto::where('estado', 'activo')->limit(1000)->get();
        return $productos;
    }
        public function show($ID_producto)
    {
        // Asegura que solo se muestren los productos activos
        $producto = Producto::where('ID_producto', $ID_producto)->where('estado', 'activo')->first();
        $productosCarousel = $this->getCarouselProducts(); // Continúa obteniendo solo productos activos para el carrusel

        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado o inactivo');
        }

        return view('productos.show', compact('producto', 'productosCarousel'));
    }
    
    public function updateEstado(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $estado = $request->get('estado');
    
        // Si el estado es 'descontinuado', establecer el stock a 0
        if ($estado == 'descontinuado') {
            $producto->stock = 0;
        }else{
            $producto->stock = 1;
        }
    
        $producto->estado = $estado;
        $producto->save();
    
        return redirect()->back()->with('success', 'El estado del producto ha sido actualizado correctamente.');
    }

}