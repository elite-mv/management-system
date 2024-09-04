<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\Expense\Request as ModelsRequest;
use App\Models\Expense\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('path.public', function () {
            return base_path() . '/public_html';
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Paginator::useBootstrapFive();

        Gate::define('view-request', function (User $user, ModelsRequest $modelRequest) {

            if ($user->id === $modelRequest->prepared_by) {
                return true;
            }

            $isAllowed = in_array($user->role->name, [
                UserRole::BOOK_KEEPER->value,
                UserRole::AUDITOR->value,
                UserRole::ACCOUNTANT->value,
                UserRole::FINANCE->value,
                UserRole::PRESIDENT->value,
            ]);

            return $isAllowed;
        });

        Blade::if('management', function () {

            switch (Auth::user()->role->name) {
                case UserRole::ACCOUNTANT:
                case UserRole::AUDITOR:
                case UserRole::BOOK_KEEPER:
                case UserRole::FINANCE:
                case UserRole::PRESIDENT:
                    return true;
                default:
                    return false;
            }
        });

    }
}
