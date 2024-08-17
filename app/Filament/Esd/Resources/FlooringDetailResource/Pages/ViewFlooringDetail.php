<?php

namespace App\Filament\Esd\Resources\FlooringDetailResource\Pages;

use App\Filament\Esd\Resources\FlooringDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFlooringDetail extends ViewRecord
{
    protected static string $resource = FlooringDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
