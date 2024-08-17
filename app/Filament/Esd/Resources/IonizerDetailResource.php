<?php

namespace App\Filament\Esd\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Ionizer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\IonizerDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Illuminate\Support\Collection;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Forms\Components\ToggleButtons;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Blade;
use Filament\Tables\Filters\Indicator;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Esd\Resources\IonizerDetailResource\Pages;
use Filament\Infolists\Components\Card as InfolistCard;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

use App\Filament\Esd\Resources\IonizerDetailResource\RelationManagers;

class IonizerDetailResource extends Resource
{
    protected static ?string $model = IonizerDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    protected static ?string $navigationGroup = 'Data measurement';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                    Forms\Components\Select::make('ionizer_id')
                        ->label('Register No')
                        ->required()
                        ->relationship('Ionizer', 'register_no')
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(function (callable $set, $state) {
                            $Ionizer = Ionizer::find($state);
                            if ($Ionizer) {
                                $set('area', $Ionizer->area);
                                $set('location', $Ionizer->location);
                            } else {
                                $set('area', null);
                                $set('location', null);
                            }
                        }),
                    Forms\Components\TextInput::make('area')
                        ->required()
                        ->label('Area'),
                    Forms\Components\TextInput::make('location')
                        ->required()
                        ->label('Location'),
                    ]),
                Card::make()
                    ->schema([
                    Radio::make('pm_1')
                        ->label('PM 1')
                        ->options([
                            'FLASH' => 'FLASH',
                            'NO' => 'NO',
                        ])
                        ->inline()
                        ->required()
                        ->inlineLabel(false),
                    Radio::make('pm_2')
                        ->label('PM 2')
                        ->options([
                            'OK' => 'OK',
                            'NO' => 'NO',
                        ])
                        ->inline()
                        ->required()
                        ->inlineLabel(false),
                    Radio::make('pm_3')
                        ->label('PM 3')
                        ->options([
                            'YES' => 'YES',
                            'NO' => 'NO',
                        ])
                        ->inline()
                        ->required()
                        ->inlineLabel(false),
                    ]),
                Card::make()
                    ->schema([
                    // Shout::make('so-important')
                    //     ->content('Glove Point to point ( 1.00E+5 - 1.00E+11 Ohm )')
                    //     ->color(Color::Yellow),
                    Forms\Components\TextInput::make('c1')
                        ->required()
                        ->numeric()
                        ->label('C1')
                        ->reactive() // Make the field reactive
                        ->afterStateUpdated(function ($state, callable $set) {
                            // Set the value of 'judgement' based on 'e1' value
                            $set('judgement_c1', $state > 8.00 ? 'NG' : 'OK');
                        }),
                    Forms\Components\ToggleButtons::make('judgement_c1')
                        ->options([
                            'OK' => 'OK',
                            'NG' => 'NG'
                        ])
                        ->colors([
                            'OK' => 'success',
                            'NG' => 'danger'
                        ])
                        ->inline()
                        ->disabled()
                        ->dehydrated(),
                    ]),
                Card::make()
                    ->schema([
                    // Shout::make('so-important')
                    //     ->content('Glove Point to point ( 1.00E+5 - 1.00E+11 Ohm )')
                    //     ->color(Color::Yellow),
                    Forms\Components\TextInput::make('c2')
                        ->required()
                        ->numeric()
                        ->label('C2')
                        ->reactive() // Make the field reactive
                        ->afterStateUpdated(function ($state, callable $set) {
                            // Set the value of 'judgement' based on 'e1' value
                            $set('judgement_c2', $state > 8.00 ? 'NG' : 'OK');
                        }),
                    Forms\Components\ToggleButtons::make('judgement_c2')
                        ->options([
                            'OK' => 'OK',
                            'NG' => 'NG'
                        ])
                        ->colors([
                            'OK' => 'success',
                            'NG' => 'danger'
                        ])
                        ->inline()
                        ->disabled()
                        ->dehydrated(),
                    ]),
                Card::make()
                    ->schema([
                    // Shout::make('so-important')
                    //     ->content('Glove Point to point ( 1.00E+5 - 1.00E+11 Ohm )')
                    //     ->color(Color::Yellow),
                    Forms\Components\TextInput::make('c3')
                        ->required()
                        ->numeric()
                        ->label('C3')
                        ->reactive() // Make the field reactive
                        ->afterStateUpdated(function ($state, callable $set) {
                            // Set the value of 'judgement_c3' based on 'c3' value
                            if ($state < -35.00 || $state > 35.00) {
                                $set('judgement_c3', 'NG');
                            } else {
                                $set('judgement_c3', 'OK');
                            }
                        }),
                    Forms\Components\ToggleButtons::make('judgement_c3')
                        ->options([
                            'OK' => 'OK',
                            'NG' => 'NG'
                        ])
                        ->colors([
                            'OK' => 'success',
                            'NG' => 'danger'
                        ])
                        ->inline()
                        ->disabled()
                        ->dehydrated(),
                    ]),
                Card::make()
                    ->schema([
                    Forms\Components\Textarea::make('remarks')
                        ->maxLength(65535),
                ])         
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistCard::make([
                    TextEntry::make('ionizer.register_no')->label('Register No'),
                    TextEntry::make('ionizer.area')->label('Area'),
                    TextEntry::make('ionizer.location')->label('Location'),
                ])->columns(2),
                InfolistCard::make([
                    TextEntry::make('pm_1')->label('PM 1')
                        ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'NO' => 'success',
                                'FLASH' => 'danger',
                            }),
                    TextEntry::make('pm_2')->label('PM 2')
                        ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'OK' => 'success',
                                'NO' => 'danger',
                            }),
                    TextEntry::make('pm_3')->label('PM 3')
                        ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'YES' => 'success',
                                'NO' => 'danger',
                            }),
                ])->columns(3),
                InfolistCard::make([
                    TextEntry::make('c1')->label('C1'),
                    TextEntry::make('judgement_c1')->label('Judgement C1')
                        ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'OK' => 'success',
                                'NG' => 'danger',
                            }),
                    TextEntry::make('c2')->label('C2'),
                    TextEntry::make('judgement_c2')->label('Judgement C2')
                        ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'OK' => 'success',
                                'NG' => 'danger',
                            }),
                    TextEntry::make('c3')->label('C3'),
                    TextEntry::make('judgement_c3')->label('Judgement C3')
                        ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'OK' => 'success',
                                'NG' => 'danger',
                            }),
                ])->columns(2),
                InfolistCard::make([
                    TextEntry::make('remarks')->label('Remarks'),
                    TextEntry::make('created_at')->label('Created At')->date(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('ionizer.register_no')->label('Register No'),
                Tables\Columns\TextColumn::make('ionizer.area')->label('Area'),
                Tables\Columns\TextColumn::make('ionizer.location')->label('Location'),
                Tables\Columns\TextColumn::make('pm_1')->label('PM 1')->sortable()->searchable()
                    ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'NO' => 'success',
                                    'FLASH' => 'danger',
                                }),
                Tables\Columns\TextColumn::make('pm_2')->label('PM 2')->sortable()->searchable()
                    ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'OK' => 'success',
                                    'NO' => 'danger',
                                }),
                Tables\Columns\TextColumn::make('pm_3')->label('PM 3')->sortable()->searchable()
                    ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'YES' => 'success',
                                    'NO' => 'danger',
                                }),
                Tables\Columns\TextColumn::make('c1')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('judgement_c1')->label('Judgement C1')->sortable()->searchable()
                    ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'OK' => 'success',
                            'NG' => 'danger',
                        }),
                Tables\Columns\TextColumn::make('c2')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('judgement_c2')->label('Judgement C2')->sortable()->searchable()
                    ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'OK' => 'success',
                            'NG' => 'danger',
                        }),
                Tables\Columns\TextColumn::make('c3')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('judgement_c3')->label('Judgement C3')->sortable()->searchable()
                    ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'OK' => 'success',
                            'NG' => 'danger',
                        }),
                Tables\Columns\TextColumn::make('remarks')->sortable()->searchable(),
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
                SelectFilter::make('register_no')
                    ->label('Register No')
                    ->relationship('ionizer', 'register_no')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('area')
                    ->label('Area')
                    ->relationship('ionizer', 'area')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('location')
                    ->label('Location')
                    ->relationship('ionizer', 'location')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('pm_1')
                    ->label('PM 1')
                    ->options([
                        'NO' => 'NO',
                        'FLASH' => 'FLASH',
                    ]),
                SelectFilter::make('pm_2')
                    ->label('PM 1')
                    ->options([
                        'OK' => 'OK',
                        'NO' => 'NO',
                    ]),
                SelectFilter::make('pm_3')
                    ->label('PM 1')
                    ->options([
                        'YES' => 'YES',
                        'NO' => 'NO',
                    ]),
                SelectFilter::make('judgement_c1')
                    ->label('Judgement C1')
                    ->options([
                        'OK' => 'OK',
                        'NG' => 'NG',
                    ]),
                SelectFilter::make('judgement_c2')
                    ->label('Judgement C2')
                    ->options([
                        'OK' => 'OK',
                        'NG' => 'NG',
                    ]),
                SelectFilter::make('judgement_c3')
                    ->label('Judgement C3')
                    ->options([
                        'OK' => 'OK',
                        'NG' => 'NG',
                    ]),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                 
                        if ($data['created_from'] ?? null) {
                            $indicators[] = Indicator::make('Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString())
                                ->removeField('created_from');
                        }
                 
                        if ($data['created_until'] ?? null) {
                            $indicators[] = Indicator::make('Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString())
                                ->removeField('created_until');
                        }
                 
                        return $indicators;
                    })
                ])->filtersTriggerAction(
                    fn (Action $action) => $action
                        ->button()
                        ->label('Filter'))
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
                                            Blade::render('IonizerDetailpdf', ['records' => $records])
                                        )->stream();
                                    }, 'Report_ionizer_measurement.pdf');
                                }),
                    ExportBulkAction::make()
                        ->label('Export Excel'),
                    Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIonizerDetails::route('/'),
            'create' => Pages\CreateIonizerDetail::route('/create'),
            'view' => Pages\ViewIonizerDetail::route('/{record}'),
            'edit' => Pages\EditIonizerDetail::route('/{record}/edit'),
        ];
    }
}
