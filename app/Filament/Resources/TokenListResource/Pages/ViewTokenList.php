<?php

namespace App\Filament\Resources\TokenListResource\Pages;

use App\Filament\Resources\TokenListResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTokenList extends ViewRecord
{
    protected static string $resource = TokenListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
