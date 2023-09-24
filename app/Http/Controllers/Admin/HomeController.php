<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Almacen;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $almacenes = Almacen::all();
        return view('admin.index', compact('almacenes'));
    }

    public function almacen(Almacen $almacen)
    {
        return view('admin.almacen.index', compact('almacen'));
    }
}