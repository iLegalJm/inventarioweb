<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $productos = Producto::where('marca', 'asus')->paginate(10);
        // foreach ($productos as $producto) {
        //     if () {
        //         echo $producto->productofoto;
        //         echo "<br>";
        //     }

        // }
        return view('productos.index');
    }

    public function carrito()
    {
        return view('productos.carrito');
    }

    public function checkout(){
        return view('productos.checkout');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        // $cartItem = \Cart::add(
        //     array(
        //         'id' => $producto->id,
        //         'name' => $producto->nombre,
        //         'price' => $producto->precioventa,
        //         'qty' => 4,
        //         'options' => array(),
        //     )
        // );

        // Cart::associate($cartItem->rowId, 'Producto');

        // $cartItem->associate('Producto');

        // \Cart::add(
        //     array(
        //         'id' => $producto->id,
        //         'name' => $producto->nombre,
        //         'price' => $producto->precioventa,
        //         'qty' => 4,
        //         'options' => array(),
        //     )
        // );
        // return \Cart::update('027c91341fd5cf4d2579b49c4b6a90da', 2);
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}