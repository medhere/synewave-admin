<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SongResource\Pages;
use App\Filament\Resources\SongResource\RelationManagers;
use App\Models\Song;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SongResource extends Resource
{
    protected static ?string $model = Song::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('song_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('song_desc')
                    ->maxLength(255),
                Forms\Components\TextInput::make('song_feat')
                    ->maxLength(255),
                Forms\Components\TextInput::make('song_album')
                    ->maxLength(255),
                Forms\Components\TextInput::make('song_track_no')
                    ->maxLength(255),
                Forms\Components\TextInput::make('song_plays')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('song_stored')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('song_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('song_desc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('song_feat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('song_album')
                    ->searchable(),
                Tables\Columns\TextColumn::make('song_track_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('song_plays')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('song_stored')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListSongs::route('/'),
            'create' => Pages\CreateSong::route('/create'),
            'view' => Pages\ViewSong::route('/{record}'),
            'edit' => Pages\EditSong::route('/{record}/edit'),
        ];
    }    
}
