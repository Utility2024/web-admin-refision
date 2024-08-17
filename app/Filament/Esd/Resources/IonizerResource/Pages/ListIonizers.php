<?php

namespace App\Filament\Esd\Resources\IonizerResource\Pages;

use App\Filament\Esd\Resources\IonizerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIonizers extends ListRecords
{
    protected static string $resource = IonizerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
