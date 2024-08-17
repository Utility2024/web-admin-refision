<?php

namespace App\Filament\Esd\Resources\EquipmentGroundResource\Pages;

use App\Filament\Esd\Resources\EquipmentGroundResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEquipmentGround extends ViewRecord
{
    protected static string $resource = EquipmentGroundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
