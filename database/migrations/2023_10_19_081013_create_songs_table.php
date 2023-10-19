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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('song_name');
            $table->string('song_desc')->nullable();
            $table->string('song_feat')->nullable();
            $table->string('song_album')->nullable();
            $table->string('song_track_no')->nullable();
            $table->integer('song_plays')->default(0);
            $table->string('song_stored');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
