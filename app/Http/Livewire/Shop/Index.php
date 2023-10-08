<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $cart_items = \Cart::content();
        return view('livewire.shop.index', compact('cart_items'));
    }
    public function update_quantity($rowId, $qty)
    {
        \Cart::update($rowId, $qty);
        $this->emitTo('shop.cart-component', 'update_quantity');
    }
    public function delete_item($rowId)
    {
        \Cart::remove($rowId);
        $this->emitTo('shop.cart-component', 'delete_item');
    }
}