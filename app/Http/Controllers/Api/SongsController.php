<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function getSongReaction($id){
        $likes = SongReaction::where(['song_id' => $id, 'reaction' => 1])->count();
        $dislikes = SongReaction::where(['song_id' => $id, 'reaction' => 0])->count();
        return [
            'likes' => $likes,
            'dislikes' => $dislikes
        ];
    }    

    public function postReaction($song_id, $reaction)
    {
        if (auth()->user()->role === 'user') {
            $reaction = SongReaction::updateOrCreate(
                ['user_id' => auth()->user()->id, 'song_id' => $song_id],
                ['reaction' => $reaction]
            );
            return response($reaction);
        }

        return response('Not User', 400);
    }
}
