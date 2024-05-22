<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    protected $table = 'tipo_producto';
    protected $primaryKey = 'ID_tipo';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'ID_tipo', 'ID_tipo');
    }
}