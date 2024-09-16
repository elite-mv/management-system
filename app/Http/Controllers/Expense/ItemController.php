<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestApprovalStatus;
use App\Enums\RequestItemStatus;
use App\Enums\UserRole;
use App\Helper\Helper;
use App\Models\Expense\BankCode;
use App\Models\Expense\Company;
use App\Models\Expense\JobOrder;
use App\Models\Expense\Request as ExpenseRequest;
use App\Models\Expense\RequestItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ItemController
{
    public function index(Request $request)
    {

        $requestIDS =  $request->input('id') ? explode(',', $request->input('id')[0]) : [];

        $companies = Company::select(['id', 'name'])
            ->orderBy('name')
            ->get();

        $jobOrders = JobOrder::select(['id', 'reference'])
            ->orderBy('reference')
            ->get();

        $bankCodes = BankCode::select(['id', 'code'])
            ->orderBy('code')
            ->get();

        $items = RequestItem::select(['id', 'request_id', 'job_order_id', 'description', DB::raw('SUM(quantity * cost) as sub_total')])
            ->whereIn('request_id', $requestIDS)
            ->when($request->input('jobOrder') && $request->input('jobOrder') != 'ALL', function ($q) use ($request) {
                $q->where('job_order_id', $request->input('jobOrder'));
            })
            ->when($request->input('search'), function ($q) use ($request) {
                $q->whereHas('request', function ($q) use ($request) {
                    $q->where(function ($query) use ($request) {
                        $query->whereLike('id', '%' . Helper::rawID($request->input('search')) . '%');
                        $query->orWhereLike('supplier', '%' . $request->input('search') . '%');
                        $query->orWhereLike('request_items.description', '%' . $request->input('search') . '%');
                    });
                });
            })
            ->whereHas('request', function ($q) use ($request) {

                $q->when($request->input('bankCode') && $request->input('bankCode') != 'ALL', function ($q) use ($request) {
                    $q->whereHas('bankDetails', function ($q) use ($request) {
                        $q->whereHas('code', function ($q) use ($request) {
                            $q->where('id', $request->input('bankCode'));
                        });
                    });
                });

                $q->when($request->input('company') && $request->input('company') != 'ALL', function ($q) use ($request) {
                    $q->whereHas('company', function ($q) use ($request) {
                        $q->where('id', $request->input('company'));
                    });
                });


                $q->with(['company', 'bankDetails' => function ($q) {
                    $q->with(['code']);
                }]);

            })
            ->with(['jobOrder', 'request'])
            ->groupBy('id', 'request_id', 'job_order_id', 'description');

        $total = $this->computeViewableTotal($request);

        return view('expense.manage-items', [
            'items' => $items->paginate(50),
            'companies' => $companies,
            'jobOrders' => $jobOrders,
            'bankCodes' => $bankCodes,
            'total' => $total,
        ]);
    }

    private function computeTotal(Request $request): float
    {
        $requestIDS =  $request->input('id') ? explode(',', $request->input('id')[0]) : [];


        return RequestItem::select([DB::raw('SUM(quantity * cost) as sub_total')])
            ->whereIn('request_id', $requestIDS)
            ->value('sub_total') ?? 0;

    }

    private function computeViewableTotal(Request $request): float
    {

        $requestIDS =  $request->input('id') ? explode(',', $request->input('id')[0]) : [];


        return RequestItem::select([DB::raw('SUM(quantity * cost) as sub_total')])
            ->whereIn('request_id', $requestIDS)
            ->when($request->input('jobOrder') && $request->input('jobOrder') != 'ALL', function ($q) use ($request) {
                $q->where('job_order_id', $request->input('jobOrder'));
            })
            ->when($request->input('search'), function ($q) use ($request) {
                $q->whereHas('request', function ($q) use ($request) {
                    $q->where(function ($query) use ($request) {
                        $query->whereLike('id', '%' . Helper::rawID($request->input('search')) . '%');
                        $query->orWhereLike('supplier', '%' . $request->input('search') . '%');
                        $query->orWhereLike('request_items.description', '%' . $request->input('search') . '%');
                    });
                });
            })
            ->whereHas('request', function ($q) use ($request) {

                $q->when($request->input('bankCode') && $request->input('bankCode') != 'ALL', function ($q) use ($request) {
                    $q->whereHas('bankDetails', function ($q) use ($request) {
                        $q->whereHas('code', function ($q) use ($request) {
                            $q->where('id', $request->input('bankCode'));
                        });
                    });
                });

                $q->when($request->input('company') && $request->input('company') != 'ALL', function ($q) use ($request) {
                    $q->whereHas('company', function ($q) use ($request) {
                        $q->where('id', $request->input('company'));
                    });
                });


                $q->with(['company', 'bankDetails' => function ($q) {
                    $q->with(['code']);
                }]);

            })
            ->with(['jobOrder', 'request'])
            ->value('sub_total') ?? 0;
    }

    public function downloadExcel(Request $request)
    {

        try {

            $ids =  $request->input('id') ? explode(',', $request->input('id')[0]) : [];

            $items = RequestItem::select(['id', 'request_id', 'job_order_id', 'description', DB::raw('SUM(quantity * cost) as sub_total')])
                ->whereIn('request_id', $ids)
                ->groupBy('id', 'request_id', 'job_order_id', 'description')
                ->get();

            $total = $this->computeTotal($request);

            $html = view('expense.partials.manage-items-table', [
                'items' => $items,
                'total' => $total,
            ])->render();

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
            $spreadsheet = $reader->loadFromString($html);

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save('excel/items.xls');

            return response()->download('excel/items.xls');

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['message' => $exception->getMessage()]);
        }
    }
}
