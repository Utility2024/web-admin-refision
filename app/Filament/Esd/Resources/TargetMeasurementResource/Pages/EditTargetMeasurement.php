<?php

namespace App\Filament\Esd\Resources\TargetMeasurementResource\Pages;

use App\Filament\Esd\Resources\TargetMeasurementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTargetMeasurement extends EditRecord
{
    protected static string $resource = TargetMeasurementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
