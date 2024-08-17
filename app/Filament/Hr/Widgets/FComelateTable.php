<?php

namespace App\Filament\Hr\Widgets;

use Filament\Tables;
use App\Models\Employee;
use Filament\Tables\Table;
use App\Models\ComelateEmployee;
use Filament\Widgets\TableWidget as BaseWidget;

class FComelateTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Employee::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('user_login')
                    ->label('NIK')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('Display_Name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Department')
                    ->label('Department')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Last_Jobs')
                    ->label('Last Jobs')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Last_Route')
                    ->label('Last Route')
                    ->searchable(),
                Tables\Columns\TextColumn::make('related_count')
                    ->label('Comelate Count')
                    ->badge()
                    ->color('primary')
                    // ->sortable()
                    ->getStateUsing(function ($record) {
                        return ComelateEmployee::where('nik', $record->user_login)->count();
                    })
                ]);
            // ->defaultSort('related_count', 'desc');
    }
}
