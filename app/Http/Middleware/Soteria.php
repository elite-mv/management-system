<?php

namespace App\Http\Middleware;

use App\Models\Expense\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Soteria
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $company = Company::where('name',  \App\Enums\Company::SOTERIA->value)->first();

        $request->attributes->set('company', $company);

        return $next($request);
    }
}
