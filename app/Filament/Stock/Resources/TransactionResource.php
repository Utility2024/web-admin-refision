<?php

namespace App\Filament\Stock\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Material;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Forms\Components\TextArea;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Forms\Components\ToggleButtons;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Stock\Widgets\HTotalExpensesandIncome;
use Filament\Infolists\Components\Card as InfolistCard;
use App\Filament\Stock\Resources\TransactionResource\Pages;
use App\Filament\Stock\Resources\TransactionResource\RelationManagers;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-left-end-on-rectangle';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Card::make()
                ->schema([
                Forms\Components\Select::make('material_id')
                    ->label('SAP Code')
                    ->required()
                    ->searchable()
                    ->reactive()
                    ->options(function () {
                        return Material::query()
                            ->select('id', 'sap_code', 'description')
                            ->get()
                            ->mapWithKeys(function ($material) {
                                return [
                                    $material->id => $material->sap_code . ' - ' . $material->description
                                ];
                            });
                    })
                    ->afterStateUpdated(function (callable $set, $state) {
                        $material = Material::find($state);
                        if ($material) {
                            $set('description_id', $material->description);
                            $set('type', $material->type);
                            $set('last_stock', $material->last_stock);
                            $set('price', $material->price); // Use 'price' from material
                        } else {
                            $set('description_id', null);
                            $set('type', null);
                            $set('last_stock', null);
                            $set('price', null);
                        }
                    }),
                Forms\Components\TextInput::make('description_id')
                    ->label('Description')
                    ->required()
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\TextInput::make('type')
                    ->label('Type')
                    ->required()
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\TextInput::make('last_stock')
                    ->label('Last Stock')
                    ->disabled(),
                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->prefix('IDR')
                    ->disabled()
                    ->dehydrated(), // Make price read-only
                Forms\Components\ToggleButtons::make('transaction_type')
                    ->options([
                        'IN' => 'IN',
                        'OUT' => 'OUT'
                    ])
                    ->icons([
                        'IN' => 'heroicon-o-arrow-left-end-on-rectangle',
                        'OUT' => 'heroicon-o-arrow-right-start-on-rectangle',
                    ])
                    ->colors([
                        'IN' => 'info',
                        'OUT' => 'danger'
                    ])
                    ->inline()
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('pic')
                    ->required()
                    ->label('PIC')
                    ->maxLength(255),
                Forms\Components\TextArea::make('keterangan')
                    ->maxLength(255),
            ])->Columns(2)
            
        ]);
    }



    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistCard::make([
                    TextEntry::make('material.sap_code')
                        ->label('SAP Code')
                ])->columns(2),
                InfolistCard::make([
                    TextEntry::make('material.description')
                        ->label('Description'),
                    TextEntry::make('material.type')
                        ->label('Type')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Spare Part' => 'info',
                            'Indirect Material' => 'warning',
                            'Office Supply' => 'success',
                        }),
                    TextEntry::make('transaction_type')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'IN' => 'info',
                            'OUT' => 'danger'
                        })
                        ->icons([
                            'IN' => 'heroicon-o-arrow-left-end-on-rectangle',
                            'OUT' => 'heroicon-o-arrow-right-start-on-rectangle',
                        ])
                ])->columns(2),
                InfolistCard::make([
                    TextEntry::make('date')
                        ->date(),
                    TextEntry::make('qty'),
                    TextEntry::make('price')
                        ->money('IDR')
                        ->badge(),
                    // TextEntry::make('total_price_in')
                    //     ->money('USD')
                    //     ->badge(),
                    // TextEntry::make('total_price_out')
                    //     ->money('USD')
                    //     ->badge(),
                    TextEntry::make('total_price')
                        ->money('IDR')
                        ->badge(),
                    TextEntry::make('pic')
                        ->label('PIC'),
                    TextEntry::make('keterangan')
                        ->label('Keterangan')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('material.sap_code')
                    ->label('SAP Code')
                    ->sortable(),
                Tables\Columns\TextColumn::make('material.description')
                    ->label('Description')
                    ->sortable(),
                Tables\Columns\TextColumn::make('material.type')
                    ->label('Type')
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Spare Part' => 'info',
                        'Indirect Material' => 'warning',
                        'Office Supply' => 'success',
                    }),
                Tables\Columns\TextColumn::make('transaction_type')
                    ->searchable()
                    ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'IN' => 'info',
                            'OUT' => 'danger'
                        })
                        ->icons([
                            'IN' => 'heroicon-o-arrow-left-end-on-rectangle',
                            'OUT' => 'heroicon-o-arrow-right-start-on-rectangle',
                        ]),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable()
                    ->summarize(Sum::make()->money('IDR')),
                // Tables\Columns\TextColumn::make('total_price_in')
                //     ->money('USD')
                //     ->sortable()
                //     ->badge()
                //     ->summarize(Sum::make()->money('USD')),
                // Tables\Columns\TextColumn::make('total_price_out')
                //     ->money('USD')
                //     ->sortable()
                //     ->badge()
                //     ->summarize(Sum::make()->money('USD')),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('IDR')
                    ->sortable()
                    ->summarize(Sum::make()->money('IDR')),
                Tables\Columns\TextColumn::make('pic')
                    ->searchable()
                    ->label('PIC'),
                Tables\Columns\TextColumn::make('keterangan')
                    ->searchable()
                    ->label('Keterangan'),
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
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('material_id')
                    ->label('SAP Code')
                    ->relationship('material', 'sap_code')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('type')
                    ->options([
                        'Spare Part' => 'Spare Part',
                        'Indirect Material' => 'Indirect Material',
                        'Office Supply' => 'Office Supply',
                    ])
                    ->label('Type'),
                Filter::make('date')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    })
                
                
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make()
                    ->label('Export Excel'),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public function getTableBulkActions()
    {
        return  [
            ExportBulkAction::make()
        ];
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'view' => Pages\ViewTransaction::route('/{record}'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function getDataForChart($startDate, $endDate): array
    {
        // Mengambil data transaksi
        $data = Transaction::selectRaw('DATE(date) as date, transaction_type, SUM(qty) as total')
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('date', 'transaction_type')
            ->orderBy('date')
            ->get();

        // Menginisialisasi struktur data chart
        $chartData = [
            'dates' => [],
            'in' => [],
            'out' => []
        ];

        // Inisialisasi array dengan nilai default
        $currentDate = $startDate;
        while (strtotime($currentDate) <= strtotime($endDate)) {
            $chartData['dates'][] = $currentDate;
            $chartData['in'][] = 0;
            $chartData['out'][] = 0;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        // Mengisi data dari query ke dalam struktur data chart
        foreach ($data as $row) {
            $dateIndex = array_search($row->date, $chartData['dates']);
            if ($dateIndex !== false) {
                if ($row->transaction_type == 'IN') {
                    $chartData['in'][$dateIndex] = $row->total;
                } else {
                    $chartData['out'][$dateIndex] = $row->total;
                }
            }
        }

        return $chartData;
    }




    public static function getDataForYearlyChart($year): array
    {
        $data = Transaction::selectRaw('DATE_FORMAT(date, "%m") as month, transaction_type, SUM(qty) as total_qty, SUM(total_price) as total_price')
            ->whereYear('date', $year)
            ->groupBy('month', 'transaction_type')
            ->orderBy('month')
            ->get();

        $months = [
            '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
            '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
            '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
        ];

        $chartData = [
            'months' => array_values($months),
            'in' => array_fill(0, 12, 0),
            'out' => array_fill(0, 12, 0),
            'total_price' => array_fill(0, 12, 0),
        ];

        foreach ($data as $row) {
            $index = (int)$row->month - 1;
        
            if ($row->transaction_type == 'IN') {
                $chartData['in'][$index] = number_format($row->total_qty, 2, '.', '');
            } else {
                $chartData['out'][$index] = number_format($row->total_qty, 2, '.', '');
            }
        
            // Pastikan variabel ini ada jika menggunakan '+='
            if (!isset($chartData['total_price'][$index])) {
                $chartData['total_price'][$index] = 0;
            }
        
            $chartData['total_price'][$index] += number_format($row->total_price, 2, '.', '');
        }
        

        return $chartData;
    }

    
    public static function getDataForUserChart(): array
    {
        $data = Transaction::selectRaw('pic, transaction_type, SUM(qty) as total')
            ->groupBy('pic', 'transaction_type')
            ->orderBy('pic')
            ->get();

        $chartData = [
            'pics' => [],
            'in' => [],
            'out' => []
        ];

        $picIndex = [];

        foreach ($data as $row) {
            if (!in_array($row->pic, $chartData['pics'])) {
                $chartData['pics'][] = $row->pic;
                $picIndex[$row->pic] = count($chartData['pics']) - 1;
                $chartData['in'][] = 0;
                $chartData['out'][] = 0;
            }

            if ($row->transaction_type == 'IN') {
                $chartData['in'][$picIndex[$row->pic]] = $row->total;
            } else {
                $chartData['out'][$picIndex[$row->pic]] = $row->total;
            }
        }

        return $chartData;
    }

    public static function getLatestTransactions(int $limit = 5)
    {
        return Transaction::latest()->limit($limit)->get();
    }

    public static function getTransactionDataForChart(): array
    {
        $data = Transaction::selectRaw('DATE(date) as date, SUM(price * qty) as total_price')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartData = [
            'dates' => [],
            'data' => [],
        ];

        foreach ($data as $row) {
            $chartData['dates'][] = $row->date;
            $chartData['data'][] = [
                'x' => $row->date,
                'y' => $row->total_price,
            ];
        }

        return $chartData;
    }

    public static function HTotalExpensesandIncome()
    {
        $data = Transaction::selectRaw('transaction_type, SUM(price * qty) as total_price')
            ->groupBy('transaction_type')
            ->get();
    
        $total_expenses = 0;
        $total_income = 0;
    
        foreach ($data as $row) {
            if ($row->transaction_type == 'OUT') {
                $total_expenses += $row->total_price;
            } elseif ($row->transaction_type == 'IN') {
                $total_income += $row->total_price;
            }
        }
    
        return [
            'total_price_in' => $total_income,
            'total_price_out' => $total_expenses,
            'dates' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], // Replace with actual dates
        ];
    }



}
