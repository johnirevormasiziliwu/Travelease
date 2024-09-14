<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\FontWeight;
use Filament\Notifications\Notification;
use Filament\Widgets\TableWidget as BaseWidget;

class PedingTransaction extends BaseWidget
{
    protected static ?int $sort = 3;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Transaction::query()->wherePaymentStatus('pending'),
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->weight(FontWeight::Bold),
                Tables\Columns\TextColumn::make('holidayPackage.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('USD')
                    ->sortable()
                    ->weight(FontWeight::Bold),
                Tables\Columns\TextColumn::make('payment_status')->badge()->color(fn(string $state): string => match ($state) {
                    'pending' => 'gray',
                    'paid' => 'info',
                    'failed' => 'danger',
                }),

            ])->actions([
                Action::make('approve')
                    ->button()
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Transaction $transaction) {
                        Transaction::find($transaction->id)->update([
                            'status' => 'approved',
                        ]);
                        Notification::make()->success()->title('Transaction Approved!')
                            ->body('Transaction has been approved successfully')->icon('heroicon-o-check-circle')->send();
                    })
                    ->hidden(fn(Transaction $transaction) => $transaction->status !== 'waiting')
            ]);
    }
}
