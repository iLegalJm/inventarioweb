<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IngresoRequest;
use App\Models\Detalleingresosalida;
use App\Models\Ordeningresosalida;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdeningresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingresos = Ordeningresosalida::all();
        // $ingresos = Ordeningresosalida::all();
        // $this->e
        return view('admin.ingresos.index', compact('ingresos'));
        // foreach ($ingresos as $ingreso) {
        // echo $ingreso->detalleingresosalida;

        # code...
// }
        //     foreach ($ingreso->detalleingresosalida as $in) {
        //         echo $in->producto;
        //         echo "<br>";
        //     }
        //     echo "<br>";
        // }
        // return $ingresos[0]->producto;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $idestados = [
            1 => 'Pendiente',
            2 => 'Realizado'
        ];
        $productos = Producto::all()->where('stock', '>', 0)->pluck('nombre', 'id');
        return view('admin.ingresos.create', compact('idestados', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IngresoRequest $request)
    {
        $ingreso = Ordeningresosalida::create($request->all());

        $cont = 0;

        while ($cont < count($request->producto_id)) {
            $ingreso->detalleingresosalida()->create([
                'cantidad' => $request->cantidad[$cont],
                'costo' => $request->costo[$cont],
                'producto_id' => $request->producto_id[$cont]
            ]);
            $cont++;
        }
        return redirect()->route('admin.ingresos.index')->with('info', 'Se registro el ingreso correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ordeningresosalida $ingreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ordeningresosalida $ingreso)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ordeningresosalida $ingreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ordeningresosalida $ingreso)
    {
        //
    }
}