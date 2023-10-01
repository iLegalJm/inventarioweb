<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductoRequest;
use App\Models\Almacen;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        $producto = Producto::create($request->all());

        if ($request->file('imagen')) {
            foreach ($request->file('imagen') as $imagen) {
                $url = Storage::put('productos', $imagen);
                $producto->productofoto()->create([
                    'url' => $url
                ]);
            }
        }

        return redirect()->route('admin.productos.edit', $producto)->with('info', 'El producto se creó con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto)
    {
        $producto->update($request->all());

        if ($request->file('imagen')) {
            foreach ($request->file('imagen') as $key => $imagen) {
                $url = Storage::put('productos', $imagen);
                if (!empty($producto->productofoto[$key])) {
                    Storage::delete($producto->productofoto[$key]->url);
                    $producto->productofoto()->find($producto->productofoto[$key]->id)->update([
                        'url' => $url
                    ]);
                } else {
                    $producto->productofoto()->create([
                        'url' => $url
                    ]);
                }
            }
        }

        // echo $producto->productofoto;
        return redirect()->route('admin.productos.edit', $producto)->with('info', 'El producto se actualizó con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}