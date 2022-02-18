<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\Employee;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    //protected static string $view = 'filament.widgets.stats-overview';
    protected function getCards(): array
    {
        return [
            Card::make('Companies', Company::count()),
            Card::make('Employees', Employee::count()),
            Card::make('Projects', '0'),
        ];
    }
}
