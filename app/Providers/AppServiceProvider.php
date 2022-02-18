<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Employee;
use Filament\Facades\Filament;
use App\Observers\CompanyObserver;
use App\Observers\EmployeeObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function (): void {
            Filament::registerTheme(mix('css/app.css'));
        });

        Company::observe(CompanyObserver::class);
        Employee::observe(EmployeeObserver::class);
    }
}
