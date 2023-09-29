<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $almacenes = Almacen::all();
        return view('admin.almacenes.index', compact('almacenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.almacenes.create');
        ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:almacenes'
        ]);
        $almacene = Almacen::create($request->all());
        return redirect()->route('admin.almacenes.edit', $almacene)->with('info', 'El almacén se creó con éxito.');
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Almacen $almacene)
    {
        return view('admin.almacenes.show', compact('almacene'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Almacen $almacene)
    {
        return view('admin.almacenes.edit', compact('almacene'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Almacen $almacene)
    {
        $request->validate([
            'nombre' => 'required|unique:almacenes'
        ]);
        $almacene->update($request->all());
        return redirect()->route('admin.almacenes.edit', $almacene)->with('info', 'El almacén se actualizó con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Almacen $almacene)
    {
        $almacene->delete();
        return redirect()->route('admin.almacenes.index')->with('info', 'El almacen se eliminó con éxito.');
    }
}