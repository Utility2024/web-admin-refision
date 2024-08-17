<?php

namespace App\Filament\Ga\Resources;

use Filament\Forms;
use App\Models\Area;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Ga\Resources\AreaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Ga\Resources\AreaResource\RelationManagers;

class AreaResource extends Resource
{
    protected static ?string $model = Area::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('area')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('standard_area')
                            ->required()
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('area')
                    ->searchable(),
                Tables\Columns\TextColumn::make('standard_area')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_by')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAreas::route('/'),
            'create' => Pages\CreateArea::route('/create'),
            'view' => Pages\ViewArea::route('/{record}'),
            'edit' => Pages\EditArea::route('/{record}/edit'),
        ];
    }
}
