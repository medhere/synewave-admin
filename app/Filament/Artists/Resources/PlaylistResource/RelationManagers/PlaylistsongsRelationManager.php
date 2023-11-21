<?php

namespace App\Filament\Artists\Resources\PlaylistResource\RelationManagers;

use App\Models\Song;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlaylistsongsRelationManager extends RelationManager
{
    protected static string $relationship = 'playlistsongs';
    protected static ?string $label = 'Playlist Song';
    protected static ?string $title = 'Playlist Songs';

    public function form(Form $form): Form
    {
        $record = $this->getOwnerRecord();

        return $form
            ->schema([
                Forms\Components\Select::make('song_id')
                ->label('Songs')
                ->native(false)
                    ->options(Song::where('user_id', $record->user_id)
                    ->pluck('song_title', 'id'))
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('playlist_id')
            ->columns([
                Tables\Columns\TextColumn::make('playlist.playlist_name'),
                Tables\Columns\TextColumn::make('song.song_title')->label('Song Title'),
                Tables\Columns\TextColumn::make('song.song_streams')->label('Song Streams'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->authorize(true)
                ->mutateFormDataUsing(function (array $data): array {
                    $data['playlist_id'] = $this->ownerRecord->id;
                    $data['user_id'] = $this->ownerRecord->user_id;
                
                    return $data;
                }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
