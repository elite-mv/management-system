<?php

namespace App\Providers;

use App\Enums\UserRole;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('path.public', function() {
            return base_path().'/public_html';
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('management', function () {
            
            switch(Auth::user()->role->name){
                case UserRole::PRESIDENT:
                    return true;
                case UserRole::ACCOUNTANT:
                    return true;
                case UserRole::AUDITOR:
                    return true;  
                case UserRole::BOOK_KEEPER:
                    return true;
                case UserRole::FINANCE:
                        return true;
                default:
                return false;
            }
        });

    }
}
