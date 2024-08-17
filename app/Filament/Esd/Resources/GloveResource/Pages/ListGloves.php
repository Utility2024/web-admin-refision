<?php

namespace App\Filament\Esd\Resources\GloveResource\Pages;

use App\Filament\Esd\Resources\GloveResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGloves extends ListRecords
{
    protected static string $resource = GloveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
