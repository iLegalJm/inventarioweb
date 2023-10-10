<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Almacen;
use App\Models\Detalleingresosalida;
use App\Models\Detallepedido;
use App\Models\Inventarioalmacen;
use App\Models\Ordeningresosalida;
use App\Models\Ordenpedido;
use App\Models\Ordenventa;
use App\Models\Producto;
use App\Models\Registroinventario;
use Illuminate\Http\Request;

class OrdensalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $salidas = Ordeningresosalida::all()->where('idmovimientoiventario', 2);
        $salidas = Ordeningresosalida::all()->where('idmovimientoiventario', 2);
        return view('admin.salidas.index', compact('salidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $codigo = $this->generarCodigo();
        $almacenes = Almacen::all()->pluck('nombre', 'id');
        $ordenventas = Ordenventa::all()->where('idestado', '=', 1)->pluck('codigo', 'codigo');
        // Ordenpedido::where('codigo', '=', $codigo)->update(['idestado' => 2]);
        return view('admin.salidas.create', compact('codigo', 'almacenes', 'ordenventas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $salida = Ordeningresosalida::create([
            'idmovimientoiventario' => 2,
            'codigo' => $request->codigo,
            'idestado' => 2
        ]);

        $detallepedido = Detallepedido::all()->where('ordenpedido_id', $request->codigo);
        foreach ($detallepedido as $detalle) {
            $detallesalida = $salida->detalleingresosalida()->create([
                'cantidad' => $detalle->cantidad,
                'costo' => $detalle->valor_vta,
                'producto_id' => $detalle->producto_id
            ]);

            Registroinventario::create([
                'idmovimientoiventario' => 2,
                'cantidad' => $detallesalida->cantidad,
                'descripcion' => $detallesalida->descripcion,
                'detalleingresosalida_id' => $detallesalida->id,
                'almacen_id' => $request->almacen_id
            ]);

            //! OBTENGO EL PRODUCTO A MODIFICAR EL STOCK, EN ESTE CASO LA TABLA DETALLE PRODUCTOS
            $detalleproducto = Producto::find($detalle->producto_id)->detalleproducto->where('almacen_id', $request->almacen_id)->first();

            Inventarioalmacen::create([
                'cantidadinicial' => $detalleproducto->cantidad,
                'cantidadingreso' => 0,
                'cantidadsalida' => $detallesalida->cantidad,
                'stock' => ($detalleproducto->cantidad - $detallesalida->cantidad),
                'costo' => $detallesalida->costo,
                'producto_id' => $detallesalida->producto_id,
                'almacen_id' => $request->almacen_id
            ]);
        }
        return redirect()->route('admin.salidas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function generarCodigo()
    {
        // Crea un conjunto de caracteres que se pueden usar para generar el código
        $caracteres = '0123456789';

        // Crea una cadena vacía para almacenar el código
        $codigo = '';

        // Genera 12 números aleatorios
        for ($i = 0; $i < 16; $i++) {
            // Genera un número aleatorio entre 0 y el número de caracteres
            $numero = rand(0, strlen($caracteres) - 1);

            // Agrega el número aleatorio al código
            $codigo .= $caracteres[$numero];
        }

        $cod = (!empty(Ordeningresosalida::where('codigo', '=', $codigo)->first())) ? $this->generarCodigo() : $codigo;
        return $cod;
    }
}