<?php

namespace App\Filament\Esd\Resources\WorksurfaceResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Esd\Resources\WorksurfaceResource;
use App\Filament\Esd\Resources\WorksurfaceDetailResource\Widgets\WorksurfaceDetailStatsOverview;

class ViewWorksurface extends ViewRecord
{
    protected static string $resource = WorksurfaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

}
