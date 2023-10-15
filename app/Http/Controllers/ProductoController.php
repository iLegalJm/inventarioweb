<?php

namespace App\Http\Controllers;

use App\Models\Detalleproducto;
use Illuminate\Http\Request;
use App\Models\Producto;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;

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
        // $detalleproductos = Detalleproducto::where('cantidad', '>', 0)->get();
        // $productos = Producto::whereHas('detalleproducto', function ($query) {
        //     $query->where('cantidad', '>', 1);
        // })->get();
        return view('productos.index');
        // return Detalleproducto::select('detalleproducto.id', '');
        // foreach ($detalleproductos as $detalleproducto) {
        //     $producto = $detalleproducto->producto;
        //     $productofotos = $producto->productofoto;
        // foreach ($productofotos as $productofoto) {
        //     echo $productofoto;
        //     echo "<br>";
        // }
        // for ($i = 0; $i < 2; $i++) {
        //     if (isset($productofotos[$i])) {
        //         echo $productofotos[$i];
        //         echo "<br>";
        //     }

        // }
        // }

    }

    public function carrito()
    {
        return view('productos.carrito');
    }

    public function checkout()
    {
        SDK::setAccessToken(config('services.mercadopago.token'));

        if (\Cart::content() != []) {
            $preference = new Preference();

            $cart_items = \Cart::content();

            foreach ($cart_items as $items) {
                $item = new Item();
                $item->title = 'Producto';
                $item->quantity = $items->qty;
                $item->unit_price = $items->price;

                $products[] = $item;
            }

            $preference->back_urls = array(
                'success' => route('ordenpedidos.storeonline'),
                'failure' => 'https://www.tu-sitio/success',
                'pending' => 'https://www.tu-sitio/success',
            );

            $preference->auto_return = "approved";

            $preference->items = $products;
            $preference->save();
        } else {
            $preference = new Preference();
        }
        return view('productos.checkout', compact('preference'));
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