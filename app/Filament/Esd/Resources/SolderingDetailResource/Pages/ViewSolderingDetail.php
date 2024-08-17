<?php

namespace App\Filament\Esd\Resources\SolderingDetailResource\Pages;

use App\Filament\Esd\Resources\SolderingDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSolderingDetail extends ViewRecord
{
    protected static string $resource = SolderingDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
