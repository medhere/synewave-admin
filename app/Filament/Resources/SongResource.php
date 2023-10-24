<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SongResource\Pages;
use App\Filament\Resources\SongResource\RelationManagers;
use App\Models\Song;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
                Select::make('user_id')
                    ->label('Artist')
                    ->native(false)
                    ->options(User::where('role', 'artist')
                    ->pluck('name', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('song_title')
                    ->autocapitalize('words')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('song_desc')
                    ->maxLength(255),
                Forms\Components\TextInput::make('song_feat')
                    ->maxLength(255),
                Forms\Components\TextInput::make('song_album')
                    ->maxLength(255),
                Forms\Components\TextInput::make('song_track_no')
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('song_streams')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('song_credits')
                    ->required()
                    ->numeric()
                    ->default(0.50),
                FileUpload::make('song_art')
                    ->required()
                    ->openable()
                    ->disk('art')
                    ->image()
                    ->imageEditor(),
                FileUpload::make('song_stored')->label('Upload Song')
                    ->required()
                    ->openable()
                    ->disk('songs'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Artist')
                    ->sortable(),
                Tables\Columns\TextColumn::make('song_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('song_desc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('song_feat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('song_album')
                    ->searchable(),
                Tables\Columns\TextColumn::make('song_streams')
                    ->numeric()
                    ->sortable(),
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
