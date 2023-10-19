<?php

namespace App\Filament\Resources\TokenPurchaseResource\Pages;

use App\Filament\Resources\TokenPurchaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTokenPurchase extends EditRecord
{
    protected static string $resource = TokenPurchaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
