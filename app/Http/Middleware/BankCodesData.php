<?php

namespace App\Http\Middleware;

use App\Models\Expense\BankCode;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankCodesData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $bankCodes = BankCode::select(['id','code'])->get();;

        view()->share('bank_codes',  $bankCodes);

        return $next($request);
    }
}
