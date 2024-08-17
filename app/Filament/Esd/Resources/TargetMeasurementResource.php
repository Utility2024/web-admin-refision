<?php

namespace App\Filament\Esd\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\TargetMeasurement;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
// use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Esd\Resources\TargetMeasurementResource\Pages;
use App\Filament\Esd\Resources\TargetMeasurementResource\RelationManagers;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Illuminate\Database\Query\Builder;

class TargetMeasurementResource extends Resource
{
    protected static ?string $model = TargetMeasurement::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function getNavigationLabel(): string
    {
        return 'Objective Measurement';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('measurement_type')
                            ->options([
                                'IONIZATION' => 'IONIZATION',
                                'WORK SURFACE TABLE' => 'WORK SURFACE TABLE',
                                'SELVING RACK' => 'SELVING RACK',
                                'MOBILE TROLLEY' => 'MOBILE TROLLEY',
                                'SOLDERING' => 'SOLDERING',
                                'FLOORING' => 'FLOORING',
                                'EQUIPMENT GROUND' => 'EQUIPMENT GROUND',
                                'PACKAGING' => 'PACKAGING',
                                'GROUND MONITOR BOX' => 'GROUND MONITOR BOX',
                                'GARMENT' => 'GARMENT'
                            ]),
                        Forms\Components\TextInput::make('target')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('actual')
                            ->required()
                            ->numeric(),
                        Select::make('week')
                            ->required()
                            ->options(array_combine(range(1, 53), range(1, 53)))
                            ->placeholder('Select Week'),
                        Forms\Components\DatePicker::make('date_from')
                            ->required(),
                        Forms\Components\DatePicker::make('date_until')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('measurement_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('target')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()),
                Tables\Columns\TextColumn::make('actual')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()),
                Tables\Columns\TextColumn::make('percent')
                    ->searchable()
                    ->summarize(Summarizer::make()
                        ->label('Percentage Summary')
                        ->using(function (Builder $query): string {
                            // Get the sum of the column
                            $sum = $query->sum('percent');
                            
                            // Calculate the total count (adjust as needed)
                            $total = $query->count(); 
                            
                            // Calculate the percentage
                            $percentage = $total > 0 ? ($sum / $total) * 100 : 0;
                
                            // Format the percentage
                            return number_format($percentage) . '%';
                        })
                    ),
                Tables\Columns\TextColumn::make('week')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_from')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_until')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Created By')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updater.name')
                    ->label('Updated By')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTargetMeasurements::route('/'),
            'create' => Pages\CreateTargetMeasurement::route('/create'),
            'view' => Pages\ViewTargetMeasurement::route('/{record}'),
            'edit' => Pages\EditTargetMeasurement::route('/{record}/edit'),
        ];
    }
}
