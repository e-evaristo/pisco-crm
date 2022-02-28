<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $slug = 'products';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationGroup = 'Transactions';
    //protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-lightning-bolt';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make()->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')
                        ->disabled()
                        ->required()
                        ->unique(Product::class, 'slug', fn ($record) => $record),
                    Forms\Components\TextInput::make('price')
                        ->numeric()
                        ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                        ->required(),
                    Forms\Components\TextInput::make('quantity')
                        ->label('Quantity')
                        ->numeric()
                        ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                        ->required(),
                    Forms\Components\Toggle::make('is_visible')
                        ->label('Visible')
                        ->helperText('This product will be displayed?')
                        ->default(true),
                    ])
                ]),

                Forms\Components\Group::make()->schema([
                    Card::make()->schema([
                        Forms\Components\BelongsToManyMultiSelect::make('categories')
                        ->relationship('categories', 'name')
                        ->required(), 
                    ])
                ])
        ]);

        /* Forms\Components\Group::make()->schema([
            Card::make()->schema([
                Forms\Components\BelongsToManyMultiSelect::make('categories')
                ->relationship('categories', 'name')
                ->required(), 
            ]),
        ])->columns(1), */
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('is_visible')
                    ->label('Visibility')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
