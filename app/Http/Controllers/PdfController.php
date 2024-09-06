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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PdfController
{
    public function index()
    {

////        $pdf = new FPDF('L', 'in', array(8, 3));
//        $pdf = new FPDF('L', 'in', 'A4');
////        $pdf = new FPDF('L', 'in', [,4.13]);
//
//        $pdf->AddPage();
//        $pdf->SetFont('Arial', 'B', 9);
//
////        $pdf->Cell(0, 10, 'Pay to the order of: John Doe', 0, 1);
////        $pdf->Cell(0, 10, 'Amount: $100.00', 0, 1);
////        $pdf->Cell(0, 10, 'Date: ' . date('Y-m-d'), 0, 1);
////        $pdf->Cell(0, 10, 'Signature: __________________', 0, 1);
////
////        //
//        $text = '***Mhel Voi Bernabe***';
//
////        $pdf->SetFillColor(0, 0, 0);
////        $pdf->rect(3.6,2.7,8,3,);
//
////        $pdf->Set = 10;
////
//        $pdf->SetXY(4.8, 3.44);
//        $pdf->Cell(4.2, 0.25, $text);
////        $pdf->rect(4.8,3.45,4.2,0.3,);
//
////        $pdf->AddPage();
////        $pdf->SetFont('Arial', 'B', 8);
//////
////        $text = '***JOHN CASTILLO***';
////
//////        $pdf->SetFillColor(0, 0, 0);
//////        $pdf->rect(0,0,8,3,);
////
////        $pdf->SetXY(0.5,0.8);
////        $pdf->Cell(4.5, 0.3, $text);
//
//
////        $pdf->rect(0.5,0.5,4.5,0.3,);
//
//
//        $pdf->Output(); // This will output the PDF to the browser
//
//
//        //
////        $mid_y = $pdf->GetPageWidth() / 2;
////        $mid_x = $pdf->GetPageHeight() / 2;
////
////        $text = '***JOHN CASTILLO***';
////
////        $width = $pdf->GetStringWidth($text);
////
////        $pdf->SetXY(1,$mid_x - 1);
////        $pdf->Cell(4.5, 0.3, $text);
//
//        exit; // Prevent Laravel from trying to render the page


        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

// Define the data to be set in the spreadsheet
        $data = [
            ['Name', 'Fruit', 'Color'],
            ['Alice', 'Apple', 'Red'],
            ['Bob', 'Banana', 'Yellow'],
            ['Charlie', 'Cherry', 'Red'],
            ['David', 'Date', 'Brown'],
            ['Eve', 'Elderberry', 'Purple'],
        ];

// Loop through the data and set values in the spreadsheet
        foreach ($data as $rowIndex => $row) {
            foreach ($row as $columnIndex => $value) {
                // Convert column index to letter (A, B, C, ...)
                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnIndex + 1);
                // Set the cell value
                $activeWorksheet->setCellValue($columnLetter . ($rowIndex + 1), $value);
            }
        }

// Save the spreadsheet to an Excel file
        $writer = new Xlsx($spreadsheet);
        $writer->save('data_grid.xlsx');

        return 'ok';
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
//            'request' => $expenseRequest,
            'requests' => \App\Models\Expense\Request::query()->take(2)->get(),
            'measurements' => $measurements,
            'jobOrders' => $jobOrder,
        ]);

    }

    public function downloadPDF($requestID)
    {
        try {

            $request = ExpenseRequest::findOrFail($requestID);

            $measurements = Measurement::get();
            $jobOrder = JobOrder::get();
            $bankNames = BankName::get();
            $bankCodes = BankCode::get();
            $expenseCategory = ExpenseCategory::get();

            $html = view('expense.pdf.expense-request-form', [
                'bank_names' => $bankNames,
                'bank_codes' => $bankCodes,
                'expense_category' => $expenseCategory,
                'request' => $request,
                'measurements' => $measurements,
                'jobOrders' => $jobOrder,
            ])->render();

            $snappdf = new \Beganovich\Snappdf\Snappdf();

            $snappdf
                ->setHtml($html)
                ->save('pdf/' . $request->reference . '.pdf');

            return response()->download('pdf/' . $request->reference . '.pdf');

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }

    public function test2($requestID)
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
                'requests' => \App\Models\Expense\Request::query()->take(1)->get(),
                'measurements' => $measurements,
                'jobOrders' => $jobOrder,
            ];

            $html = view('expense.pdf.expense-request-form', $field)->render();

            $snappdf
                ->setHtml($html)
                ->save('pdf/tangin.pdf');

            return response()->file('pdf/tangin.pdf');

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
