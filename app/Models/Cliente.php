<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    protected $primaryKey= 'id_cliente';
    protected $fillable= ['nombre','apellido','direccion','telefono','correo_electronico'];
    protected $guarded=[];
    public $timestamps=false;

}
