<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'ID_producto';
    public $timestamps = false;

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
        return $this->belongsTo(TipoProducto::class, 'ID_tipo', 'ID_tipo');
    }
}