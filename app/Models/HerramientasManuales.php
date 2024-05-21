<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HerramientasManuales extends Model
{
    protected $table = 'HerramientasManuales'; // Asegúrate de que el nombre de la tabla esté en mayúsculas y minúsculas según corresponda.

    protected $fillable = ['ID_producto'];
    
    public $timestamps = false;
}