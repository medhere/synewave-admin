<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        $search = request('search');

        $artists = User::inRandomOrder()
            ->select(['id', 'name', 'nickname', 'avatar'])
            ->where('role', 'artist')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('nickname', 'like', "%$search%");
            })->get();

        $playlists = Playlist::inRandomOrder()
            ->where('playlist_name', 'like', "%$search%")
            ->with('playlistsongs')
            ->get();

        $songs = Song::inRandomOrder()
            ->where('song_title', 'like', "%$search%")
            ->with('user')
            ->get();

        return response(compact('artists','playlists','songs'),200);
    }
}
