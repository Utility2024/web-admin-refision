<?php

namespace App\Filament\Esd\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Glove;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\GloveDetail;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Esd\Resources\GloveResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Card as InfolistCard;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Esd\Resources\GloveResource\RelationManagers;

use App\Filament\Esd\Resources\GloveResource\RelationManagers\GloveDetailRelationManager;
use App\Filament\Esd\Resources\GloveResource\RelationManagers\GloveDetailsRelationManager;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;

class GloveResource extends Resource
{
    protected static ?string $model = Glove::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';

    protected static ?string $navigationGroup = 'Data master';

    protected static ?string $recordTitleAttribute = 'sap_code';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('sap_code')->required()->unique(ignorable:fn($record)=>$record),
                        TextInput::make('description')->required(),
                        TextInput::make('delivery')->required()
                    ])
                    ->columns(2),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistCard::make([
                    TextEntry::make('sap_code')->label('SAP CODE'),
                    TextEntry::make('description')->label('Description'),
                    TextEntry::make('delivery')->label('Delivery'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('sap_code')->sortable()->searchable(),
                TextColumn::make('description')->sortable()->searchable(),
                TextColumn::make('delivery')->sortable()->searchable(),
                TextColumn::make('qr_code')
                    ->label('QR Code')
                    ->html()
                    ->getStateUsing(function ($record) {
                        $qrCode = base64_encode(QrCode::format('svg')->size(100)->generate($record->sap_code));
                        return "<img src='data:image/svg+xml;base64,{$qrCode}' alt='QR Code' />";
                    }),
                TextColumn::make('related_count')
                    ->label('Measurement count')
                    ->badge()
                    ->color('primary')
                    ->getStateUsing(function ($record) {
                        return GloveDetail::where('glove_id', $record->id)->count();
                    }),
                TextColumn::make('judgement_counts')
                    ->label('OK / NG Count')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        $counts = $record->judgement_counts;
                        return "OK: {$counts['ok']} | NG: {$counts['ng']}";
                    })
                    ->formatStateUsing(function ($state, $record) {
                        $counts = $record->judgement_counts;
                        return "<span style='color: green;'>OK: {$counts['ok']}</span> | <span style='color: red;'>NG: {$counts['ng']}</span>";
                    })
                    ->html(),
                TextColumn::make('creator.name')
                    ->label('Created By')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updater.name')
                    ->label('Updated By')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('updated_at')
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
                                    Blade::render('Glovepdf', ['records' => $records])
                                )->stream();
                            }, 'Glove.pdf');
                        }),
                ExportBulkAction::make()
                    ->label('Export Excel'),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            GloveDetailRelationManager::class,
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGloves::route('/'),
            'create' => Pages\CreateGlove::route('/create'),
            'view' => Pages\ViewGlove::route('/{record}'),
            'edit' => Pages\EditGlove::route('/{record}/edit'),
        ];
    }
}
