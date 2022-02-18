<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                
                Forms\Components\TextInput::make('email')->email()->required()->unique(),
                
                Forms\Components\TextInput::make('password')->password()->required()->disableAutocomplete()
                    ->visible(fn (\Livewire\Component $livewire): bool => $livewire instanceof Pages\CreateUser),
                
                    Forms\Components\TextInput::make('password_confirmation')->password()->required()->disableAutocomplete()
                    ->same('password')->visible(fn (\Livewire\Component $livewire): bool => $livewire instanceof Pages\CreateUser),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email'),
                TextColumn::make('companies_count')->counts('companies')->label('Companies')
            ])
            ->filters([
                Tables\Filters\Filter::make('verified')->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
