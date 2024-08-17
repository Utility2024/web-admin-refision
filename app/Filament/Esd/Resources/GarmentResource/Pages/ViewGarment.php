<?php

namespace App\Filament\Esd\Resources\GarmentResource\Pages;

use App\Filament\Esd\Resources\GarmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGarment extends ViewRecord
{
    protected static string $resource = GarmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
