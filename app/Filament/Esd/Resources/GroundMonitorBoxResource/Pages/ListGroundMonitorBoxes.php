<?php

namespace App\Filament\Esd\Resources\GroundMonitorBoxResource\Pages;

use App\Filament\Esd\Resources\GroundMonitorBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGroundMonitorBoxes extends ListRecords
{
    protected static string $resource = GroundMonitorBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
