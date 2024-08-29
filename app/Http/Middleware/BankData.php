<?php

namespace App\Http\Middleware;

use App\Models\Expense\BankName;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $bankNames = BankName::select(['id','name'])->get();

        view()->share('bank_names', $bankNames);

        return $next($request);
    }
}
