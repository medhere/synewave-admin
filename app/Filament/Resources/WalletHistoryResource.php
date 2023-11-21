<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WalletHistoryResource\Pages;
use App\Models\Playlist;
use App\Models\User;
use App\Models\WalletHistory;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WalletHistoryResource extends Resource
{
    protected static ?string $model = WalletHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('credit_from_id')->label('Credit From User')
                    ->native(false)->options(User::where('role', 'user')->pluck('name', 'id'))->required()->live(),
                Select::make('credit_to_id')->label('Credit To Artist')
                    ->native(false)->options(User::where('role', 'artist')->pluck('name', 'id'))->required()->live(),
                Section::make()
                    ->columns([
                        'sm' => 1,
                        'xl' => 3,
                        '2xl' => 3,
                    ])
                    ->schema([
                        Select::make('playlist_id')->label('Playlist')
                            ->native(false)
                            ->hidden(fn (Get $get): bool => ! $get('credit_to_id'))
                            ->options(
                                function (Get $get) {
                                    $credit_to_id = $get('credit_to_id');
                                    return Playlist::where('user_id', $credit_to_id)->pluck('playlist_name', 'id');
                                }
                            )->live()
                            ->afterStateUpdated(function($state, Set $set){
                                    $playlist_id = $state;
                                    $playlist = Playlist::where('id', $playlist_id)->first();                                    
                                    if($playlist_id) $set('credits', $playlist->playlist_credits);
                                    else $set('credits', '0');
                            })
                            ->required(),
                        Toggle::make('enable_credits')
                            ->hidden(fn (Get $get): bool => ! $get('credit_from_id'))    
                            ->live()
                            ->inline(false),
                        TextInput::make('credits')
                            ->dehydrated()
                            ->disabled(fn (Get $get): bool => ! $get('enable_credits'))
                            ->hidden(fn (Get $get): bool => ! $get('credit_from_id'))
                            ->numeric(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('credit_from_id')->label('User'),
                TextColumn::make('credit_to_id')->label('Artist'),
                TextColumn::make('credits'),
                TextColumn::make('playlist_name')
                ->getStateUsing(function ($record) {
                    // return $record;
                })
                ->label('Playlist'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListWalletHistories::route('/'),
            'create' => Pages\CreateWalletHistory::route('/create'),
            'view' => Pages\ViewWalletHistory::route('/{record}'),
            'edit' => Pages\EditWalletHistory::route('/{record}/edit'),
        ];
    }
}
