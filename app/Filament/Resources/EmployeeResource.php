<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Employee;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(100)->autofocus(),
                TextInput::make('email')->email()->required()->unique(ignorable: fn (?Employee $record): ?Employee => $record)->maxLength(250),
                DatePicker::make('birth_date')->required()->maxDate(now()->subYears(18))->displayFormat('d/m/Y'),
                TextInput::make('phone')->maxLength(100),
                BelongsToSelect::make('company_id')->relationship('company', 'name')->required(),
                TextInput::make('address')->maxLength(250),
                FileUpload::make('photo')->image()->directory('photos')->visibility('private'),
                Toggle::make('active')->default(true)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->size(40),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email'),
                TextColumn::make('phone'),
                BooleanColumn::make('active')->trueIcon('heroicon-o-badge-check')->falseIcon('heroicon-o-x-circle'),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
