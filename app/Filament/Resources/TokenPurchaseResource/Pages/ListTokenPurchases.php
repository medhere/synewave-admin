<?php

namespace App\Filament\Resources\TokenPurchaseResource\Pages;

use App\Filament\Resources\TokenPurchaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTokenPurchases extends ListRecords
{
    protected static string $resource = TokenPurchaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
