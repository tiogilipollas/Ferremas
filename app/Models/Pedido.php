<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'Pedido';

    protected $fillable = [
        'ID_cliente',
        'fecha',
        'estado',
        'total',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'ID_cliente');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'ID_pedido');
    }
}
?>