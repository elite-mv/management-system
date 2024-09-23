<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\UserRole;
use App\Models\Expense\User;

class CheckBK
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->role->name == UserRole::BOOK_KEEPER->value || UserRole::DEVELOPER->value) {
            return $next($request);
        }

        return redirect('/expense/home');
    }
}
