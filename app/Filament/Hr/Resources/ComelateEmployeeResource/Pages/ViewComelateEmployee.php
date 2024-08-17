<?php

namespace App\Filament\Hr\Resources\ComelateEmployeeResource\Pages;

use App\Filament\Hr\Resources\ComelateEmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewComelateEmployee extends ViewRecord
{
    protected static string $resource = ComelateEmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
