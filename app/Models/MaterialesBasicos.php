<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialesBasicos extends Model
{
    protected $table = 'MaterialesBasicos'; // Asegúrate de que el nombre de la tabla esté en mayúsculas y minúsculas según corresponda.

    protected $fillable = ['ID_producto'];
    
    public $timestamps = false;
}
