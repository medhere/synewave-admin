<?php

namespace App\Filament\Artists\Resources\PlaylistResource\Pages;

use App\Filament\Artists\Resources\PlaylistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlaylist extends EditRecord
{
    protected static string $resource = PlaylistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
