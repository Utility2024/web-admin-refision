<?php

namespace App\Filament\Esd\Resources\GloveResource\Pages;

use App\Filament\Esd\Resources\GloveResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGlove extends ViewRecord
{
    protected static string $resource = GloveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
