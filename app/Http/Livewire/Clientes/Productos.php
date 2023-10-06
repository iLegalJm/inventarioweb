<?php

namespace App\Http\Livewire\Clientes;

use App\Models\Producto;
use Livewire\Component;

class Productos extends Component
{
    public function render()
    {
        $productos = Producto::all();
        return view('livewire.clientes.productos', compact('productos'));
    }
}