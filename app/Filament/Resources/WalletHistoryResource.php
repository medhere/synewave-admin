<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WalletHistoryResource\Pages;
use App\Filament\Resources\WalletHistoryResource\RelationManagers;
use App\Models\Song;
use App\Models\User;
use App\Models\WalletHistory;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WalletHistoryResource extends Resource
{
    protected static ?string $model = WalletHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('credit_from_id')->label('Credit From User')
                    ->native(false)->options(User::where('role', 'user')->pluck('name', 'id'))->required(),
                Select::make('credit_to_id')->label('Credit To Artist')
                    ->native(false)->options(User::where('role', 'artist')->pluck('name', 'id'))->required(),
                TextInput::make('credits')->numeric(),
                Select::make('song_id')->label('Song')
                    ->native(false)->options(
                        function (Get $get) {
                            $credit_to_id = $get('credit_to_id');
                            return Song::where('user_id', $credit_to_id)->pluck('song_name', 'id');
                        }
                    )->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('credit_from_id'),
                TextColumn::make('credit_to_id'),
                TextColumn::make('credits'),
                TextColumn::make('song_id'),
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
