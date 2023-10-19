<?php

namespace App\Filament\Resources\TokenListResource\Pages;

use App\Filament\Resources\TokenListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTokenList extends EditRecord
{
    protected static string $resource = TokenListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
