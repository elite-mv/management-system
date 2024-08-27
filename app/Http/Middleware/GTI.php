<?php

namespace App\Http\Middleware;

use App\Models\Expense\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GTI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $company = Company::where('name',  \App\Enums\Company::GTI->value)->first();

        $request->attributes->set('company', $company);

        view()->share('company', $company);


        return $next($request);
    }
}
