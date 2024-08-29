<?php

namespace App\Http\Middleware;

use App\Models\Expense\ExpenseCategory;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseCategoryData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $expenseCategory = ExpenseCategory::select(['name', 'id'])->get();

        view()->share('expense_category',  $expenseCategory);

        return $next($request);
    }
}
