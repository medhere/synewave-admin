<?php

namespace App\Filament\Artists\Resources\SongResource\Pages;

use App\Filament\Artists\Resources\SongResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSong extends ViewRecord
{
    protected static string $resource = SongResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
