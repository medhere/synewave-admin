<?php

namespace App\Filament\Artists\Resources;

use App\Filament\Artists\Resources\WalletHistoryResource\Pages;
use App\Filament\Artists\Resources\WalletHistoryResource\RelationManagers;
use App\Models\WalletHistory;
use Filament\Forms;
use Filament\Forms\Form;
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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('credit_from_id')->label('User'),
                TextColumn::make('credit_to_id')->label('Artist'),
                TextColumn::make('credits'),
                TextColumn::make('playlist_name')->label('Playlist'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            // 'view' => Pages\ViewWalletHistory::route('/{record}'),
        ];
    }    
}
