<?php

namespace App\Filament\Esd\Resources\WorksurfaceResource\Pages;

use App\Filament\Esd\Resources\WorksurfaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorksurfaces extends ListRecords
{
    protected static string $resource = WorksurfaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
