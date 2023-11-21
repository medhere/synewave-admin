<?php

namespace App\Filament\Resources\WalletHistoryResource\Pages;

use App\Filament\Resources\WalletHistoryResource;
use App\Models\Playlist;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateWalletHistory extends CreateRecord
{
    protected static string $resource = WalletHistoryResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $user_id = $data['credit_from_id'];
        $playlist_id = $data['playlist_id'];
            $playlist = Playlist::where('id', $playlist_id)->first();
        if(!isset($data['credits'])) $data['credits'] = $playlist->playlist_credits;
        
        $credit = $data['credits'];
        unset($data['enable_credits']);

        $user = User::find($user_id);
        if($user['wallet'] < $credit) return Notification::make()->warning()
        ->title('Wallet Transaction')->body('Wallet to low!');

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {        
        DB::beginTransaction();
        
        $record =  static::getModel()::create($data);

        $credits = $data['credits'];
        $user_id = $data['credit_from_id'];
        $artist_id = $data['credit_to_id'];

        $user1 = User::find($user_id)->decrement('wallet', $credits);
        $user2 = User::find($artist_id)->increment('wallet', $credits);

        if(!$record || !$user1 || !$user2) DB::rollBack();

        DB::commit();

        return $record;
    }
}
