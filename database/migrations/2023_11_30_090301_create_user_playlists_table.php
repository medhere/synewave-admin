<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_playlists', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('playlist_id')->constrained('playlists')->cascadeOnDelete();
            $table->date('playlist_to_expire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_playlists');
    }
};
