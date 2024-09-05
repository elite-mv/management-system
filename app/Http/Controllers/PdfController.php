<?php

namespace App\Http\Controllers;

use App\Models\Expense\BankCode;
use App\Models\Expense\BankName;
use App\Models\Expense\ExpenseCategory;
use App\Models\Expense\JobOrder;
use App\Models\Expense\Measurement;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Expense\Request as ExpenseRequest;

class PdfController
{
    public function index()
    {

//        $pdf = new FPDF('L', 'in', array(8, 3));
        $pdf = new FPDF('L', 'in', 'A4');
//        $pdf = new FPDF('L', 'in', [,4.13]);

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 9);

//        $pdf->Cell(0, 10, 'Pay to the order of: John Doe', 0, 1);
//        $pdf->Cell(0, 10, 'Amount: $100.00', 0, 1);
//        $pdf->Cell(0, 10, 'Date: ' . date('Y-m-d'), 0, 1);
//        $pdf->Cell(0, 10, 'Signature: __________________', 0, 1);
//
//        //
        $text = '***Mhel Voi Bernabe***';

//        $pdf->SetFillColor(0, 0, 0);
//        $pdf->rect(3.6,2.7,8,3,);

//        $pdf->Set = 10;
//
        $pdf->SetXY(4.8, 3.44);
        $pdf->Cell(4.2, 0.25, $text);
//        $pdf->rect(4.8,3.45,4.2,0.3,);

//        $pdf->AddPage();
//        $pdf->SetFont('Arial', 'B', 8);
////
//        $text = '***JOHN CASTILLO***';
//
////        $pdf->SetFillColor(0, 0, 0);
////        $pdf->rect(0,0,8,3,);
//
//        $pdf->SetXY(0.5,0.8);
//        $pdf->Cell(4.5, 0.3, $text);


//        $pdf->rect(0.5,0.5,4.5,0.3,);


        $pdf->Output(); // This will output the PDF to the browser


        //
//        $mid_y = $pdf->GetPageWidth() / 2;
//        $mid_x = $pdf->GetPageHeight() / 2;
//
//        $text = '***JOHN CASTILLO***';
//
//        $width = $pdf->GetStringWidth($text);
//
//        $pdf->SetXY(1,$mid_x - 1);
//        $pdf->Cell(4.5, 0.3, $text);

        exit; // Prevent Laravel from trying to render the page
    }


    public function test(ExpenseRequest $expenseRequest)
    {

        $measurements = Measurement::get();
        $jobOrder = JobOrder::get();
        $bankNames = BankName::get();
        $bankCodes = BankCode::get();
        $expenseCategory = ExpenseCategory::get();

        return view('expense.pdf.expense-request-form', [
            'bank_names' => $bankNames,
            'bank_codes' => $bankCodes,
            'expense_category' => $expenseCategory,
            'request' => $expenseRequest,
            'measurements' => $measurements,
            'jobOrders' => $jobOrder,
        ]);

    }

    public function test2(ExpenseRequest $expenseRequest)
    {

        try {

            $measurements = Measurement::get();
            $jobOrder = JobOrder::get();
            $bankNames = BankName::get();
            $bankCodes = BankCode::get();
            $expenseCategory = ExpenseCategory::get();


            $snappdf = new \Beganovich\Snappdf\Snappdf();

            $field = [
                'bank_names' => $bankNames,
                'bank_codes' => $bankCodes,
                'expense_category' => $expenseCategory,
                'request' => $expenseRequest,
                'measurements' => $measurements,
                'jobOrders' => $jobOrder,
            ];

            $html = view('expense.pdf.expense-request-form', $field)->render();

            $pdf = $snappdf
                ->setHtml($html)
                ->save('pdf/tangin.pdf');

            return response()->file('pdf/tangin.pdf');

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
