<?php

namespace App\Filament\Esd\Resources\PackagingResource\Pages;

use App\Filament\Esd\Resources\PackagingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPackagings extends ListRecords
{
    protected static string $resource = PackagingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
