<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
class PdfController
{
    public function index()
    {

        $pdf = new FPDF('L', 'in', array(8, 3));

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(1,1);
        $pdf->Cell(4.5, 0.3, '***JOHN CASTILLO***');
        $pdf->Output(); // This will output the PDF to the browser
        exit; // Prevent Laravel from trying to render the page
    }
}
