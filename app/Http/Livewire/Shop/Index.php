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
}