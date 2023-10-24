<?php

namespace App\Filament\Resources\TokenPurchaseResource\Pages;

use App\Filament\Resources\TokenPurchaseResource;
use App\Models\TokenList;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateTokenPurchase extends CreateRecord
{
    protected static string $resource = TokenPurchaseResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $user_id = $data['user_id'];
        $token_list_id = $data['token_list_id'];

        $token = TokenList::find($token_list_id);

        $data['token_name'] = $token->token_name;
        $data['token_price'] = $token->token_price;
        $data['credits'] = $token->credits;
        // $data['token_to_expire'] = $token->token_expiry ? now()->addDays($token->token_expiry) : null;
        $data['token_purchase_by'] = auth()->user()->id;
        $data['token_purchase_txref'] = 'admin';

        unset($data['token_list_id']);

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {        
        DB::beginTransaction();

        $record =  static::getModel()::create($data);

        $credits = $data['credits'];
        $user_id = $data['user_id'];

        $user = User::find($user_id)->increment('wallet', $credits);

        if(!$record || !$user) DB::rollBack();

        DB::commit();

        return $record;
    }

}
