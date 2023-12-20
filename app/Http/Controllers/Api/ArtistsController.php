<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    private function artists()
    {
        return User::select(['id', 'name', 'nickname', 'avatar'])->where('role', 'artist');
    }

    public function randomArtists($count = 20)
    {
        $artists = $this->artists()
        ->inRandomOrder()
        ->limit($count)
        ->get();
        return $artists;
    }

    public function latestArtists()
    {
        $artists = $this->artists()->latest()->paginate(12);
        return $artists;
    }

    public function allArtists($count = 20)
    {
        $artists = $this->artists()->inRandomOrder()->paginate($count);
        return $artists;
    }

    public function searchArtists($count = 20)
    {
        $search = request('search');
        $artists = $this->artists()
            ->when($search !== "", function ($query) use ($search) {
                $query
                    ->where('name', 'like', "%$search%")
                    ->orWhere('nickname', 'like', "%$search%");
            })
            ->paginate($count);
        return $artists;
    }

    public function viewArtist($id)
    {
        return $this->artists()->where('id', $id)->get();
    }
}
