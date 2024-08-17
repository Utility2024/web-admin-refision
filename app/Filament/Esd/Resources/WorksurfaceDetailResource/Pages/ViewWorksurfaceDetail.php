<?php

namespace App\Filament\Esd\Resources\WorksurfaceDetailResource\Pages;

use App\Filament\Esd\Resources\WorksurfaceDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWorksurfaceDetail extends ViewRecord
{
    protected static string $resource = WorksurfaceDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
