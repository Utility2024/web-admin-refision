<?php

namespace App\Filament\Esd\Resources\GroundMonitorBoxDetailResource\Pages;

use App\Filament\Esd\Resources\GroundMonitorBoxDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGroundMonitorBoxDetails extends ListRecords
{
    protected static string $resource = GroundMonitorBoxDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
