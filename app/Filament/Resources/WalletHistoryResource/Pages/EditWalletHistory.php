<?php

namespace App\Filament\Resources\WalletHistoryResource\Pages;

use App\Filament\Resources\WalletHistoryResource;
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
