<?php

namespace App\Http\Middleware;

use App\Models\Bank;
use App\Models\Expense\BankCode;
use App\Models\Expense\BankName;
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

        $bankNames = BankName::get();
        $bankCodes = BankCode::get();

        view()->share('bank_names', $bankNames);
        view()->share('bank_codes',  $bankCodes);

        return $next($request);
    }
}
