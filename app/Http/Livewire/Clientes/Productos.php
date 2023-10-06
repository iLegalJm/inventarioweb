<?php

namespace App\Http\Livewire\Clientes;

use App\Models\Producto;
use Livewire\Component;

class Productos extends Component
{
    public $search;
    public function render()
    {
        $productos = Producto::where('nombre', 'like', '%'. $this->search. '%')->get();
        return view('livewire.clientes.productos', compact('productos'));
    }
}