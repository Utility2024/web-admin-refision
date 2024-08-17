<?php

namespace App\Filament\Esd\Resources\TargetMeasurementResource\Pages;

use App\Filament\Esd\Resources\TargetMeasurementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTargetMeasurements extends ListRecords
{
    protected static string $resource = TargetMeasurementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
