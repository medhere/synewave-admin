<?php

namespace App\Filament\Artists\Resources\WalletHistoryResource\Pages;

use App\Filament\Artists\Resources\WalletHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWalletHistory extends EditRecord
{
    protected static string $resource = WalletHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
