<?php

namespace App\Filament\Resources\SongReactionResource\Pages;

use App\Filament\Resources\SongReactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSongReaction extends EditRecord
{
    protected static string $resource = SongReactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
