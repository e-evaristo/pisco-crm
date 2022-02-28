<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\Product;
use App\Models\Employee;
use App\Models\Transaction;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    //protected static string $view = 'filament.widgets.stats-overview';
    protected function getCards(): array
    {
        $month = date('m');
        $year = date('Y');

        return [
            Card::make('Companies', Company::count()),
            Card::make('Employees', Employee::count()),
            Card::make('Products', Product::count()),
            Card::make("Total Sales: $month / $year", 
                Transaction::whereYear('date_transaction', $year)
                    ->whereMonth('date_transaction', $month)
                    ->where('status', '!=','cancelada')
                    ->where('transaction_type_id',1)
                    ->sum('total')
            )->color('success'),
        ];
    }
}
