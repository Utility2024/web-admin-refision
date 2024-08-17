<?php

namespace App\Filament\Hr\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\ComelateEmployee;

class DepartmentSummary extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'departmentSummary';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Department Summary Comelate';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        // Mengambil data department dan menghitung jumlah karyawan di setiap department
        $departments = ComelateEmployee::select('department')
            ->selectRaw('count(*) as total')
            ->groupBy('department')
            ->get();

        // Membuat series dan labels dari hasil query
        $series = $departments->pluck('total')->toArray();
        $labels = $departments->pluck('department')->toArray();

        // Menggabungkan jumlah dan nama department untuk ditampilkan di label
        $displayLabels = $departments->map(function ($department) {
            return $department->department . ' (' . $department->total . ')';
        })->toArray();

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'series' => $series,
            'labels' => $displayLabels,
            'legend' => [
                'labels' => [
                    'fontFamily' => 'inherit',
                ],
            ],
        ];
    }
}
