<?php

namespace App\Http\Controllers;



class ComprasController extends  Controller
{
    public function index()
{
    $carrito = session('carrito', []); // Recuperar el carrito desde la sesión
    return view('shopping.comras', compact(var_name: 'carrito'));
}

}
