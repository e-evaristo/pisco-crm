<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\TransactionType;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\TransactionTypeResource\Pages;
use App\Filament\Resources\TransactionTypeResource\RelationManagers;

class TransactionTypeResource extends Resource
{
    protected static ?string $model = TransactionType::class;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationGroup = 'Transactions';

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    //protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')->required()
                            ]),
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListTransactionTypes::route('/'),
            'create' => Pages\CreateTransactionType::route('/create'),
            'edit' => Pages\EditTransactionType::route('/{record}/edit'),
        ];
    }
}
