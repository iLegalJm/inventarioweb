<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IngresoRequest;
use App\Models\Almacen;
use App\Models\Detalleingresosalida;
use App\Models\Detalleproducto;
use App\Models\Inventarioalmacen;
use App\Models\Ordeningresosalida;
use App\Models\Producto;
use App\Models\Registroinventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdeningresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingresos = Ordeningresosalida::all()->where('idmovimientoiventario', 1);
        return view('admin.ingresos.index', compact('ingresos'));
        // $producto = Detalleproducto::all()->where('almacen_id', 2)->where('producto_id', 1)->first();
        // if (empty($producto)) {
        //     $productoCantidad = 0;
        // } else {
        //     $productoCantidad = ($producto->cantidad != 0) ? $producto->cantidad : 0;
        // }
        // var_dump($productoCantidad);
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
        $codigo = $this->generarCodigo();
        $productos = Producto::all()->pluck('nombre', 'id');
        $almacenes = Almacen::all()->pluck('nombre', 'id');
        return view('admin.ingresos.create', compact('idestados', 'productos', 'almacenes', 'codigo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IngresoRequest $request)
    {
        $ingreso = Ordeningresosalida::create([
            'idmovimientoiventario' => 1,
            'codigo' => $request->codigo,
            'idestado' => $request->idestado,
        ]);

        $cont = 0;

        while ($cont < count($request->producto_id)) {
            $detalleIngreso = $ingreso->detalleingresosalida()->create([
                'cantidad' => $request->cantidad[$cont],
                'costo' => $request->costo[$cont],
                'producto_id' => $request->producto_id[$cont]
            ]);

            Registroinventario::create([
                'idmovimientoiventario' => 1,
                'cantidad' => $detalleIngreso->cantidad,
                'descripcion' => $detalleIngreso->descripcion,
                'detalleingresosalida_id' => $detalleIngreso->id,
                'almacen_id' => $request->almacen_id
            ]);

            //! OBTENGO EL PRODUCTO A MODIFICAR EL STOCK, EN ESTE CASO LA TABLA DETALLE PRODUCTOS
            $producto = Producto::find($request->producto_id[$cont])->detalleproducto->where('almacen_id', $request->almacen_id)->first();
            /* La sentencia `if (empty()) {` comprueba si la variable `` está vacía o
            no. Si está vacío, significa que no se encontró ningún registro coincidente en la base
            de datos para las condiciones dadas. */
            if (empty($producto)) {
                //! COMO ESTA VACIO CREARE EL DETALLE DEL PRODUCTO
                Detalleproducto::create([
                    'producto_id' => $detalleIngreso->producto_id,
                    'almacen_id' => $request->almacen_id,
                    'cantidad' => 0,
                    'precio_unit_sigv' => $detalleIngreso->costo,
                    'precio_unit_igv' => ($detalleIngreso->costo * 0.18) + $detalleIngreso->costo,
                    'valor_vta_sigv' => $detalleIngreso->costo,
                    'valor_vta_igv' => ($detalleIngreso->costo * 0.18) + $detalleIngreso->costo,
                    'dscto' => 0
                ]);
                $productoCantidad = 0;
            } else {
                $productoCantidad = ($producto->cantidad != 0) ? $producto->cantidad : 0;
            }
            Inventarioalmacen::create([
                'cantidadinicial' => $productoCantidad,
                'cantidadingreso' => $detalleIngreso->cantidad,
                'cantidadsalida' => 0,
                'stock' => ($productoCantidad + $detalleIngreso->cantidad),
                'costo' => $detalleIngreso->costo,
                'producto_id' => $detalleIngreso->producto_id,
                'almacen_id' => $request->almacen_id
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