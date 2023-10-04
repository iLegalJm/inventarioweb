<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

use Livewire\WithPagination; // ! SIEMPRE QUE SE USA LA PAGINACION CON LIVEWIRE

class UsersIndex extends Component
{
    use WithPagination; // ! SIEMPRE QUE SE USA LA PAGINACION CON LIVEWIRE

    public $search; //! CREADO PARA HACER UN BUSCADOR
    protected $paginationTheme = "bootstrap";

    /**
     * La función "updatingSearch" restablece la página para una operación de búsqueda.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')->orWhere('email', 'LIKE', '%' . $this->search . '%')->paginate(10);
        return view('livewire.admin.users-index', compact('users'));
    }
}