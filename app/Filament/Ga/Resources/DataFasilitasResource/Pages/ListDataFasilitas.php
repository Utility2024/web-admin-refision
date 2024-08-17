<?php

namespace App\Filament\Ga\Resources\DataFasilitasResource\Pages;

use App\Filament\Ga\Resources\DataFasilitasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataFasilitas extends ListRecords
{
    protected static string $resource = DataFasilitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
