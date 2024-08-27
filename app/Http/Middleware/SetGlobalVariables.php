<?php

namespace App\Http\Middleware;

use App\Models\Expense\BankCode;
use App\Models\Expense\BankName;
use App\Models\Expense\Company;
use App\Models\Expense\ExpenseCategory;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetGlobalVariables
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $bankNames = BankName::select(['id','name'])->get();
        $bankCodes = BankCode::select(['id','code'])->get();;
        $companies = Company::select(['id','name'])->get();;

        $expenseCategory = ExpenseCategory::select(['name', 'id'])->get();

        view()->share('bank_names', $bankNames);
        view()->share('bank_codes',  $bankCodes);
        view()->share('expense_category',  $expenseCategory);
        view()->share('companies',  $companies);

        return $next($request);
    }
}
