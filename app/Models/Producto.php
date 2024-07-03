<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos'; // Asegura que el modelo use la tabla 'productos'.
    protected $primaryKey = 'ID_producto'; // Establece 'ID_producto' como la clave primaria.
    public $timestamps = false; // Desactiva los timestamps si no los usas.

    protected $fillable = [
        'nombre',
        'precio',
        'stock',
        'descripcion',
        'ID_tipo',
        'imagen',
        'estado', 
    ];

    public function tipoProducto()
    {
        // Define una relación de pertenencia a TipoProducto.
        return $this->belongsTo(TipoProducto::class, 'ID_tipo', 'ID_tipo');
    }

    public function compras()
    {
        // Define una relación muchos a muchos con Compra.
        // Asegúrate de que 'producto_id' y 'compra_id' coincidan con las columnas en tu tabla pivot 'compra_producto'.
        return $this->belongsToMany(Compra::class, 'compra_producto', 'producto_id', 'compra_id')
                    ->withPivot('cantidad');
    }
}