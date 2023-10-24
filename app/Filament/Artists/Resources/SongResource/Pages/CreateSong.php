<?php

namespace App\Filament\Artists\Resources\SongResource\Pages;

use App\Filament\Artists\Resources\SongResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSong extends CreateRecord
{
    protected static string $resource = SongResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        return $data;
    }
}
