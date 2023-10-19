<?php

namespace App\Filament\Resources\WalletHistoryResource\Pages;

use App\Filament\Resources\WalletHistoryResource;
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
