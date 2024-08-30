<?php

namespace App\Http\Middleware;

use App\Models\Expense\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $companies = Company::select(['id','name'])->get();;

        view()->share('companies',  $companies);

        return $next($request);
    }
}
