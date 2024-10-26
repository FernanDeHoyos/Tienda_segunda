<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Muestra el formulario para crear un producto.
     */
    public function create()
    {
        // Obtener las categorías para el formulario
        $categorias = Categoria::all();

        return view('productos.create', compact('categorias'));
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
{
    // Validar datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:100',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric|min:0',
        'estado' => 'required|in:nuevo,usado',
        'imagen_url' => 'nullable|url', // Cambiado para aceptar URLs en lugar de archivos
        'id_categoria' => 'required|exists:categorias,id',
    ]);

    // Crear el producto con la URL proporcionada
    Producto::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'estado' => $request->estado,
        'imagen_url' => $request->imagen_url, // Guardar directamente la URL ingresada
        'id_categoria' => $request->id_categoria,
        'id_usuario' => Auth::id(),
        'fecha_publicacion' => now(),
    ]);

    return redirect()->route('productos.index')->with('success', 'Producto agregado exitosamente');
}

public function index()
{
    $productos = Producto::where('id_usuario', auth()->id())->get();
    return view('productos.index', compact('productos'));
}



public function destroy($id)
    {
        // Buscar el producto por su ID y asegurarse de que pertenece al usuario autenticado
        $producto = Producto::where('id', $id)->where('id_usuario', Auth::id())->first();

        // Si el producto no existe o no pertenece al usuario, redireccionar con error
        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado o no autorizado para eliminarlo.');
        }

        // Eliminar la imagen del almacenamiento si existe
        if ($producto->imagen_url) {
            Storage::delete(str_replace('/storage/', 'public/', $producto->imagen_url));
        }

        // Eliminar el producto de la base de datos
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente');
    }

    public function edit($id)
{
    $producto = Producto::where('id', $id)->where('id_usuario', Auth::id())->firstOrFail();
    $categorias = Categoria::all();
    return view('productos.edit', compact('producto', 'categorias'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:100',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric|min:0',
        'estado' => 'required|in:nuevo,usado',
        'imagen_url' => 'nullable|string|max:255',
        'id_categoria' => 'required|exists:categorias,id',
    ]);

    $producto = Producto::where('id', $id)->where('id_usuario', Auth::id())->firstOrFail();
    $producto->update([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'estado' => $request->estado,
        'imagen_url' => $request->imagen_url,
        'id_categoria' => $request->id_categoria,
    ]);

    return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');
}


}