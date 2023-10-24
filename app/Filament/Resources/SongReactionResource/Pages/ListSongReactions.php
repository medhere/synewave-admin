<?php

namespace App\Filament\Resources\SongReactionResource\Pages;

use App\Filament\Resources\SongReactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSongReactions extends ListRecords
{
    protected static string $resource = SongReactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
