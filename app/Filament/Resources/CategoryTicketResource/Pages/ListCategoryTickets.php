<?php

namespace App\Filament\Resources\CategoryTicketResource\Pages;

use App\Filament\Resources\CategoryTicketResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryTickets extends ListRecords
{
    protected static string $resource = CategoryTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
