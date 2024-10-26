<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'id_usuario',
        'total',
        'direccion_envio',
        'fecha_pedido',
        'estado',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function detallesPedidos()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido');
    }
}
