<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use App\Models\Transaction;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\MultiSelectFilter;
use App\Filament\Resources\TransactionResource\Pages;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Transactions';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form->schema([
            
            Card::make()->schema([
                Forms\Components\TextInput::make('number')->default('NR-' . random_int(100000, 999999))->disabled()->required(),
                Forms\Components\DatePicker::make('date_transaction')->default(now())->required(),
                Forms\Components\BelongsToSelect::make('transaction_type_id')
                    ->relationship('transaction_type', 'name')
                    ->required(), 
                Forms\Components\Select::make('status')
                    ->options([
                        'nova' => 'Nova',
                        'em processamento' => 'Em Processamento',
                        'enviado' => 'Enviado',
                        'entregue' => 'Entregue',
                        'cancelada' => 'Cancelada',
                    ])->required(),
                Forms\Components\BelongsToSelect::make('employee_id')->relationship('employee', 'name')->searchable()
                ->columnSpan(['sm' => 2]),
            ])->columns(['sm' => 3,]),
            
            
            Card::make()->schema([
                Forms\Components\Placeholder::make('Transaction Items'),
                Forms\Components\HasManyRepeater::make('items')->relationship('items')->schema([
                    
                    Forms\Components\Select::make('product_id')->label('Product')
                        ->options(Product::query()->where('is_visible',true)->pluck('name', 'id'))->required()->reactive()
                        ->afterStateUpdated( function ($state, callable $set) {
                            $set('value', Product::find($state)->price ?? 0);
                            $set('quantity', 1);
                        }),
                    Forms\Components\TextInput::make('value')->disabled()->numeric()->required(),
                    Forms\Components\TextInput::make('quantity')->numeric()->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])->required(),
                ])
                ->required()
                ->dehydrated()
                ->defaultItems(1)
                ->disableLabel()
                ->columns(['sm' => 3]),
            ]),
            
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('date_transaction')->label('Transaction Date')->date()->sortable(),
                Tables\Columns\TextColumn::make('employee.name')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'secondary',
                        'danger' => 'cancelada',
                        'warning' => 'em processamento',
                        'success' => 'entregue',
                    ]),
                Tables\Columns\TextColumn::make('total')->searchable()->sortable(),
            ])
            ->filters([
                Filter::make('date_transaction')->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->placeholder(fn ($state): string => now()->subMonth()->format('d/m/Y')),
                        Forms\Components\DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('d/m/Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date_transaction', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date_transaction', '<=', $date),
                            );
                    }),
                    MultiSelectFilter::make('status')
                        ->options([
                            'nova' => 'Nova',
                            'em processamento' => 'Em Processamento',
                            'enviado' => 'Enviado',
                            'entregue' => 'Entregue',
                            'cancelada' => 'Cancelada',
                        ])
                        ->column('status')
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
