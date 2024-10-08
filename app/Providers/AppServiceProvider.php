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

            return in_array($user->role->name, [
                UserRole::BOOK_KEEPER->value,
                UserRole::AUDITOR->value,
                UserRole::ACCOUNTANT->value,
                UserRole::FINANCE->value,
                UserRole::PRESIDENT->value,
                UserRole::DEVELOPER->value,
            ]);

        });

        Gate::define('manage', function () {

            switch (Auth::user()->role->name) {
                case UserRole::ACCOUNTANT:
                case UserRole::FINANCE:
                case UserRole::PRESIDENT:
                    return true;
                default:
                    return false;
            }

        });

        Gate::define('book-keeper', function (User $user) {
            return $user->role->name == UserRole::BOOK_KEEPER->value || $user->role->name == UserRole::DEVELOPER->value;
        });

        Gate::define('accountant', function (User $user) {
            return $user->role->name == UserRole::ACCOUNTANT->value || $user->role->name == UserRole::DEVELOPER->value;
        });

        Gate::define('auditor', function (User $user) {
            return $user->role->name == UserRole::AUDITOR->value || $user->role->name == UserRole::DEVELOPER->value;
        });

        Gate::define('finance-president', function (User $user) {
            return $user->role->name == UserRole::PRESIDENT->value || $user->role->name == UserRole::FINANCE->value || $user->role->name == UserRole::DEVELOPER->value;
        });

        Gate::define('finance', function (User $user) {
            return $user->role->name == UserRole::FINANCE->value || $user->role->name == UserRole::DEVELOPER->value;
        });

        Gate::define('president', function (User $user) {
            return $user->role->name == UserRole::PRESIDENT->value || $user->role->name == UserRole::DEVELOPER->value;
        });

        Gate::define('managing-role', function (User $user) {

            $role = $user->role->name;

            return in_array($role, [
                UserRole::PRESIDENT->value,
                UserRole::FINANCE->value,
                UserRole::BOOK_KEEPER->value,
                UserRole::ACCOUNTANT->value,
                UserRole::AUDITOR->value,
                UserRole::DEVELOPER->value,
            ]);

        });

        Gate::define('developer', function (User $user) {
            return $user->role->name == UserRole::DEVELOPER->value;
        });

        Gate::define('manage', function () {

            switch (Auth::user()->role->name) {
                case UserRole::ACCOUNTANT->value:
                case UserRole::FINANCE->value:
                case UserRole::PRESIDENT->value:
                case UserRole::DEVELOPER->value:
                    return true;
                default:
                    return false;
            }
        });

        Blade::if('management', function () {

            switch (Auth::user()->role->name) {
                case UserRole::ACCOUNTANT:
                case UserRole::AUDITOR:
                case UserRole::BOOK_KEEPER:
                case UserRole::FINANCE:
                case UserRole::PRESIDENT:
                case UserRole::DEVELOPER->value:
                    return true;
                default:
                    return false;
            }
        });

    }
}
