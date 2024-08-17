<?php

namespace App\Filament\Esd\Resources\GarmentDetailResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Esd\Resources\GarmentDetailResource;
use App\Filament\Esd\Resources\GarmentDetailResource\Widgets\GarmentDetailStatsOverview;

class ListGarmentDetails extends ListRecords
{
    protected static string $resource = GarmentDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            GarmentDetailStatsOverview::class,
        ];
    }
}
