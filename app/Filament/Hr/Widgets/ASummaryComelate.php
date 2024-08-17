<?php

namespace App\Filament\Hr\Widgets;

use App\Models\ComelateEmployee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ASummaryComelate extends BaseWidget
{
    protected function getStats(): array
    {
        $totalComelate = ComelateEmployee::count();
        $totalDepartments = ComelateEmployee::distinct('department')->count('department');

        return [
            Stat::make('Total Comelate', $totalComelate)
                ->description('Total jumlah data terlambat'),
            Stat::make('Total Departments', $totalDepartments)
                ->description('Total jumlah department yang terdaftar'),
        ];
    }
}
