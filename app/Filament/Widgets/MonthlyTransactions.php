<?php

namespace App\Filament\Widgets;

use Flowframe\Trend\Trend;
use App\Models\Transaction;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class MonthlyTransactions extends ChartWidget
{
    protected static ?int $sort = 2; 
    protected static ?string $heading = 'Monthly Transaction';

    protected function getData(): array
    {
        $data = Trend::model(Transaction::class)
        ->between(
            start: now()->startOfMonth(),
            end: now()->endOfYear()
        )
        ->perDay()->count();
        return [
           'datasets' => [
                [
                    'label' => 'Transactions created',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date) ,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getDescription(): ?string
    {
        return 'The number of transactions created per mont.';
    }
}
