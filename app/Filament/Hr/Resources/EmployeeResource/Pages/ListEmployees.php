<?php

namespace App\Filament\Hr\Resources\EmployeeResource\Pages;

use App\Filament\Hr\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
<<<<<<< HEAD
            Actions\CreateAction::make(),
=======
            // Actions\CreateAction::make(),
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
        ];
    }
}
