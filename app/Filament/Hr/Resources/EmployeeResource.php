<?php

namespace App\Filament\Hr\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Tables\Table;
<<<<<<< HEAD
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
// use Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Hr\Resources\EmployeeResource\Pages;
use App\Filament\Hr\Resources\EmployeeResource\RelationManagers;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Card as InfolistCard;
=======
use Forms\Components\Select;
use App\Models\ComelateEmployee;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Hr\Resources\EmployeeResource\Pages;
use Filament\Infolists\Components\Card as InfolistCard;
use App\Filament\Hr\Resources\EmployeeResource\RelationManagers;
use App\Filament\Hr\Resources\EmployeeResource\RelationManagers\ComelateEmployeesRelationManager;
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

<<<<<<< HEAD
    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([    
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('dept')
                            ->label('Department')
                            ->required()
                            ->maxLength(255),
                    ])
            ]);
    }
=======
    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Forms\Components\TextInput::make('ID')
    //                 ->label('ID')
    //                 ->disabled(),
                
    //             Forms\Components\TextInput::make('Departement')
    //                 ->label('Department')
    //                 ->disabled(),

    //             Forms\Components\TextInput::make('display_name')
    //                 ->label('Display Name')
    //                 ->disabled(),

    //             Forms\Components\TextInput::make('user_login')
    //                 ->label('User Login')
    //                 ->disabled(),

    //             Forms\Components\TextInput::make('Last_Jobs')
    //                 ->label('Last Job')
    //                 ->disabled(),

    //             Forms\Components\TextInput::make('Last_Route')
    //                 ->label('Last Route')
    //                 ->disabled(),
    //         ]);
    // }
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistCard::make([
<<<<<<< HEAD
                    TextEntry::make('nik')
                        ->label('NIK'),
                    TextEntry::make('name'),
                    TextEntry::make('dept')
                ])
=======
                    TextEntry::make('Display_Name')
                        ->label('Name'),
                    TextEntry::make('user_login')
                        ->label('NIK'),
                    TextEntry::make('Departement'),
                    TextEntry::make('Last_Jobs'),
                    TextEntry::make('Last_Route'),
                    // TextEntry::make('created_at'),
                ])->columns(2),
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
<<<<<<< HEAD
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dept')
                    ->label('Department')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
=======
                Tables\Columns\TextColumn::make('ID')
                    ->label('ID')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('Display_Name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user_login')
                    ->label('NIK')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('Departement')
                    ->label('Department')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('related_count')
                        ->label('Comelate Count')
                        ->badge()
                        ->color('primary')
                        // ->sortable()
                        ->getStateUsing(function ($record) {
                            return ComelateEmployee::where('nik', $record->user_login)->count();
                        })
                    
                    

                // Tables\Columns\TextColumn::make('Last_Jobs')
                //     ->label('Last Job'),

                // Tables\Columns\TextColumn::make('Last_Route')
                //     ->label('Last Route'),
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
<<<<<<< HEAD
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
=======
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
                ]),
            ]);
    }

<<<<<<< HEAD
    public static function getRelations(): array
    {
        return [
            //
=======
    public static function query(): Builder
    {
        return parent::query()
            ->selectRaw('(SELECT COUNT(*) FROM comelate_employees WHERE comelate_employees.nik = users.user_login) as related_count');
    }


    public static function getRelations(): array
    {
        return [
            ComelateEmployeesRelationManager::class,
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
<<<<<<< HEAD
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
=======
            // 'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            // 'edit' => Pages\EditEmployee::route('/{record}/edit'),
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
        ];
    }
}
