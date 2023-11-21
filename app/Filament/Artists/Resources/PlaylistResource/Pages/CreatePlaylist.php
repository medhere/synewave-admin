<?php

namespace App\Filament\Artists\Resources\PlaylistResource\Pages;

use App\Filament\Artists\Resources\PlaylistResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlaylist extends CreateRecord
{
    protected static string $resource = PlaylistResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        return $data;
    }
}
