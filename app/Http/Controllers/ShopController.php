<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria; // Importa el modelo de Categoria si tienes uno
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todas las categorías para el filtro
        $categorias = Categoria::all();

        // Obtener el ID de la categoría seleccionada
        $categoriaId = $request->input('id_categoria');

        // Filtrar productos por categoría o mostrar todos
        $productos = Producto::where('id_usuario', '!=', auth()->id())
            ->when($categoriaId, function ($query, $categoriaId) {
                return $query->where('id_categoria', $categoriaId);
            })
            ->get();

        return view('shopping.products', compact('productos', 'categorias', 'categoriaId'));
    }

    public function filter(Request $request)
{
    $categoriaId = $request->input('id_categoria');
    $productos = Producto::where('id_usuario', '!=', auth()->id())
        ->when($categoriaId, function ($query, $categoriaId) {
            return $query->where('id_categoria', $categoriaId);
        })
        ->get();

    return view('shopping.partials.product-list', compact('productos'))->render();
}


public function show($id)
{
    // Obtener el producto por ID
    $producto = Producto::findOrFail($id);
    // Obtener los productos relacionados, excluyendo los del mismo usuario
    $productosRelacionados = Producto::where('id_usuario', '!=', $producto->id_usuario)
        ->where('id_categoria', $producto->id_categoria) // Filtrar por la misma categoría
        ->where('id', '!=', $producto->id) // Excluir el producto actual
        ->get();

    // Pasar los detalles del producto y los productos relacionados a la vista
    return view('shopping.show', compact('producto', 'productosRelacionados'));
}

public function compras()
{
    $carrito = session('carrito', []); // Recuperar el carrito desde la sesión
    return view('shopping.compras', compact(var_name: 'carrito'));
}

}
