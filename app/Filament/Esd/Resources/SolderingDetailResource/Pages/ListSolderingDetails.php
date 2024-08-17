<?php

namespace App\Filament\Esd\Resources\SolderingDetailResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Esd\Resources\SolderingDetailResource;
use App\Filament\Esd\Resources\SolderingDetailResource\Widgets\SolderingDetailStatsOverview;

class ListSolderingDetails extends ListRecords
{
    protected static string $resource = SolderingDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SolderingDetailStatsOverview::class,
        ];
    }
}
