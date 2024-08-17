<?php

namespace App\Filament\Esd\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Carbon\Carbon;

class AUserStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $initialTime = Carbon::now('Asia/Jakarta')->format('H:i');
        $initialDate = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $initialDay = Carbon::now('Asia/Jakarta')->format('l'); // Get the day of the week

        return [
            Stat::make('Today', $initialDay)
                ->color('primary'),
            Stat::make('Date', $initialDate)
                ->color('primary'),
            Stat::make('Time', $initialTime)
                ->color('primary'),
        ];
    }
}
