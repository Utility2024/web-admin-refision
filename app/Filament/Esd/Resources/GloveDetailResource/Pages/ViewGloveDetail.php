<?php

namespace App\Filament\Esd\Resources\GloveDetailResource\Pages;

use App\Filament\Esd\Resources\GloveDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGloveDetail extends ViewRecord
{
    protected static string $resource = GloveDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
