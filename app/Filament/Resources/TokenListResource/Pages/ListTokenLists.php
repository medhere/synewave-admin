<?php

namespace App\Filament\Resources\TokenListResource\Pages;

use App\Filament\Resources\TokenListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTokenLists extends ListRecords
{
    protected static string $resource = TokenListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
