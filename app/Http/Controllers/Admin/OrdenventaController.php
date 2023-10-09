<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ordeningresosalida;
use App\Models\Ordenventa;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdenventaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $pdf = new Fpdf('P', 'mm', array(80, 258));
        $pdf->SetMargins(4, 10, 4);
        $pdf->AddPage();

        //! ENCABEZADO Y DATOS DE LA EMPRESA
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->MultiCell(0, 5, strtoupper($this->decodificarPdf("MazterStore")), 0, 'C', false);
        $pdf->SetFont('Arial', '', 9);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("RUC: 0000000000"), 0, 'C', false);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Direccion Santa Clara, Ate Vitarte"), 0, 'C', false);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Teléfono: +51 946-561-445"), 0, 'C', false);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Email: mazterstore@mazterstore.com"), 0, 'C', false);

        $pdf->Ln(1);
        $pdf->Cell(0, 5, $this->decodificarPdf("------------------------------------------------------"), 0, 0, 'C');
        $pdf->Ln(5);

        $pdf->MultiCell(0, 5, $this->decodificarPdf("Fecha: " . date("d/m/Y") . " " . date("h:s A")), 0, 'C', false);
        // $pdf->MultiCell(0, 5, $this->decodificarPdf("Caja Nro: 1"), 0, 'C', false);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Obteneido por: " . Auth::id()), 0, 'C', false);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->MultiCell(0, 5, $this->decodificarPdf(strtoupper("Ticket Nro: 1")), 0, 'C', false);
        $pdf->SetFont('Arial', '', 9);

        // ! DATOS DEL CLIENTE
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Cliente: Prueba"), 0, 'C', false);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Documento: DNI 0000-0000"), 0, 'C', false);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("Teléfono: 000-000-000"), 0, 'C', false);
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
        $pdf->MultiCell(0, 4, $this->decodificarPdf("Impresora"), 0, 'C', false);
        $pdf->Cell(10, 4, $this->decodificarPdf("7"), 0, 0, 'C');
        $pdf->Cell(19, 4, $this->decodificarPdf("S/. 500.00"), 0, 0, 'C');
        $pdf->Cell(19, 4, $this->decodificarPdf("S/. 0.00"), 0, 0, 'C');
        $pdf->Cell(28, 4, $this->decodificarPdf("S/. 3,500.00"), 0, 0, 'C');
        $pdf->Ln(4);
        $pdf->MultiCell(0, 4, $this->decodificarPdf("Garantía de fábrica: 2 Meses"), 0, 'C', false);
        $pdf->Ln(7);
        //! /*----------  Fin Detalles de la tabla  ----------*/

        $pdf->Cell(72, 5, $this->decodificarPdf("-------------------------------------------------------------------"), 0, 0, 'C');

        $pdf->Ln(5);

        # Impuestos & totales #
        $pdf->Cell(18, 5, $this->decodificarPdf(""), 0, 0, 'C');
        $pdf->Cell(22, 5, $this->decodificarPdf("SUBTOTAL"), 0, 0, 'C');
        $pdf->Cell(32, 5, $this->decodificarPdf("S/. 3, 200.00"), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, $this->decodificarPdf(""), 0, 0, 'C');
        $pdf->Cell(22, 5, $this->decodificarPdf("IGV (18%)"), 0, 0, 'C');
        $pdf->Cell(32, 5, $this->decodificarPdf("+ S/. 300.00"), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(72, 5, $this->decodificarPdf("-------------------------------------------------------------------"), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, $this->decodificarPdf(""), 0, 0, 'C');
        $pdf->Cell(22, 5, $this->decodificarPdf("TOTAL A PAGAR"), 0, 0, 'C');
        $pdf->Cell(32, 5, $this->decodificarPdf("S/. 3,500.00"), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, $this->decodificarPdf(""), 0, 0, 'C');
        $pdf->Cell(22, 5, $this->decodificarPdf("TOTAL PAGADO"), 0, 0, 'C');
        $pdf->Cell(32, 5, $this->decodificarPdf("S/. 3,500.00"), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, $this->decodificarPdf(""), 0, 0, 'C');
        $pdf->Cell(22, 5, $this->decodificarPdf("CAMBIO"), 0, 0, 'C');
        $pdf->Cell(32, 5, $this->decodificarPdf("S/. 0.00"), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, $this->decodificarPdf(""), 0, 0, 'C');
        $pdf->Cell(22, 5, $this->decodificarPdf("USTED AHORRA"), 0, 0, 'C');
        $pdf->Cell(32, 5, $this->decodificarPdf("S/. 0.00"), 0, 0, 'C');

        $pdf->Ln(10);

        $pdf->MultiCell(0, 5, $this->decodificarPdf("*** Precios de productos incluyen impuestos. Para poder recibir su pedido necesita este ticket ***"), 0, 'C', false);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 7, $this->decodificarPdf("Gracias por su compra"), '', 0, 'C');

        $pdf->Ln(9);

        # Codigo de barras #
        // $pdf->Code128(5, $pdf->GetY(), "COD000001V0001", 70, 20);
        $pdf->SetXY(0, $pdf->GetY() + 21);
        $pdf->SetFont('Arial', '', 14);
        $pdf->MultiCell(0, 5, $this->decodificarPdf("COD000001V0001"), 0, 'C', false);

        $pdf->Output("I", "Ticket_Nro_1.pdf", true);
        exit;
        // $ordenventas = Ordenventa::all();
        // return view('admin.ventas.index', compact('ordenventas'));
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

    public function decodificarPdf($string)
    {
        return mb_convert_encoding($string, "ISO-8859-1", "UTF-8");
    }

}