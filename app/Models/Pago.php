<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'Pago';

    protected $fillable = [
        'ID_pedido',
        'monto',
        'fecha',
        'tipo_pago',
        'cuotas',
        'numero_tarjeta',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'ID_pedido');
    }
}
?>