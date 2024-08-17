<?php

namespace App\Filament\Ga\Resources;

use App\Filament\Ga\Resources\DataFasilitasResource\Pages;
use App\Filament\Ga\Resources\DataFasilitasResource\RelationManagers;
use App\Models\DataFasilitas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;

class DataFasilitasResource extends Resource
{
    protected static ?string $model = DataFasilitas::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Facility';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('area_id')
                            ->relationship('area', 'area')
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'category')
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('register_no')
                            ->required()
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No.'),
                Tables\Columns\TextColumn::make('area.area')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.category')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('register_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('qr_code')
                    ->label('QR Code')
                    ->html()
                    ->getStateUsing(function ($record) {
                        $qrCode = base64_encode(QrCode::format('svg')->size(100)->generate($record->register_no));
                        return "<img src='data:image/svg+xml;base64,{$qrCode}' alt='QR Code' />";
                    }),
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
                Tables\Actions\BulkAction::make('Export Pdf')
                        ->icon('heroicon-m-arrow-down-tray')
                        ->openUrlInNewTab()
                        ->deselectRecordsAfterCompletion()
                        ->action(function (Collection $records) {
                            return response()->streamDownload(function () use ($records) {
                                echo Pdf::loadHTML(
                                    Blade::render('DataRegisterpdf', ['records' => $records])
                                )->stream();
                            }, 'DataRegister.pdf');
                        }),
                ExportBulkAction::make()
                    ->label('Export Excel'),
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDataFasilitas::route('/'),
            'create' => Pages\CreateDataFasilitas::route('/create'),
            'view' => Pages\ViewDataFasilitas::route('/{record}'),
            'edit' => Pages\EditDataFasilitas::route('/{record}/edit'),
        ];
    }
}
