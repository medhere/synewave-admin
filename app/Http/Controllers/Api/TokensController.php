<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TokenList;
use App\Models\TokenPurchase;
use App\Models\User;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TokensController extends Controller
{
    public function walletHistory()
    {
        return WalletHistory::where('credit_from_id', auth()->user()->id)
            ->leftjoin('users as artists', 'artists.id', '=', 'wallet_histories.credit_to_id')
            ->leftjoin('playlists', 'playlists.id', '=', 'wallet_histories.playlist_id')
            ->get([
                'artists.name', 'artists.nickname',
                'playlists.playlist_name',
                'wallet_histories.*',
            ]);
    }

    public function getTokens()
    {
        return TokenList::all();
    }

    public function buyToken($tx_ref)
    {
        $user_id = auth()->user()->id ? auth()->user()->id : request('user_id');
        $token_id = null;

        // Make a GET request to the Paystack endpoint
        $response = Http::withHeaders([
            'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
        ])->get('https://api.paystack.co/transaction/verify/' . $tx_ref)->json();

        // Process the response
        // $decoded_response = $response->json();

        // Check if the transaction was successful
        if ($response['status'] === true && $response['data']['status'] === 'success') {
            $token_id = $response['meta']['token_id'];
        } else {
            return response("Transaction failed or not successful.", 400);
        }

        $token = TokenList::find($token_id);
        if (!$token) return response("Contact admin with the following code: $tx_ref", 400);

        DB::beginTransaction();

        $purchase = TokenPurchase::create([
            'user_id' => $user_id,
            'token_name' => $token->token_name,
            'token_price' => $token->token_price,
            'credits' => $token->credits,
            'token_purchase_txref' => $tx_ref,
            'token_purchase_by' => $user_id
        ]);

        $user = User::find($user_id)->increment('wallet', $token->credits);

        if (!$purchase || !$user) {
            DB::rollBack();
        } else {
            DB::commit();
            return response('Purchase Completed');
        }

        return response("Contact admin with the following code: $tx_ref", 400);
    }

    public function buyTokenOnWeb($user_id, $token_id)
    {
        $token = TokenList::find($token_id);
        $user = User::where(['id' => $user_id, 'role' => 'user']);

        return view('token_purchase', compact('token', 'user'));
    }
}
