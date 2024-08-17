<?php

namespace App\Filament\Esd\Resources\GarmentDetailResource\Pages;

use App\Filament\Esd\Resources\GarmentDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGarmentDetail extends ViewRecord
{
    protected static string $resource = GarmentDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
