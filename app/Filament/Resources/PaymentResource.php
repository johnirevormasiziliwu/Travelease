<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    public static function canCreate(): bool
    {
        return false;
    }
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('transaction_id')
                    ->relationship('transaction', 'id')
                    ->required(),
                Forms\Components\DateTimePicker::make('payment_date')
                    ->required(),
                Forms\Components\TextInput::make('payment_method')
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('payment_status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction.user.name')
                    ->label('Transaction')
                    ->weight(FontWeight::Bold )
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\TextColumn::make('amount')
                    ->money('USD')
                    ->weight(FontWeight::Bold)
                    ->sortable(),
                    Tables\Columns\TextColumn::make('payment_status')->badge()->color(fn(string $state): string => match($state) {
                        'pending' => 'gray',
                        'completed' => 'success',
                        'failed' => 'danger',
                    }),
                
            ])
            ->filters([
               SelectFilter::make('payment_status')
               ->options([
                'pending' => 'Pending',
                'completed' => 'Completed',
                'failed' => 'Failed',
               ])
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
