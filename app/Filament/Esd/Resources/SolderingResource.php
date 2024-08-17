<?php

namespace App\Filament\Esd\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Soldering;
use Filament\Tables\Table;
use App\Models\SolderingDetail;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Esd\Resources\SolderingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Card as InfolistCard;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Esd\Resources\SolderingResource\RelationManagers;

use App\Filament\Esd\Resources\SolderingResource\RelationManagers\SolderingDetailRelationManager;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;

class SolderingResource extends Resource
{
    protected static ?string $model = Soldering::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    protected static ?string $navigationGroup = 'Data master';

    protected static ?string $recordTitleAttribute = 'register_no';



    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
                ->schema([
                    TextInput::make('register_no')->required()->unique(ignorable:fn($record)=>$record),
                    TextInput::make('area')->required(),
                    TextInput::make('location')->required()
                ])  
                 
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistCard::make([
                    TextEntry::make('register_no')->label('Register No'),
                    TextEntry::make('area')->label('Area'),
                    TextEntry::make('location')->label('Location'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('register_no')->sortable()->searchable(),
                TextColumn::make('area')->sortable()->searchable(),
                TextColumn::make('location')->sortable()->searchable(),
                TextColumn::make('qr_code')
                    ->label('QR Code')
                    ->html()
                    ->getStateUsing(function ($record) {
                        $qrCode = base64_encode(QrCode::format('svg')->size(100)->generate($record->register_no));
                        return "<img src='data:image/svg+xml;base64,{$qrCode}' alt='QR Code' />";
                    }),
                TextColumn::make('related_count')
                    ->label('Measurement count')
                    ->badge()
                    ->color('primary')
                    ->getStateUsing(function ($record) {
                        return SolderingDetail::where('soldering_id', $record->id)->count();
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
                                    Blade::render('Solderingpdf', ['records' => $records])
                                )->stream();
                            }, 'Soldering.pdf');
                        }),
                ExportBulkAction::make()
                    ->label('Export Excel'),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SolderingDetailRelationManager::class,
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSolderings::route('/'),
            'create' => Pages\CreateSoldering::route('/create'),
            'view' => Pages\ViewSoldering::route('/{record}'),
            'edit' => Pages\EditSoldering::route('/{record}/edit'),
        ];
    }
}
