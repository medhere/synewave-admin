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
            ->select(['id', 'name', 'nickname'])
            ->where('role', 'artist')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('nickname', 'like', "%$search%");
            });

        $playlists = Playlist::inRandomOrder()
            ->where('playlist', 'like', "%$search%")
            ->with('playlistsongs')
            ->get();

        $songs = Song::inRandomOrder()
            ->where('playlist', 'like', "%$search%")
            ->with('user')
            ->get();

        return response(compact('artists','playlists','songs'),200);
    }
}
