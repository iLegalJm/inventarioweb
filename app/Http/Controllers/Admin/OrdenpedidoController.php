<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Detallepedido;
use App\Models\Ordenpedido;
use App\Models\Ordenventa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Codedge\Fpdf\Fpdf\Fpdf;


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

        Ordenpedido::where('codigo', '=', $codigo)->update(['idestado' => 2]);
        $ordenpedido = Ordenpedido::where('codigo', '=', $codigo)->first();
        $user = User::find(Auth::id());
        $detallepedido = Detallepedido::all()->where('ordenpedido_id', '=', "$codigo");

        $ordenventa = Ordenventa::create([
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
        $this->pdf($codigo, $ordenpedido->cliente, $user, $ordenventa, $detallepedido);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ordenpedido $ordenpedido)
    {
        //
    }

    public function pdf($codigo, $cliente, $user, $ordenventa, $detallepedido)
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

        // ! DATOS DEL CLIENTE
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Cliente: $cliente->nombres"), 0, 'C', false);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Documento: DNI $cliente->numerodocumento"), 0, 'C', false);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Teléfono: $cliente->telefono"), 0, 'C', false);
        // $pdf->MultiCell(0,5,$this->decodificarPdf("Dirección: San Salvador, El Salvador, Centro America"),0,'C',false);

        $pdf->Ln(1);
        $pdf->Cell(0, 5, $this->decodificarPdf("-------------------------------------------------------------------"), 0, 0, 'C');
        $pdf->Ln(3);

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

        $pdf->Output('D', "$codigo.pdf");
        // exit;
        // return redirect()->to('ticket/' . $codigo, 302, ['target' => '_blank']);
        return redirect()->route('admin.ordenpedidos.index');
    }
    public function decodificarPdf($string)
    {
        return mb_convert_encoding($string, "ISO-8859-1", "UTF-8");
    }
}