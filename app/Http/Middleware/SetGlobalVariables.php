<?php

namespace App\Http\Middleware;

use App\Models\Bank;
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

        $bankNames = Bank::distinct()->pluck('name')->toArray();
        $bankCodes = Bank::pluck('code')->toArray();

        view()->share('bank_names', $bankNames);
        view()->share('bank_codes',  $bankCodes);

        return $next($request);
    }
}
