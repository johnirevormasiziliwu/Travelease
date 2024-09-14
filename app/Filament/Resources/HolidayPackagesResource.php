<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HolidayPackagesResource\Pages;
use App\Filament\Resources\HolidayPackagesResource\RelationManagers;
use App\Models\Categories;
use App\Models\HolidayPackages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HolidayPackagesResource extends Resource
{
    protected static ?string $model = HolidayPackages::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->prefix('$'),
                Forms\Components\TextInput::make('duration_days')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('available_from')
                    ->required(),
                Forms\Components\DatePicker::make('available_until')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->weight(FontWeight::Bold)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->weight(FontWeight::Bold)
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_days')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('available_from')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('available_until')
                    ->date()
                    ->sortable(),
               
            ])
            ->filters([
                SelectFilter::make('category_id')
                ->label('Categories')
                ->options(Categories::all()->pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListHolidayPackages::route('/'),
            'create' => Pages\CreateHolidayPackages::route('/create'),
            'edit' => Pages\EditHolidayPackages::route('/{record}/edit'),
        ];
    }
}
