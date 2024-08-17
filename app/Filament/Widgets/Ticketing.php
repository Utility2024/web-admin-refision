<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class Ticketing extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user(); // Mengambil pengguna yang saat ini sedang login

        // Kontrol akses berdasarkan role pengguna
        $stats = [];

<<<<<<< HEAD
        if ($user->isAdminEsd() || $user->isSuperAdmin() || $user->isUser()) {
            $totalemployee = Employee::count();

            $stats[] = Stat::make('Total Employee', $totalemployee)
                ->icon('heroicon-o-user-group')
                ->description('More Info')
                ->url('http://127.0.0.1:8000/hr/employees')
=======
        if ($user->isAdminEsd() || $user->isSuperAdmin() || $user->isUser() ) {
            $stats[] = Stat::make('ESD', 'Electrostatic Discharge')
                ->description('More Info')
                ->url('http://portal.siix-ems.co.id/esd')
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('success');
                // ->columnSpan(1);
        }

<<<<<<< HEAD
        if ($user->isAdminHr() || $user->isSuperAdmin()) {
            // Ambil total jobs dari sesi
            $totalJobs = session('total_jobs', 0);

            $stats[] = Stat::make('Total Jobs', $totalJobs)
                ->icon('heroicon-o-document-text')
                ->description('More Info')
                ->url('http://127.0.0.1:8000/admin/jobs')
=======
        if ($user->isAdminHr() || $user->isSuperAdmin() || $user->isSecurity() ) {
            $stats[] = Stat::make('HR', 'Human Resource')
                ->description('More Info')
                ->url('http://portal.siix-ems.co.id/hr')
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('danger');
        }

<<<<<<< HEAD
        if ($user->isAdminGa() || $user->isSuperAdmin()) {
            // Menghitung total tiket dari model Ticket
            $totalTickets = Ticket::count();

            $stats[] = Stat::make('Total Ticket', $totalTickets)
                ->icon('heroicon-o-ticket') // Menampilkan ikon heroicon-o-ticket sebelum angka total tiket
                ->description('More Info')
                ->url('http://127.0.0.1:8000/admin/tickets')
=======
        if ($user->isAdminGa() || $user->isSuperAdmin() || $user->isUser()) {
            $stats[] = Stat::make('GA', 'General Affair')
                ->description('More Info')
                ->url('http://portal.siix-ems.co.id/ga')
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('warning');
        }

        if ($user->isAdminUtility() || $user->isSuperAdmin()) {
<<<<<<< HEAD
            $stats[] = Stat::make('Total Assets', '0')
                ->icon('heroicon-o-archive-box')
                ->description('More Info')
                ->url('http://127.0.0.1:8000/ga')
=======
            $stats[] = Stat::make('Building', 'Utility And Facility')
                ->description('More Info')
                ->url('http://portal.siix-ems.co.id/utility')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('info');
        }

        if ($user->isAdminUtility() || $user->isAdminEsd() || $user->isAdminHr() || $user->isAdminGa() || $user->isSuperAdmin()) {
            $stats[] = Stat::make('Stock Control Material', 'Stock Material')
                ->description('More Info')
                ->url('http://portal.siix-ems.co.id/stock')
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('info');
        }

        return $stats;
    }
}
