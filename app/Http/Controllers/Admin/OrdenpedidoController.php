<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ordenpedido;
use App\Models\Ordenventa;
use Illuminate\Http\Request;

class OrdenpedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordenpedidos = Ordenpedido::all()->where('idestado', '=', 1);
        return view('admin.pedidos.index', compact('ordenpedidos'));
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
    public function show(Ordenpedido $ordenpedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($codigo)
    {
        $ordenpedido = Ordenpedido::where('codigo', '=', $codigo)->first();
        return view('admin.pedidos.edit', compact('ordenpedido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigo)
    {
        $request->validate([
            'importepago' => "required|numeric|min:$request->total"
        ]);
        $ordenpedido = Ordenpedido::where('codigo', '=', $codigo)->update(['idestado' => 2]);

        Ordenventa::create([
            'codigo' => $request->codigo,
            'idtipopago' => 'efectivo',
            'idestado' => 1,
            'total' => $request->total,
            'subtotal' => round(($request->total) - ($request->total * 0.18), 2),
            'impuestovta' => round($request->total * 0.18, 2),
            'importepago' => $request->importepago,
            'importevuelto' => round($request->importepago - $request->total, 2),
            'ordenpedido_id' => $codigo
        ]);
        return redirect()->route('admin.ordenpedidos.index');
        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ordenpedido $ordenpedido)
    {
        //
    }
}