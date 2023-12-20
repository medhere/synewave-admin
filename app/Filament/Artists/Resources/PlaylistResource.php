<?php

namespace App\Filament\Artists\Resources;

use App\Filament\Artists\Resources\PlaylistResource\Pages;
use App\Filament\Artists\Resources\PlaylistResource\RelationManagers;
use App\Filament\Artists\Resources\PlaylistResource\RelationManagers\PlaylistsongsRelationManager;
use App\Models\Playlist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlaylistResource extends Resource
{
    protected static ?string $model = Playlist::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('playlist_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('playlist_credits')
                    ->required()
                    ->numeric()
                    ->default(0.50),
                Forms\Components\FileUpload::make('playlist_art')
                    ->required()
                    // ->openable()
                    ->disk('playlist')
                    ->image()
                    ->hiddenOn('edit')
                    ->imageEditor(),
                Forms\Components\Select::make('playlist_genre')
                    ->label('Artist')
                    ->native(false)
                    ->options([
                        'Pop',
                        'Hip-hop'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('playlist_expiration_in_days')
                    ->required()
                    ->numeric()
                    ->default(30),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('playlist_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('playlist_streams')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('playlist_credits')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('playlist_expiration_in_days')
                    ->dateTime(),
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
            PlaylistsongsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlaylists::route('/'),
            'create' => Pages\CreatePlaylist::route('/create'),
            'view' => Pages\ViewPlaylist::route('/{record}'),
            'edit' => Pages\EditPlaylist::route('/{record}/edit'),
        ];
    }
}
