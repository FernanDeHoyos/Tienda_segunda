<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    // Obtener todos los detalles de pedidos
    public function index()
    {
        return DetallePedido::with(['pedido', 'producto'])->get();
    }

    // Crear un nuevo detalle de pedido
    public function store(Request $request)
    {
        $request->validate([
            'id_pedido' => 'required|exists:pedidos,id',
            'id_producto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric',
        ]);

        $detallePedido = DetallePedido::create($request->all());

        return response()->json($detallePedido, 201);
    }

    // Obtener un detalle de pedido específico
    public function show($id)
    {
        return DetallePedido::with(['pedido', 'producto'])->findOrFail($id);
    }

    // Actualizar un detalle de pedido
    public function update(Request $request, $id)
    {
        $detallePedido = DetallePedido::findOrFail($id);
        $detallePedido->update($request->all());

        return response()->json($detallePedido, 200);
    }

    // Eliminar un detalle de pedido
    public function destroy($id)
    {
        $detallePedido = DetallePedido::findOrFail($id);
        $detallePedido->delete();

        return response()->json(null, 204);
    }
}
