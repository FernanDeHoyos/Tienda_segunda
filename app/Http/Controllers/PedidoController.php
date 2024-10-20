<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Obtener todos los pedidos
    public function index()
    {
        return Pedido::with('usuario')->get();
    }

    // Crear un nuevo pedido
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id',
            'total' => 'required|numeric',
            'direccion_envio' => 'required',
        ]);

        $pedido = Pedido::create([
            'id_usuario' => $request->id_usuario,
            'total' => $request->total,
            'direccion_envio' => $request->direccion_envio,
            'fecha_pedido' => now(),
            'estado' => $request->estado ?? 'pendiente',
        ]);

        return response()->json($pedido, 201);
    }

    // Obtener un pedido específico
    public function show($id)
    {
        return Pedido::with(['usuario', 'detallesPedidos'])->findOrFail($id);
    }

    // Actualizar un pedido
    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update($request->all());

        return response()->json($pedido, 200);
    }

    // Eliminar un pedido
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return response()->json(null, 204);
    }
}
