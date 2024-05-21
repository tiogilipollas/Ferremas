<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\HerramientasManuales;
use App\Models\MaterialesBasicos;
use App\Models\EquiposSeguridad;

class AgregarProductosController extends Controller
{
    public function create()
    {
        return view('agregarproductos');
    }

    public function store(Request $request)
    {
        // Validar y crear el producto en la tabla Productos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'required|string|max:255',
        ]);
    
        // Obtener el último ID de producto creado
        $ultimoID = Producto::max('ID_producto');
    
        // Asegurar que la ID del próximo producto comience desde 19
        $proximoID = max(19, $ultimoID + 1);
    
        // Crear el producto
        $producto = Producto::create([
            'ID_producto' => $proximoID,
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'descripcion' => $request->descripcion,
        ]);
    
        // Verificar si el producto se creó correctamente
        if ($producto) {
            // Insertar en la tabla correspondiente según la descripción
            switch ($producto->descripcion) {
                case 'Herramientas Manuales':
                case 'Herramientas Eléctricas':
                    HerramientasManuales::create(['ID_producto' => $proximoID]);
                    break;
                case 'Materiales Básicos':
                case 'Acabados':
                    MaterialesBasicos::create(['ID_producto' => $proximoID]);
                    break;
                case 'Equipos de Seguridad':
                case 'Accesorios Varios':
                    EquiposSeguridad::create(['ID_producto' => $proximoID]);
                    break;
                default:
                    // Manejar otro caso o error si la descripción no coincide
                    break;
            }
    
            return redirect()->route('agregarproductos.create')->with('success', 'Producto agregado exitosamente');
        } else {
            return back()->withInput()->with('error', 'No se pudo agregar el producto');
        }
    }
}