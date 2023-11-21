<?php

namespace App\Filament\Artists\Resources\PlaylistResource\Pages;

use App\Filament\Artists\Resources\PlaylistResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPlaylist extends ViewRecord
{
    protected static string $resource = PlaylistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
