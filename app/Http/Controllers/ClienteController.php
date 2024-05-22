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
        $cliente=Cliente::all();
        return view('cliente.index',compact('cliente'));
        //
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
        $cliente=new Cliente;
        $cliente->nombre=$request->input('nombre');
        $cliente->telefono=$request->input('telefono');
        $cliente->correo_electronico=$request->input('correo_electronico');
        $cliente->save();
        return redirect()->back();

        //
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
    public function edit($id_cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id_cliente)
    {
        $cliente=Cliente::find($id_cliente);
        $cliente->nombre=$request->input('nombre');
        $cliente->telefono=$request->input('telefono');
        $cliente->correo_electronico=$request->input('correo_electronico');
        $cliente->update();
        return redirect()->back();
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_cliente)
    {
        $cliente=Cliente::find($id_cliente);
        $cliente->delete();
        return redirect()->back();
        //
    }
}
