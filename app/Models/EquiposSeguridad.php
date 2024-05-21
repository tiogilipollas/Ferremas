<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquiposSeguridad extends Model
{
    protected $table = 'EquiposSeguridad'; // Asegúrate de que el nombre de la tabla esté en mayúsculas y minúsculas según corresponda.

    protected $fillable = ['ID_producto'];
    
    public $timestamps = false;
}
