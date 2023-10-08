<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Detallepedido;
use App\Models\Ordenpedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdenpedidoController extends Controller
{
    public function Store(Request $request)
    {
        $searchCliente = Cliente::where('numerodocumento', '=', $request->numerodocumento)->first();
        if (empty($searchCliente)) {
            $request->validate([
                'nombres' => 'required',
                'apellidos' => 'required',
                'numerodocumento' => 'required',
                'telefono' => 'required',
            ]);

            $cliente = Cliente::create($request->all());
        } else {
            $cliente = $searchCliente;
        }

        $ordenPedido = Ordenpedido::create([
            'codigo' => $this->generarCodigo(),
            'cliente_id' => $cliente->id,
            'idestado' => 1,
            'total' => \Cart::subtotal(),
            'user_id' => Auth::id()
        ]);

        $cart_items = \Cart::content();
        foreach ($cart_items as $item) {
            Detallepedido::create([
                'ordenpedido_id' => $ordenPedido->codigo,
                'producto_id' => $item->id,
                'cantidad' => $item->qty,
                'precio' => $item->price,
                'valor_vta' => $item->subtotal
            ]);
        }
        \Cart::destroy();
        return redirect()->route('productos.index');
    }

    function generarCodigo()
    {
        // Crea un conjunto de caracteres que se pueden usar para generar el código
        $caracteres = '0123456789';

        // Crea una cadena vacía para almacenar el código
        $codigo = '';

        // Genera 12 números aleatorios
        for ($i = 0; $i < 12; $i++) {
            // Genera un número aleatorio entre 0 y el número de caracteres
            $numero = rand(0, strlen($caracteres) - 1);

            // Agrega el número aleatorio al código
            $codigo .= $caracteres[$numero];
        }

        $cod = (!empty(Ordenpedido::where('codigo', '=', $codigo)->first())) ? $this->generarCodigo() : $codigo;
        return $cod;
    }
}