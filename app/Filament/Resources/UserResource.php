<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\QuotesRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canAccess(): bool
    {
        return auth()->user()->isSuperAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(4)
            ->schema([
                Forms\Components\Section::make()
                    ->columns(2)
                    ->columnSpan([
                        'lg' => 3,
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->email()
                            ->suffixAction(
                                Action::make('copy')
                                    ->icon('heroicon-s-clipboard-document-check')
                                    ->action(function ($livewire, $state) {
                                        $livewire->js(
                                            'window.navigator.clipboard.writeText("'.$state.'");
                                            $tooltip("'.__('Copied to clipboard').'", { timeout: 1500 });'
                                        );
                                    })
                            ),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->visibleOn('create'),
                        Forms\Components\Select::make('role')
                            ->options([
                                User::ROLE_SUPER_ADMIN => 'Super Admin',
                                User::ROLE_ADMIN => 'Admin',
                            ])
                            ->required()
                            ->visible(fn () => auth()->user()->isSuperAdmin()),
                    ]),

                Forms\Components\Section::make()
                    ->hidden(fn (string $operation) => $operation === 'create')
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        Forms\Components\Placeholder::make('created')
                            ->content(fn (User $record): string => $record->created_at?->toFormattedDateString()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
            ])
            ->filters([
                //
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
            QuotesRelationManager::class,
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
