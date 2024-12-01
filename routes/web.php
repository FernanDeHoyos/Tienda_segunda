<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/index', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{producto}', action: [ProductoController::class, 'destroy'])->name('productos.destroy');

    Route::get('/productos/show/{id}', [ShopController::class, 'show'])->name('shopping.show');
    Route::get('/producto/{id}/agregar', [CarritoController::class, 'agregarAlCarrito'])->name('shopping.agregarAlCarrito');
    Route::get('/shopping', [ShopController::class, 'index'])->name('shopping.index');
    Route::get('/shopping/filter', action: [ShopController::class, 'filter'])->name('shopping.filter');
    Route::get('/compra', [ShopController::class, 'compras'])->name(name: 'shopping.compras');

    Route::post('/guardar-pedido', [PedidoController::class, 'guardarPedido'])->name('guardar.pedido');
Route::get('/pedido-exito', function() {
    return view('shopping.pedido');
})->name('shopping.pedido');

Route::get('/pedidos', [PedidoController::class, 'verPedidos'])->name('shopping.pedido');

});

Auth::routes(['verify' => false]);

Route::get('/home', [ShopController::class, 'index'])->name('home')->middleware('auth');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
