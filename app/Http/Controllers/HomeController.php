<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

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
        $clientes = Cliente::all(); // Obtiene todos los clientes de la base de datos
        $user = Auth::user();
        return view('cliente.index', compact('clientes', 'user')); // Pasa las variables $clientes y $user a la vista
    }

    /**
     * Store a new client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rut' => 'required|unique:cliente,rut|digits:8,',
            'dv_rut' => 'required|size:1',
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo_electronico' => 'required|email',
        ]);

        $cliente = new Cliente;
        $cliente->rut = $request->input('rut');
        $cliente->dv_rut = $request->input('dv_rut');
        $cliente->nombre = $request->input('nombre');
        $cliente->apellido = $request->input('apellido');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->correo_electronico = $request->input('correo_electronico');
        $cliente->save();

        return redirect('/home')->with('success', 'Cliente creado exitosamente');
    }

    /**
     * Update an existing client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $rut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rut)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo_electronico' => 'required|email',
        ]);

        $cliente = Cliente::where('rut', $rut)->firstOrFail();
        $cliente->nombre = $request->input('nombre');
        $cliente->apellido = $request->input('apellido');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->correo_electronico = $request->input('correo_electronico');
        $cliente->update();

        return redirect('/home')->with('success', 'Cliente actualizado exitosamente');
    }

    /**
     * Remove the specified client from storage.
     *
     * @param  int  $rut
     * @return \Illuminate\Http\Response
     */
    public function destroy($rut)
    {
        $cliente = Cliente::where('rut', $rut)->firstOrFail();
        $cliente->delete();

        return redirect('/home')->with('success', 'Cliente eliminado exitosamente');
    }
}
