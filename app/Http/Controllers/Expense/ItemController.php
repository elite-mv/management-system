<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense\BankCode;
use App\Models\Expense\Company;
use App\Models\Expense\JobOrder;
use App\Models\Expense\Request;
use App\Models\Expense\RequestItem;
use Illuminate\Support\Facades\DB;

class ItemController
{
    public function index(Request $request)
    {

        $companies = Company::select(['id', 'name'])
            ->orderBy('name')
            ->get();

        $jobOrders = JobOrder::select(['id', 'reference'])
            ->orderBy('reference')
            ->get();

        $bankCodes = BankCode::select(['id', 'code'])
            ->orderBy('code')
            ->get();

        $items = RequestItem::select(['id','request_id','job_order_id','description', DB::raw('SUM(quantity * cost) as sub_total')])
            ->where('request_id', 3)
            ->with(['request' => function ($query) {
                $query->with([
                    'company',
                ]);
            },
                'jobOrder'])
            ->groupBy('id','request_id','job_order_id','description');

        $total = $this->computeTotal($request);

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
        return RequestItem::select([DB::raw('SUM(quantity * cost) as sub_total')])
            ->where('request_id', 3)
            ->value('sub_total') ?? 0;

    }
}
