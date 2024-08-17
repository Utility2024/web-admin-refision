<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\TicketResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\User;
use App\Models\CategoryTicket;
use Filament\Infolists\Components\Card as InfolistCard;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Ticketing';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('ticket_number')
                            ->disabled()
                            ->default(fn() => Ticket::generateTicketNumber())
                            ->required(),

                        Forms\Components\TextInput::make('title')
                            ->required(),
                        
                        Forms\Components\Textarea::make('description')
                            ->required(),
                        
                        Forms\Components\Select::make('status')
                            ->options([
                                'Open' => 'Open',
                                'In Progress' => 'In Progress',
                                'Closed' => 'Closed',
                            ])
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                if ($state === 'Closed') {
                                    $set('closed_at', now()); // Set otomatis closed_at
                                } else {
                                    $set('closed_at', null); // Reset jika bukan Closed
                                }
                            }),
                        
                        Forms\Components\Select::make('priority')
                            ->options([
                                'Low' => 'Low',
                                'Medium' => 'Medium',
                                'High' => 'High',
                            ])
                            ->required(),
                        
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required(),
                        
                        Forms\Components\Select::make('assigned_to')
                            ->relationship('assignedUser', 'name')
                            ->required(),
                    ])
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistCard::make([
                    TextEntry::make('ticket_number'),
                    TextEntry::make('title'),
                    TextEntry::make('description'),
                    TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Open' => 'danger',
                            'In Progress' => 'warning',
                            'Closed' => 'success',
                        }),
                    TextEntry::make('priority')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Low' => 'gray',
                            'Medium' => 'warning',
                            'Hight' => 'danger',
                        }),
                    TextEntry::make('category.name'),
                    TextEntry::make('assignedUser.name'),
                    TextEntry::make('closed_at')
                        ->label('Closed Date')
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ticket_number')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Open' => 'danger',
                        'In Progress' => 'warning',
                        'Closed' => 'success',
                    }),                    
                
                Tables\Columns\TextColumn::make('priority')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Low' => 'gray',
                        'Medium' => 'warning',
                        'Hight' => 'danger',
                    }),                
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('assignedUser.name')
                    ->sortable(),
                
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'view' => Pages\ViewTicket::route('/{record}'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
