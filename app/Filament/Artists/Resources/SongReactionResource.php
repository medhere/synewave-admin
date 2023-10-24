<?php

namespace App\Filament\Artists\Resources;

use App\Filament\Artists\Resources\SongReactionResource\Pages;
use App\Filament\Artists\Resources\SongReactionResource\RelationManagers;
use App\Models\SongReaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SongReactionResource extends Resource
{
    protected static ?string $model = SongReaction::class;

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
                TextColumn::make('user.name')->label('Artist'),
                TextColumn::make('song.song_title')->label('Song'),
                TextColumn::make('reaction'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListSongReactions::route('/'),
            // 'create' => Pages\CreateSongReaction::route('/create'),
            // 'edit' => Pages\EditSongReaction::route('/{record}/edit'),
        ];
    }    
}
