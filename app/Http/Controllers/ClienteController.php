<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rut' => 'required|digits:8|unique:clientes,rut',
            'dv_rut' => 'required|digits:1',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo_electronico' => 'required|email|max:255',
            'estado' => 'required|string|in:Activo,Inactivo',
        ], [
            'rut.unique' => 'El RUT ya está registrado.',
            'rut.digits' => 'El RUT debe tener exactamente 8 dígitos.',
            'dv_rut.digits' => 'El Dígito Verificador debe tener exactamente 1 dígito.',
        ]);

        $cliente = new Cliente;
        $cliente->rut = $request->input('rut');
        $cliente->dv_rut = $request->input('dv_rut');
        $cliente->nombre = $request->input('nombre');
        $cliente->apellido = $request->input('apellido');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->correo_electronico = $request->input('correo_electronico');
        $cliente->estado = $request->input('estado');
        $cliente->save();

        return redirect()->back()->with('success', 'Cliente creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($rut)
    {
        $cliente = Cliente::where('rut', $rut)->firstOrFail();
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $rut)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo_electronico' => 'required|email',
            'estado' => 'required|string|in:Activo,Inactivo',
        ]);

        $cliente = Cliente::where('rut', $rut)->firstOrFail();
        $cliente->nombre = $request->input('nombre');
        $cliente->apellido = $request->input('apellido');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->correo_electronico = $request->input('correo_electronico');
        $cliente->estado = $request->input('estado');
        $cliente->update();

        return redirect()->back()->with('success', 'Cliente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rut)
    {
        $cliente = Cliente::where('rut', $rut)->firstOrFail();
        $cliente->delete();

        return redirect()->back()->with('success', 'Cliente eliminado exitosamente');
    }
}
