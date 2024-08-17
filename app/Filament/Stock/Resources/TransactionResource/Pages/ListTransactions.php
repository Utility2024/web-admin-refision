<?php

namespace App\Filament\Stock\Resources\TransactionResource\Pages;

use Filament\Actions;
use Livewire\WithPagination;
use Maatwebsite\Excel\Excel;
use Filament\Resources\Components\Tab;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use App\Filament\Stock\Resources\TransactionResource;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'IN' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('transaction_type', 'IN')),
            'OUT' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('transaction_type', 'OUT')),
        ];
    }

    public function getTableRecordsCount(): int
    {
        return $this->getTableRecordsQuery()->count();
    }

    public function getRowNumber($index): int
    {
        return $this->getTableRecordsCount() - $index;
    }
}
