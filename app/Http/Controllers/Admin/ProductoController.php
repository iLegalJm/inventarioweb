<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductoRequest;
use App\Models\Almacen;
use App\Models\Categoria;
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
        $codigo = $this->generarCodigo();
        $categorias = Categoria::all()->pluck('nombre', 'id');
        return view('admin.productos.create', compact('categorias', 'codigo'));
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

    function generarCodigo()
    {
        // Crea un conjunto de caracteres que se pueden usar para generar el código
        $caracteres = '0123456789';

        // Crea una cadena vacía para almacenar el código
        $codigo = '';

        // Genera 12 números aleatorios
        for ($i = 0; $i < 15; $i++) {
            // Genera un número aleatorio entre 0 y el número de caracteres
            $numero = rand(0, strlen($caracteres) - 1);

            // Agrega el número aleatorio al código
            $codigo .= $caracteres[$numero];
        }

        $cod = (!empty(Producto::where('codigo', '=', $codigo)->first())) ? $this->generarCodigo() : $codigo;
        return $cod;
    }
}