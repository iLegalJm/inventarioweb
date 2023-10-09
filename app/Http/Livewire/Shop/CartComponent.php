<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class CartComponent extends Component
{
    public $cart;
    protected $listeners = [
        'add_to_cart' => 'render',
        'update_quantity' => 'render',
        'delete_item' => 'render'
    ];
    public function render()
    {
        return view('livewire.shop.cart-component');
    }
}