<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlaylist extends Model
{
    use HasFactory;

    public function playlist(){
        $this->hasOne(Playlist::class);
    }

    public function user(){
        $this->hasOne(User::class);
    }
}
