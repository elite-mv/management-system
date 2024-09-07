<?php

namespace App\Http\Controllers;

use App\Enums\RequestApprovalStatus;
use App\Enums\RequestItemStatus;
use App\Enums\UserRole;
use App\Models\Expense\BankCode;
use App\Models\Expense\BankName;
use App\Models\Expense\ExpenseCategory;
use App\Models\Expense\JobOrder;
use App\Models\Expense\Measurement;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Expense\Request as ExpenseRequest;
use Illuminate\Support\Facades\DB;
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


//        $spreadsheet = new Spreadsheet();
//        $activeWorksheet = $spreadsheet->getActiveSheet();
//
//// Define the data to be set in the spreadsheet
//        $data = [
//            ['Rerence', 'Fruian', 'Color'],
//            ['Alice', 'Apple', 'Red'],
//            ['Bob', 'Banana', 'Yellow'],
//            ['Charlie', 'Cherry', 'Red'],
//            ['David', 'Date', 'Brown'],
//            ['Eve', 'Elderberry', 'Purple'],
//        ];

// Loop through the data and set values in the spreadsheet
//        foreach ($data as $rowIndex => $row) {
//            foreach ($row as $columnIndex => $value) {
//                // Convert column index to letter (A, B, C, ...)
//                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnIndex + 1);
//                // Set the cell value
//                $activeWorksheet->setCellValue($columnLetter . ($rowIndex + 1), $value);
//            }
//        }
//
//// Save the spreadsheet to an Excel file
//        $writer = new Xlsx($spreadsheet);
//        $writer->save('data_grid.xlsx');
//
//        return 'ok';

        $requests = ExpenseRequest::with(['bankDetails', 'preparedBy', 'company'])
            ->withCount(['approvals' => function ($query) {
                $query->whereHas('role', function ($qb) {

                    $approvedRoles = [
                        UserRole::BOOK_KEEPER->value,
                        UserRole::ACCOUNTANT->value,
                        UserRole::FINANCE->value,
                        UserRole::AUDITOR->value,
                    ];

                    $qb->whereIn('name', $approvedRoles)
                        ->where('status', RequestApprovalStatus::APPROVED);
                });
            }])
            ->withSum(['items' => function ($query) {
                $query->select(DB::raw('SUM(quantity * cost)'))
                    ->whereIn('status', [RequestItemStatus::APPROVED->name, RequestItemStatus::PRIORITY->name])
                    ->groupBy('request_id');
            }], 'approve_total')
            ->withSum([], 'approve_total')
            ->get();

        $html = view('expense.excel.downloadable-request-excel', ['requests' => $requests])->render();

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
        $spreadsheet = $reader->loadFromString($html);

        $sheet = $spreadsheet->getActiveSheet();

        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('excel/write.xls');

        return response()->download('excel/write.xls');
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

    public function downloadMultiplePDF(Request $request)
    {
        try {

            $ids = explode(',', $request->input('id')[0]);

            $requests = ExpenseRequest::whereIn('id', $ids)->get();

            $references = ExpenseRequest::select(['reference', 'id'])
                ->whereIn('id', $ids)
                ->get();

            $fileName = '';

            foreach ($references as $index => $reference) {
                $fileName .= $reference->reference;

                if ($index < count($references) - 1) {
                    $fileName .= '-';
                }
            }

            $measurements = Measurement::get();
            $jobOrder = JobOrder::get();
            $bankNames = BankName::get();
            $bankCodes = BankCode::get();
            $expenseCategory = ExpenseCategory::get();

            $html = view('expense.pdf.multiple-expense-request-form', [
                'bank_names' => $bankNames,
                'bank_codes' => $bankCodes,
                'expense_category' => $expenseCategory,
                'requests' => $requests,
                'measurements' => $measurements,
                'jobOrders' => $jobOrder,
            ])->render();

            $snappdf = new \Beganovich\Snappdf\Snappdf();

            $snappdf
                ->setHtml($html)
                ->save('pdf/' . $fileName . '.pdf');

            return response()->download('pdf/' . $fileName . '.pdf');

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

    public function check()
    {

        try {


            $snappdf = new \Beganovich\Snappdf\Snappdf();

            $html = view('check')->render();

            $snappdf
                ->setHtml($html)
                ->save('pdf/check.pdf');

            return response()->file('pdf/check.pdf');

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
