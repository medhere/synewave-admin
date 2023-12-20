<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\SongReaction;
use Illuminate\Http\Request;

class SongsController extends Controller
{
    public function getSong($id)
    {
        $song = Song::find($id)->with('user');
        //FIXME: should song be transcoded here and streamed?
    }

    public function getSongReactions($id)
    {
        $likes = SongReaction::where(['song_id' => $id, 'reaction' => 1])->count();
        $dislikes = SongReaction::where(['song_id' => $id, 'reaction' => 0])->count();
        return [
            'likes' => $likes,
            'dislikes' => $dislikes
        ];
    }

    public function postSongReaction($id, $reaction)
    {
        if (auth()->user()->role === 'user') {
            $reaction = SongReaction::updateOrCreate(
                ['user_id' => auth()->user()->id, 'song_id' => $id],
                ['reaction' => $reaction]
            );
            return response($reaction);
        }

        return response('Not User', 400);
    }

    public function get_latest_songs($user_id = null, $count = 15)
    {
        $songs = Song::latest()
            ->when($user_id !== null, function ($query) use ($user_id) {
                $query->where('id', $user_id);
            })
            ->limit($count)
            ->with('user')
            ->get();
        return $songs;
    }

    public function get_playlists_from_song($song_id)
    {
        $playlists = Playlist::inRandomOrder()->where('song_id', $song_id)->get();
        return $playlists;
    }
}
