<?php

namespace App\Filament\Hr\Resources\EmployeeResource\Pages;

use App\Filament\Hr\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployee extends ViewRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
<<<<<<< HEAD
            Actions\EditAction::make(),
=======
            // Actions\EditAction::make(),
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
        ];
    }
}
