<?php

namespace App\Filament\Stock\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\DB;

class HTotalExpensesandIncome extends ApexChartWidget
{
    protected int|string|array $columnSpan = 'full';

    /**
     * ID Grafik
     *
     * @var string
     */
    protected static string $chartId = 'totalExpensesandIncome';

    /**
     * Judul Widget
     *
     * @var string|null
     */
    protected static ?string $heading = 'Pengeluaran dan Pendapatan';

    /**
     * Opsi Grafik (serangkaian data, label, tipe, ukuran, animasi...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        // Ambil data dinamis untuk grafik
        $year = $this->filterFormData['year'] ?? date('Y');
        $chartData = $this->getDataForChart($year);

        $totalPriceInData = $chartData['total_price_in'] ?? [];
        $totalPriceOutData = $chartData['total_price_out'] ?? [];
        $months = $chartData['months'] ?? [];

        return [
            'series' => [
                [
                    'name' => 'Total Pendapatan',
                    'data' => $totalPriceInData,
                ],
                [
                    'name' => 'Total Pengeluaran',
                    'data' => $totalPriceOutData,
                ],
            ],
            'chart' => [
                'height' => 350,
                'type' => 'area',
            ],
            'dataLabels' => [
                'enabled' => false,
                // 'formatter' => 'function(value, { seriesIndex, dataPointIndex, w }) {
                //     return w.config.series[seriesIndex].name + ": " + value.toFixed(2);
                // }',
            ],
            'stroke' => [
                'curve' => 'smooth',
            ],
            'xaxis' => [
                'categories' => $months,
            ],
            'tooltip' => [
                'enabled' => true, // Nonaktifkan tooltip
            ],
            'colors' => ['#10b981', '#dc2626'],
        ];
    }

    /**
     * Mendapatkan skema formulir untuk formulir filter
     *
     * @return array
     */
    protected function getFormSchema(): array
    {
        return [
            Select::make('year')
                ->options($this->getYears())
                ->default(date('Y'))
                ->label('Tahun'),
        ];
    }

    /**
     * Mendapatkan tahun yang tersedia dari tabel transaksi
     *
     * @return array
     */
    protected function getYears(): array
    {
        $years = DB::table('transactions')
            ->selectRaw('DISTINCT YEAR(date) as year')
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        return array_combine($years, $years);
    }

    /**
     * Mendapatkan data untuk grafik berdasarkan tahun yang dipilih
     *
     * @param int $year
     * @return array
     */
    protected function getDataForChart(int $year): array
    {
        $results = DB::table('transactions')
            ->select(
                DB::raw('DATE_FORMAT(date, "%m") as month'),
                DB::raw('SUM(CASE WHEN transaction_type = "IN" THEN total_price ELSE 0 END) as total_price_in'),
                DB::raw('SUM(CASE WHEN transaction_type = "OUT" THEN total_price ELSE 0 END) as total_price_out')
            )
            ->whereYear('date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        $chartData = [
            'months' => array_values($months),
            'total_price_in' => array_fill(0, 12, 0),
            'total_price_out' => array_fill(0, 12, 0),
        ];

        foreach ($results as $result) {
            $index = (int)$result->month - 1;
            $chartData['total_price_in'][$index] = (float) $result->total_price_in;
            $chartData['total_price_out'][$index] = (float) $result->total_price_out;
        }        

        return $chartData;
    }
}
