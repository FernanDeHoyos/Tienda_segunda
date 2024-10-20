<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Obtener todos los productos
    public function index()
    {
        return Producto::with(['categoria', 'usuario'])->get();
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'id_categoria' => 'required|exists:categorias,id',
            'id_usuario' => 'required|exists:usuarios,id',
        ]);

        $producto = Producto::create($request->all());

        return response()->json($producto, 201);
    }

    // Obtener un producto específico
    public function show($id)
    {
        return Producto::with(['categoria', 'usuario'])->findOrFail($id);
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return response()->json($producto, 200);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return response()->json(null, 204);
    }
}
