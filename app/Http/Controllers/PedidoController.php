<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PedidoController extends Controller
{
    public function guardarPedido(Request $request)
{
    // Obtener el id del usuario desde la sesión
    $idUsuario = auth()->id();
    $carrito = json_decode($request->carrito, true); // Obtener el carrito desde el frontend (usamos JSON)

    if (empty($carrito)) {
        return redirect()->back()->with('error', 'El carrito está vacío.');
    }

    // Calcular el total del carrito
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    // Crear un nuevo pedido
    $pedido = Pedido::create([
        'id_usuario' => $idUsuario,
        'total' => $total,
        'direccion_envio' => $request->direccion_envio,
        'fecha_pedido' => Carbon::now(),
        'estado' => 'pendiente',
    ]);

    // Guardar los detalles del pedido
    foreach ($carrito as $id => $item) {
        DetallePedido::create([
            'id_pedido' => $pedido->id,
            'id_producto' => $id,
            'cantidad' => $item['cantidad'],
            'precio_unitario' => $item['precio'],
        ]);
    }

    // Obtener los pedidos realizados por el usuario
    $pedidos = Pedido::where('id_usuario', $idUsuario)->get();

    // Redirigir a la página de éxito con los pedidos del usuario
    return view('shopping.pedido', [
        'pedidos' => $pedidos
    ])->with('success', 'Pedido realizado con éxito.');
}

public function verPedidos()
{
    // Obtener el id del usuario autenticado
    $idUsuario = auth()->id();

    // Obtener los pedidos con sus detalles (usando el nombre detallesPedidos)
    $pedidos = Pedido::with('detallesPedidos') // Cargar detalles del pedido
        ->where('id_usuario', $idUsuario)
        ->orderBy('fecha_pedido', 'desc')
        ->get();

    // Pasar los pedidos a la vista
    return view('shopping.pedido', compact('pedidos'));
}


}
