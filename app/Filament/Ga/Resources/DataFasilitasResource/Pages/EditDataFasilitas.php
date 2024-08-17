<?php

namespace App\Filament\Ga\Resources\DataFasilitasResource\Pages;

use App\Filament\Ga\Resources\DataFasilitasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataFasilitas extends EditRecord
{
    protected static string $resource = DataFasilitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
