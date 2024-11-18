<?php

namespace App\Filament\Resources\QuoteResource\Widgets;

use App\Filament\Resources\QuoteResource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentlyAddedQuotes extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        $query = QuoteResource::getEloquentQuery()
            ->whereNull('deleted_at')
            ->orderByDesc('created_at');
        return $table
            ->query($query)
            ->paginated([10, 25, 50])
            ->defaultPaginationPageOption(10)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\Layout\Stack::make([
                        TextColumn::make('author')->weight(FontWeight::Bold),
                        TextColumn::make('quote')
                            ->grow(false)
                            ->label('Zone')
                            ->color('gray'),
                        TextColumn::make('created_at'),
                    ]),
                ]),
            ])
            ->actions([
                Tables\Actions\Action::make('Go to quote')
                    ->url(fn ($record) => QuoteResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
