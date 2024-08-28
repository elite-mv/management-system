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

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 10);

        $mid_y = $pdf->GetPageWidth() / 2;
        $mid_x = $pdf->GetPageHeight() / 2;

        $text = '***JOHN CASTILLO***';

        $width = $pdf->GetStringWidth($text);

        $pdf->SetXY(1,$mid_x - 1);
        $pdf->Cell(4.5, 0.3, $text);

        $pdf->Output(); // This will output the PDF to the browser
        exit; // Prevent Laravel from trying to render the page
    }


    public function test(ExpenseRequest $expenseRequest)
    {

        $measurements = Measurement::get();
        $jobOrder = JobOrder::get();
        $bankNames = BankName::get();
        $bankCodes = BankCode::get();
        $expenseCategory = ExpenseCategory::get();

        $pdf = PDF::loadView('expense.pdf.expense-request-form',  [
            'bank_names' => $bankNames,
            'bank_codes' => $bankCodes,
            'expense_category' => $expenseCategory,
            'request' => $expenseRequest,
            'measurements' => $measurements,
            'jobOrders' => $jobOrder,
        ])->setPaper('A4');


        return $pdf->download('invoice.pdf');
    }

    public function test2(ExpenseRequest $expenseRequest)
    {

        $measurements = Measurement::get();
        $jobOrder = JobOrder::get();
        $bankNames = BankName::get();
        $bankCodes = BankCode::get();
        $expenseCategory = ExpenseCategory::get();

        return view('expense.pdf.expense-request-form',  [
            'bank_names' => $bankNames,
            'bank_codes' => $bankCodes,
            'expense_category' => $expenseCategory,
            'request' => $expenseRequest,
            'measurements' => $measurements,
            'jobOrders' => $jobOrder,
        ]);
    }
}
