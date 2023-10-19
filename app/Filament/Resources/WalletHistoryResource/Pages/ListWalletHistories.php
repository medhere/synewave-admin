<?php

namespace App\Filament\Resources\WalletHistoryResource\Pages;

use App\Filament\Resources\WalletHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWalletHistories extends ListRecords
{
    protected static string $resource = WalletHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
