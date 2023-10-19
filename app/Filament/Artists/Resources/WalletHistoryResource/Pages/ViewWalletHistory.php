<?php

namespace App\Filament\Artists\Resources\WalletHistoryResource\Pages;

use App\Filament\Artists\Resources\WalletHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWalletHistory extends ViewRecord
{
    protected static string $resource = WalletHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
