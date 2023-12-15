<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\User;
use App\Models\UserPlaylist;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaylistsController extends Controller
{
    public function latestPlaylists()
    {
        $playlists = Playlist::latest()->limit(12)->get();
        return $playlists;
    }
    
    public function randomPlaylists($count = 20)
    {
        $playlists = Playlist::inRandomOrder()->limit($count)->get();
        return $playlists;
    }

    public function allPlaylists($count = 20)
    {
        $playlists = Playlist::inRandomOrder()->paginate($count);
        return $playlists;
    }

    public function searchPlaylists($count = 20)
    {
        $search = request('search');
        $playlists = Playlist::when($search !== "", function ($query) use ($search) {
            $query
                ->where('playlist_name', 'like', "%$search%");
        })
            ->paginate($count);
        return $playlists;
    }

    public function viewArtistPlaylist($user_id)
    {
        return Playlist::where('user_id', $user_id)->with('playlistsongs')->get();
    }

    public function viewPlaylist($id)
    {
        return Playlist::where('id', $id)->with('playlistsongs')->get();
    }

    public function getPlaylistSongs($id)
    {
        return PlaylistSong::where('playlist_id', $id)
        ->join('songs','playlist_songs.song_id','=','songs.id')
        ->get([
            'songs.*',
            'playlist_songs.*'
        ]);
    }

    public function viewUserPlaylists()
    {
        return UserPlaylist::where('user_id', auth()->user()->id)
            ->with('playlist')
            ->get();
    }

    public function selectPlaylist($id)
    {
        $playlist = Playlist::where('id', $id)->get();

        $user_wallet = auth()->user()->wallet;
        $user_id = auth()->user()->id;
        $artist_id = $playlist->user_id;
        $credits = $playlist->playlist_credits;
        $expiration = $playlist->playlist_expiration_in_days;

        $check_playlist = UserPlaylist::where(['user_id' => $user_id, 'playlist_id' => $playlist->id])
            ->whereDate('playlist_to_expire', '>', now()->toDate())
            ->get();

        if ($check_playlist) {
            return response('Playlist already purchased', 400);
        }

        if ($credits > $user_wallet) {
            return response('Insufficient Tokens', 400);
        }

        DB::beginTransaction();

        $buy_playlist = WalletHistory::create([
            'credit_from_id' => $user_id,
            'credit_to_id' => $artist_id,
            'credits' => $credits,
            'playlist_id' => $playlist->id
        ]);

        $user1 = User::find($user_id)->decrement('wallet', $credits);
        $user2 = User::find($artist_id)->increment('wallet', $credits);

        $add_to_user_playlists = UserPlaylist::updateOrCreate(
            ['user_id' => $user_id, 'playlist_id' => $playlist->id],
            ['playlist_to_expire' => now()->addDays($expiration)]
        );


        if (!$buy_playlist || !$user1 || !$user2 || !$add_to_user_playlists) {
            DB::rollBack();
        }else{
            DB::commit();    
            return response('Playlist added');
        }

        return response('Error adding playlist', 400);

    }
}
