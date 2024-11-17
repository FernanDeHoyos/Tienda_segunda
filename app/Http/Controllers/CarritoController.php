<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    // En tu controlador de Producto o Carrito
public function agregarAlCarrito($id)
{
    $producto = Producto::find($id);
    if (!$producto) {
        return redirect()->route('productos.index')->with('error', 'Producto no encontrado');
    }

    // Obtener el carrito de la sesión
    $carrito = session()->get('carrito', []);

    // Si el producto ya está en el carrito, incrementar la cantidad
    if (isset($carrito[$id])) {
        $carrito[$id]['cantidad']++;
    } else {
        // Si el producto no está, agregarlo al carrito
        $carrito[$id] = [
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'cantidad' => 1,
            'imagen' => $producto->imagen_url
        ];
    }

    // Guardar el carrito en la sesión
    session()->put('carrito', $carrito);

    return redirect()->route('productos.show', $id);
}


    public function ver()
    {
        $carrito = session()->get('carrito', []);
        return response()->json($carrito);
    }

    public function eliminar(Request $request)
    {
        $carrito = session()->get('carrito', []);
        unset($carrito[$request->producto_id]);
        session()->put('carrito', $carrito);

        return response()->json(['success' => 'Producto eliminado del carrito.']);
    }
}
