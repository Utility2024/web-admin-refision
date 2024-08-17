<?php

namespace App\Filament\Ga\Resources\DataFasilitasResource\Pages;

use App\Filament\Ga\Resources\DataFasilitasResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDataFasilitas extends ViewRecord
{
    protected static string $resource = DataFasilitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
