<?php

namespace App\Filament\Esd\Resources\PackagingDetailResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Esd\Resources\PackagingDetailResource;
use App\Filament\Esd\Resources\PackagingDetailResource\Widgets\PackagingDetailStatsOverview;

class ListPackagingDetails extends ListRecords
{
    protected static string $resource = PackagingDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PackagingDetailStatsOverview::class,
        ];
    }
}
