<?php

namespace App\Http\Livewire\Clientes;

use App\Models\Producto;
use Livewire\Component;
// use Gloudemans\Shoppingcart\Cart;
use Mindscms\LaravelShoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class Productos extends Component
{
    public $search;
    public function render()
    {
        // $productos = Producto::where('nombre', 'like', '%' . $this->search . '%')->get();
        $productos = Producto::where('nombre', 'like', '%' . $this->search . '%')->get();
        return view('livewire.clientes.productos', compact('productos'));
    }

    public function add_to_cart(Producto $producto)
    {

        \Cart::add(
            array(
                'id' => $producto->id,
                'name' => $producto->nombre,
                'price' => $producto->precioventa,
                'qty' => 1,
                'options' => array(),
            )
        );

        // \Cart::save();
        $this->emit('message', 'El producto se agrego correctamente');
        $this->emitTo('shop.cart-component', 'add_to_cart');
    }
}