<?php

namespace App\Http\Middleware;

use App\Models\Expense\Company;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $company = Company::where('id', Auth::user()->company_id)->first();

        $request->attributes->set('selected_company', $company);

        view()->share('selected_company', $company);

        return $next($request);
    }
}
