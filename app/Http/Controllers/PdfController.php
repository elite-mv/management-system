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
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Spatie\Browsershot\Browsershot;

class PdfController
{
    const MAX_EXCEL_REQUEST = 10;

    public function yawa()
    {
        Browsershot::html('<h1>Hello world!!</h1>')->save('example.pdf');
    }

    public function index(Request $request)
    {

        try {

            $ids = explode(',', $request->input('id')[0]);

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
                ->whereIn('id', $ids)
                ->withSum(['items' => function ($query) {
                    $query->select(DB::raw('SUM(quantity * cost)'))
                        ->whereIn('status', [RequestItemStatus::APPROVED->name, RequestItemStatus::PRIORITY->name])
                        ->groupBy('request_id');
                }], 'approve_total')
                ->take(self::MAX_EXCEL_REQUEST)
                ->get();

            $html = view('expense.excel.downloadable-request-excel', ['requests' => $requests])->render();

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
            $spreadsheet = $reader->loadFromString($html);

            $sheet = $spreadsheet->getActiveSheet();

            $existingSpreadsheet = IOFactory::load('excel/check-writer-template.xlsx');

            // Create a new sheet in the existing spreadsheet
            $newSheet = $existingSpreadsheet->getSheetByName('Request Data');

// Copy data from the new spreadsheet to the new sheet in the existing spreadsheet
            $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // Convert the new sheet to an array
            $data = $spreadsheet->getActiveSheet()->toArray(); // Get data from the new spreadsheet

                // Append the data to the new sheet
            foreach ($data as $rowIndex => $row) {
                foreach ($row as $columnIndex => $value) {
                    $newSheet->setCellValue([$columnIndex + 1, $rowIndex + 1], $value); // Set values in the new sheet
                }
            }

            $retrievedCountRequest = count($requests);

            if ($retrievedCountRequest < self::MAX_EXCEL_REQUEST) {
                for ($i = 0; $i < self::MAX_EXCEL_REQUEST; $i++) {

                    if ($retrievedCountRequest > $i) {
                        continue;
                    }

                    $sheetIndex = $existingSpreadsheet->getIndex($existingSpreadsheet->getSheetByName($i + 1));

                    if ($sheetIndex) {
                        $existingSpreadsheet->removeSheetByIndex($sheetIndex);
                    }

                }
            }

            foreach ($requests as $index => $request) {

                $shit = $existingSpreadsheet->getSheetByName($index + 1);

                if (isset($shit)) {
                    $shit->setTitle($request->reference);
                }
            }

            $writer = IOFactory::createWriter($existingSpreadsheet, 'Xlsx');
            $writer->save('excel/check-writer.xlsx'); // Save the file


            return response()->download('excel/check-writer.xlsx');

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['message' => 'error downloading check']);
        }

    }

    public function requestCheck($expenseRequestID)
    {

        try {

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
                ->where('id', $expenseRequestID)
                ->take(1)
                ->get();

            $html = view('expense.excel.downloadable-request-excel', ['requests' => $requests])->render();

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
            $spreadsheet = $reader->loadFromString($html);

            $sheet = $spreadsheet->getActiveSheet();

            $existingSpreadsheet = IOFactory::load('excel/check-writer-template.xlsx');

            // Create a new sheet in the existing spreadsheet
            $newSheet = $existingSpreadsheet->getSheetByName('Request Data');

// Copy data from the new spreadsheet to the new sheet in the existing spreadsheet
            $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // Convert the new sheet to an array
            $data = $spreadsheet->getActiveSheet()->toArray(); // Get data from the new spreadsheet

// Append the data to the new sheet
            foreach ($data as $rowIndex => $row) {
                foreach ($row as $columnIndex => $value) {
                    $newSheet->setCellValue([$columnIndex + 1, $rowIndex + 1], $value); // Set values in the new sheet
                }
            }

            $retrievedCountRequest = count($requests);

            if ($retrievedCountRequest < self::MAX_EXCEL_REQUEST) {
                for ($i = 0; $i < self::MAX_EXCEL_REQUEST; $i++) {

                    if ($retrievedCountRequest > $i) {
                        continue;
                    }

                    $sheetIndex = $existingSpreadsheet->getIndex($existingSpreadsheet->getSheetByName($i + 1));

                    if ($sheetIndex) {
                        $existingSpreadsheet->removeSheetByIndex($sheetIndex);
                    }

                }
            }

            foreach ($requests as $index => $request) {

                $shit = $existingSpreadsheet->getSheetByName($index + 1);

                if (isset($shit)) {
                    $shit->setTitle($request->reference);
                }
            }

            $writer = IOFactory::createWriter($existingSpreadsheet, 'Xlsx');
            $writer->save('excel/check-writer.xlsx'); // Save the file


            return response()->download('excel/check-writer.xlsx');

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['message' => 'error downloading check']);
        }

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

            $request = ExpenseRequest::with([
                'items' => function ($query) {
                    $query->with(['jobOrder']);
                },
                'company',
                'preparedBy',
                'checkVoucher',
                'bankDetails',
                'expenseTypes',
                'approvals',
                ])
                ->withSum('items as sub_total', DB::raw('(quantity * cost)'))
                ->findOrFail($requestID);

            $html = view('expense.pdf.expense-request-form', [
                'request' => $request,
            ])->render();

            $snappdf = new \Beganovich\Snappdf\Snappdf();

            $snappdf
                ->setHtml($html)
                ->save('pdf/' . $request->reference . '.pdf');

            return response()->download('pdf/' . $request->reference . '.pdf');

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function downloadMultiplePDF(Request $request)
    {
        try {

            $ids = explode(',', $request->input('id')[0]);

            $requests = ExpenseRequest::whereIn('id', $ids)->get();

            $requests = ExpenseRequest::whereIn('id', $ids)
                ->with([
                'items' => function ($query) {
                    $query->with(['jobOrder']);
                },
                'company',
                'preparedBy',
                'checkVoucher',
                'bankDetails',
                'expenseTypes',
                'approvals',
            ])
                ->withSum('items as sub_total', DB::raw('(quantity * cost)'))
                ->get();

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

            $expenseCategory = ExpenseCategory::get();

            $html = view('expense.pdf.multiple-expense-request-form', [
                'requests' => $requests,
            ])->render();

            $snappdf = new \Beganovich\Snappdf\Snappdf();

            $snappdf
                ->setHtml($html)
                ->save('pdf/' . $fileName . '.pdf');

            return response()->download('pdf/' . $fileName . '.pdf');

        } catch (\Exception $exception) {
            return  $exception->getMessage();
//            return redirect()->back()->withErrors([$exception->getMessage()]);
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

    public function eut($requestID)
    {
        $request = ExpenseRequest::findOrFail($requestID);

        $measurements = Measurement::get();
        $jobOrder = JobOrder::get();
        $bankNames = BankName::get();
        $bankCodes = BankCode::get();
        $expenseCategory = ExpenseCategory::get();

        return view('expense.pdf.expense-request-form', [
            'bank_names' => $bankNames,
            'bank_codes' => $bankCodes,
            'expense_category' => $expenseCategory,
            'request' => $request,
            'measurements' => $measurements,
            'jobOrders' => $jobOrder,
        ]);
    }
}
