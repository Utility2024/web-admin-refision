<?php

namespace App\Filament\Stock\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Carbon\Carbon;

class APrice extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalPriceIn = Transaction::sum('total_price_in');
        $totalPriceOut = Transaction::sum('total_price_out');
        $revenue = $totalPriceIn - $totalPriceOut;

        return [
            Stat::make('Total Income', 'IDR ' . number_format($totalPriceIn, 2))
                ->color('success')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Total Expense', 'IDR ' . number_format($totalPriceOut, 2))
                ->color('danger')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Revenue', 'IDR ' . number_format($revenue, 2))
                ->color($revenue >= 0 ? 'success' : 'danger')
                ->description($revenue >= 0 ? 'Profit' : 'Loss')
                ->descriptionIcon($revenue >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down'),
        ];
    }
}
