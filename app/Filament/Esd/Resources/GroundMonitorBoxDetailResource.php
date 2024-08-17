<?php

namespace App\Filament\Esd\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\GroundMonitorBox;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Forms\Components\ToggleButtons;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Blade;
use App\Models\GroundMonitorBoxDetail;
use Filament\Tables\Filters\Indicator;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Card as InfolistCard;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Esd\Resources\GroundMonitorBoxDetailResource\Pages;


class GroundMonitorBoxDetailResource extends Resource
{
    protected static ?string $model = GroundMonitorBoxDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationGroup = 'Data measurement';



    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Card::make([
                    Select::make('ground_monitor_box_id')
                        ->label('Register No')
                        ->required()
                        ->relationship('groundMonitorBox', 'register_no')
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(function (callable $set, $state) {
                            $GroundMonitorBox = GroundMonitorBox::find($state);
                            if ($GroundMonitorBox) {
                                $set('area', $GroundMonitorBox->area);
                                $set('location', $GroundMonitorBox->location);
                            } else {
                                $set('area', null);
                                $set('location', null);
                            }
                        }),
                    TextInput::make('area')
                        ->required()
                        ->label('Area'),
                    TextInput::make('location')
                        ->required()
                        ->label('Location'),
                    Forms\Components\ToggleButtons::make('g1')
                        ->options([
                            'YES' => 'YES',
                            'NO' => 'NO'
                        ])
                        ->colors([
                            'YES' => 'success',
                            'NO' => 'danger'
                        ])
                        ->inline(),
                    Forms\Components\ToggleButtons::make('g2')
                        ->options([
                            'YES' => 'YES',
                            'NO' => 'NO'
                        ])
                        ->colors([
                            'YES' => 'success',
                            'NO' => 'danger'
                        ])
                        ->inline(),
                    Textarea::make('remarks')
                        ->maxLength(255)
                        ->label('Remarks'),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistCard::make([
                    TextEntry::make('groundMonitorBox.register_no')->label('Ground Monitor Box'),
                    TextEntry::make('groundMonitorBox.area')->label('Area'),
                    TextEntry::make('groundMonitorBox.location')->label('Location'),
                ])->columns(2),
                InfolistCard::make([
                    TextEntry::make('g1')->label('G1')
                        ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'YES' => 'success',
                                'No' => 'danger',
                            }),
                    TextEntry::make('g2')->label('G2')
                        ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'YES' => 'success',
                                'No' => 'danger',
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
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('groundMonitorBox.register_no')->label('Ground Monitor Box')->sortable()->searchable(),
                TextColumn::make('groundMonitorBox.area')->label('Area')->sortable()->searchable(),
                TextColumn::make('groundMonitorBox.location')->label('Location')->sortable()->searchable(),
                TextColumn::make('g1')->sortable()->searchable()
                    ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'YES' => 'success',
                            'No' => 'danger',
                        }),
                TextColumn::make('g2')->sortable()->searchable()
                    ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'YES' => 'success',
                            'NO' => 'danger',
                        }),
                TextColumn::make('remarks')->sortable()->searchable(),
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
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('register_no')
                    ->label('Register No')
                    ->relationship('groundmonitorbox', 'register_no')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('area')
                    ->label('Area')
                    ->relationship('groundmonitorbox', 'area')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('location')
                    ->label('Location')
                    ->relationship('groundmonitorbox', 'location')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('g1')
                    ->label('G1')
                    ->options([
                        'YES' => 'YES',
                        'NO' => 'NO',
                    ]),
                SelectFilter::make('g2')
                    ->label('G2')
                    ->options([
                        'YES' => 'YES',
                        'NO' => 'NO',
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
                                        Blade::render('GroundMonitorBoxDetailpdf', ['records' => $records])
                                    )->stream();
                                }, 'Report_ground_monitor_box_measurement.pdf');
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
            'index' => Pages\ListGroundMonitorBoxDetails::route('/'),
            'create' => Pages\CreateGroundMonitorBoxDetail::route('/create'),
            'view' => Pages\ViewGroundMonitorBoxDetail::route('/{record}'),
            'edit' => Pages\EditGroundMonitorBoxDetail::route('/{record}/edit'),
        ];
    }
}
