<?php

namespace App\Http\Livewire\Clientes;

use App\Models\Producto;
use Livewire\Component;
use Gloudemans\Shoppingcart\Cart;

class Productos extends Component
{
    public $search;
    public function render()
    {
        $productos = Producto::all();
        return view('livewire.clientes.productos', compact('productos'));
    }

    public function add_to_cart(Producto $producto)
    {
        // dd($producto);
        \Cart::add(
            array(
                'id' => $producto->id,
                'name' => $producto->nombre,
                'price' => $producto->precioventa,
                'qty' => 1,
                'options' => array(),
            )
        );

        $this->emit('message', 'El producto se agrego correctamente');
        $this->emitTo('shop.cart-component', 'add_to_cart');
    }
}