<?php

namespace App\Filament\Hr\Resources\ComelateEmployeeResource\Pages;

use App\Filament\Hr\Resources\ComelateEmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComelateEmployees extends ListRecords
{
    protected static string $resource = ComelateEmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
