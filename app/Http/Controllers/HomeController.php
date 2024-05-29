<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cliente = Cliente::all(); // Obtiene todos los clientes de la base de datos
        return view('cliente.index', compact('cliente')); // Pasa la variable $cliente a la vista

        
        $user = Auth::user();
        return view('home', compact('user'));
    }

    /**
     * Store a new client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $cliente = new Cliente;
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;
        $cliente->correo_electronico = $request->correo_electronico;
        // ... asigna los demás campos ...

        $cliente->save();

        return redirect('/home');
    }

}
