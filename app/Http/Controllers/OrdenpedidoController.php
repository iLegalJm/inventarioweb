<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Detallepedido;
use App\Models\Ordenpedido;
use App\Models\Ordenventa;
use App\Models\User;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;
use Milon\Barcode\DNS2D;
use Milon\Barcode\DNS1D;

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

    public function storeonline()
    {
        $ordenPedido = Ordenpedido::create([
            'codigo' => $this->generarCodigo(),
            'cliente_id' => 1,
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

        $ordenventa = Ordenventa::create([
            'codigo' => $ordenPedido->codigo,
            'idtipopago' => 'pagoonline',
            'idestado' => 1,
            'total' => $ordenPedido->total,
            'subtotal' => round(($ordenPedido->total) - ($ordenPedido->total * 0.18), 2),
            'impuestovta' => round($ordenPedido->total * 0.18, 2),
            'importepago' => $ordenPedido->total,
            'importevuelto' => 0,
            'ordenpedido_id' => $ordenPedido->codigo
        ]);

        $detallepedido = Detallepedido::all()->where('ordenpedido_id', '=', "$ordenPedido->codigo");
        $user = User::find(Auth::id());
        $this->pdf($ordenPedido->codigo, $user, $ordenventa, $detallepedido);
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

    public function pdf($codigo, $user, $ordenventa, $detallepedido)
    {
        $pdf = new Fpdf('P', 'mm', array(80, 258));
        $pdf->SetMargins(4, 10, 4);
        $pdf->AddPage();

        //! ENCABEZADO Y DATOS DE LA EMPRESA
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(0, 5, strtoupper($this->decodificarPdf("MazterStore")), 0, 'C', false);
        $pdf->SetFont('Arial', '', 9);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("RUC: 20610752005"), 0, 'C', false);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Direccion Santa Clara, Ate Vitarte"), 0, 'C', false);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Teléfono: +51 946-561-445"), 0, 'C', false);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Email: Ventas@mazterstore.com"), 0, 'C', false);

        $pdf->Ln(1);
        $pdf->Cell(0, 5, $this->decodificarPdf("------------------------------------------------------"), 0, 0, 'C');
        $pdf->Ln(5);

        $pdf->MultiCell(0, 5, $this->decodificarPdf("Fecha: " . date("d/m/Y") . " " . date("h:s A")), 0, 'C', false);
        // $pdf->MultiCell(0, 5, $this->decodificarPdf("Caja Nro: 1"), 0, 'C', false);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Obteneido por: " . $user->name), 0, 'C', false);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->MultiCell(0, 5, $this->decodificarPdf(strtoupper("Ticket Nro: 1")), 0, 'C', false);
        $pdf->SetFont('Arial', '', 9);

        // // ! DATOS DEL CLIENTE
        // $pdf->MultiCell(0, 5, $this->decodificarPdf("Cliente: $cliente->nombres"), 0, 'C', false);
        // $pdf->MultiCell(0, 5, $this->decodificarPdf("Documento: DNI $cliente->numerodocumento"), 0, 'C', false);
        // $pdf->MultiCell(0, 5, $this->decodificarPdf("Teléfono: $cliente->telefono"), 0, 'C', false);
        // // $pdf->MultiCell(0,5,$this->decodificarPdf("Dirección: San Salvador, El Salvador, Centro America"),0,'C',false);

        // $pdf->Ln(1);
        // $pdf->Cell(0, 5, $this->decodificarPdf("-------------------------------------------------------------------"), 0, 0, 'C');
        // $pdf->Ln(3);

        // ! TABLA DE PRODUCTOS
        $pdf->Cell(10, 5, $this->decodificarPdf("Cant."), 0, 0, 'C');
        $pdf->Cell(19, 5, $this->decodificarPdf("Precio"), 0, 0, 'C');
        $pdf->Cell(15, 5, $this->decodificarPdf("Desc."), 0, 0, 'C');
        $pdf->Cell(28, 5, $this->decodificarPdf("Total"), 0, 0, 'C');

        $pdf->Ln(3);
        $pdf->Cell(72, 5, $this->decodificarPdf("-------------------------------------------------------------------"), 0, 0, 'C');
        $pdf->Ln(3);

        //! /*----------  Detalles de la tabla  ----------*/
        foreach ($detallepedido as $detalle) {
            $pdf->MultiCell(0, 4, $this->decodificarPdf($detalle->producto->nombre), 0, 'C', false);
            $pdf->Cell(10, 4, $this->decodificarPdf($detalle->cantidad), 0, 0, 'C');
            $pdf->Cell(19, 4, $this->decodificarPdf("S/. " . $detalle->precio), 0, 0, 'C');
            $pdf->Cell(19, 4, $this->decodificarPdf("S/. 0.00"), 0, 0, 'C');
            $pdf->Cell(28, 4, $this->decodificarPdf("S/. " . $detalle->valor_vta), 0, 0, 'C');
            $pdf->Ln(5);
        }
        $pdf->Ln(5);
        $pdf->MultiCell(0, 4, $this->decodificarPdf("Garantía de fábrica: 1 año"), 0, 'C', false);
        $pdf->Ln(6);
        //! /*----------  Fin Detalles de la tabla  ----------*/

        $pdf->Cell(72, 5, $this->decodificarPdf("-------------------------------------------------------------------"), 0, 0, 'C');

        $pdf->Ln(5);

        //! # Impuestos & totales #
        $pdf->Cell(18, 5, $this->decodificarPdf(""), 0, 0, 'C');
        $pdf->Cell(22, 5, $this->decodificarPdf("SUBTOTAL"), 0, 0, 'C');
        $pdf->Cell(32, 5, $this->decodificarPdf("S/. " . $ordenventa->subtotal), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, $this->decodificarPdf(""), 0, 0, 'C');
        $pdf->Cell(22, 5, $this->decodificarPdf("IGV (18%)"), 0, 0, 'C');
        $pdf->Cell(32, 5, $this->decodificarPdf("S/. " . $ordenventa->impuestovta), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(72, 5, $this->decodificarPdf("-------------------------------------------------------------------"), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, $this->decodificarPdf(""), 0, 0, 'C');
        $pdf->Cell(22, 5, $this->decodificarPdf("TOTAL A PAGAR"), 0, 0, 'C');
        $pdf->Cell(32, 5, $this->decodificarPdf("S/. " . $ordenventa->total), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, $this->decodificarPdf(""), 0, 0, 'C');
        $pdf->Cell(22, 5, $this->decodificarPdf("TOTAL PAGADO"), 0, 0, 'C');
        $pdf->Cell(32, 5, $this->decodificarPdf("S/. " . $ordenventa->importepago), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, $this->decodificarPdf(""), 0, 0, 'C');
        $pdf->Cell(22, 5, $this->decodificarPdf("CAMBIO"), 0, 0, 'C');
        $pdf->Cell(32, 5, $this->decodificarPdf("S/. " . $ordenventa->importevuelto), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, $this->decodificarPdf(""), 0, 0, 'C');
        $pdf->Cell(22, 5, $this->decodificarPdf("USTED AHORRA"), 0, 0, 'C');
        $pdf->Cell(32, 5, $this->decodificarPdf("S/. 0.00"), 0, 0, 'C');

        $pdf->Ln(10);

        $pdf->MultiCell(0, 5, $this->decodificarPdf("*** Precios de productos incluyen impuestos. Para poder recibir su pedido necesita este ticket ***"), 0, 'C', false);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 7, $this->decodificarPdf("Gracias por su compra"), '', 0, 'C');

        $pdf->Ln(9);
        // data:image/png;base64,
        # Codigo de barras #
        // $barcode = DNS1D::getBarcodePNG('4', 'C39+',3,33);
        // $pdf->MultiCell(70, 20, DNS1D::getBarcodeSVG('4445645656', 'PHARMA2T'), 1, 'C');
        $barcode = DNS1D::getBarcodePNGPath($codigo, 'CODE11', 70, 20);
        $pdf->Image($barcode, 5, $pdf->GetY(), 70, 20);
        $pdf->SetXY(0, $pdf->GetY() + 21);
        $pdf->SetFont('Arial', '', 14);
        $pdf->MultiCell(0, 5, $this->decodificarPdf($codigo), 0, 'C', false);

        $pdf->Output('I', "$codigo.pdf");
        exit;
    }

    public function decodificarPdf($string)
    {
        return mb_convert_encoding($string, "ISO-8859-1", "UTF-8");
    }
}