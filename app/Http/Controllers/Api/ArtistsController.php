<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    private function artists()
    {
        return User::where('role', 'artists')->select(['id', 'name', 'nickname']);
    }

    public function randomArtsists($count = 20)
    {
        $artists = $this->artists()->inRandomOrder()->limit($count)->get();
        return $artists;
    }

    public function allArtsists($count = 20)
    {
        $artists = $this->artists()->paginate($count)->inRandomOrder();
        return $artists;
    }

    public function searchArtsists($search = "", $count = 20)
    {
        $artists = $this->artists()
            ->when($search !== "", function ($query) use ($search) {
                $query
                    ->where('name', 'like', "%$search%")
                    ->orWhere('nickname', 'like', "%$search%");
            })
            ->paginate($count);
        return $artists;
    }

    public function viewArtsist($id)
    {
        return $this->artists()->where('id', $id)->get();
    }
}
