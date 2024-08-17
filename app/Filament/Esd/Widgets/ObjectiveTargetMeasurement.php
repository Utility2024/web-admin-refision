<?php

namespace App\Filament\Esd\Widgets;

use App\Models\TargetMeasurement;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ObjectiveTargetMeasurement extends ApexChartWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static string $chartId = 'objectiveTargetMeasurement';

    protected static ?string $heading = 'Objective Target Measurement In this month';

    protected function getOptions(): array
    {
        $data = $this->getData();

        $series = [
            [
                'name' => 'Target',
                'type' => 'bar',
                'data' => $data['target'],
            ],
            [
                'name' => 'Actual',
                'type' => 'bar',
                'data' => $data['actual'],
            ],
            [
                'name' => 'Percent',
                'type' => 'line',
                'data' => $data['percent'],
            ],
        ];

        return [
            'chart' => [
                'height' => 300,
                'type' => 'line', // Main chart type to accommodate line series
                'stacked' => false,
            ],
            'series' => $series,
            'xaxis' => [
                'title' => [
                        'text' => 'Week',
                    ],
                'categories' => $data['weeks'], // Weeks on x-axis
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                [
                    'title' => [
                        'text' => 'Target/Actual',
                    ],
                    'labels' => [
                        'style' => [
                            'fontFamily' => 'inherit',
                        ],
                    ],
                ],
                [
                    'opposite' => true,
                    'title' => [
                        'text' => 'Percent (%)',
                    ],
                    'labels' => [
                        'style' => [
                            'fontFamily' => 'inherit',
                        ],
                    ],
                ],
            ],
            'colors' => ['#10b981', '#1c64f2', '#f59e0b'],
            'stroke' => [
                'curve' => 'smooth',
            ],
            'plotOptions' => [
                'bar' => [
                    'columnWidth' => '40%',
                ],
            ],
            'dataLabels' => [
                'enabled' => true,
            ],
            'tooltip' => [
                'shared' => true,
                'intersect' => false,
            ],
        ];
    }

    protected function getData(): array
    {
        $year = $this->form->getState()['year'] ?? now()->year;
        $month = $this->form->getState()['month'] ?? now()->month;
        $weeks = $this->form->getState()['weeks'] ?? [];

        $query = TargetMeasurement::query();

        if (!empty($weeks)) {
            $query->whereIn('week', $weeks);
        } else {
            $query->whereYear('date_from', $year)
                  ->whereMonth('date_from', $month);
        }

        $dateFrom = $this->form->getState()['date_from'] ?? now()->startOfYear();
        $dateUntil = $this->form->getState()['date_until'] ?? now()->endOfYear();
        $query->whereBetween('date_from', [$dateFrom, $dateUntil]);

        $measurements = $query->select(['week', 'target', 'actual'])
            ->get()
            ->groupBy('week');

        $weeks = $measurements->keys()->toArray();
        $data = [
            'weeks' => $weeks,
            'target' => array_fill(0, count($weeks), 0),
            'actual' => array_fill(0, count($weeks), 0),
            'percent' => array_fill(0, count($weeks), 0),
        ];

        foreach ($weeks as $index => $week) {
            $weekData = $measurements[$week];
            $targetSum = $weekData->sum('target');
            $actualSum = $weekData->sum('actual');
            $percent = $targetSum ? ($actualSum / $targetSum) * 100 : 0;

            $data['target'][$index] = intval(number_format($targetSum, 0, '', ''));
            $data['actual'][$index] = intval(number_format($actualSum, 0, '', ''));
            $data['percent'][$index] = intval(number_format($percent, 0, '', ''));
        }

        return $data;
    }

    protected function getFormSchema(): array
    {
        return [

            Select::make('year')
                ->options(array_combine(range(now()->year - 5, now()->year), range(now()->year - 5, now()->year)))
                ->default(now()->year)
                ->reactive(),

            Select::make('month')
                ->options(array_combine(range(1, 12), range(1, 12)))
                ->default(now()->month)
                ->reactive(),

        ];
    }
}
