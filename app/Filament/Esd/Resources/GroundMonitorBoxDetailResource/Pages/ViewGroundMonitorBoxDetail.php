<?php

namespace App\Filament\Esd\Resources\GroundMonitorBoxDetailResource\Pages;

use App\Filament\Esd\Resources\GroundMonitorBoxDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGroundMonitorBoxDetail extends ViewRecord
{
    protected static string $resource = GroundMonitorBoxDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
