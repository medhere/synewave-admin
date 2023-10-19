<?php

namespace App\Filament\Resources\TokenPurchaseResource\Pages;

use App\Filament\Resources\TokenPurchaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTokenPurchase extends ViewRecord
{
    protected static string $resource = TokenPurchaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
