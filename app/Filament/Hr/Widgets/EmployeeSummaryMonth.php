<?php

namespace App\Filament\Hr\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\ComelateEmployee;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Select;
use Carbon\Carbon;

class EmployeeSummaryMonth extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'employeeSummaryMonth';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Employee Comelate Summary Per-Month';

    /**
     * Form schema for filters
     *
     * @return array
     */
    protected function getFormSchema(): array
    {
        // Get the current year and the last 10 years for the select options
        $currentYear = Carbon::now()->year;
        $years = range($currentYear - 10, $currentYear);

        return [
            Select::make('year')
                ->label('Year')
                ->options(array_combine($years, $years)) // Key-value pairs for Select options
                ->default($currentYear) // Default to current year
                ->required(), // Ensure year is selected
        ];
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $year = $this->filterFormData['year'] ?? Carbon::now()->year;

        // Fetch monthly data for the selected year
        $monthlyData = ComelateEmployee::query()
            ->whereYear('tanggal', $year)
            ->select(
                DB::raw('MONTH(tanggal) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [intval($item->month) => $item->count];
            });

        // Prepare array data with default 0 for each month
        $data = array_fill(1, 12, 0); // 1 - 12 for January - December

        // Populate array with the data fetched from the database
        foreach ($monthlyData as $month => $count) {
            $data[$month] = $count;
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Employee Summary', // Fixed title for the series
                    'data' => array_values($data),
                ],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
        ];
    }
}
