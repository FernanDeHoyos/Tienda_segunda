<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        dd(vars: Auth::check());
        if (!Auth::check()) {
            dd(vars: Auth::check());
            return redirect()->route('login'); // Redirige a la página de inicio de sesión si no está autenticado
        }

        // Asegúrate de que aquí se puede acceder al usuario autenticado
        $usuario = Auth::user(); // Esto no debería ser null
        return view('dashboard', compact('usuario')); 
    }
}
