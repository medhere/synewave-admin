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
        Schema::create('wallet_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('credit_from_id')->default(0)->constrained(table: 'users', indexName: 'id')->cascadeOnDelete();
            $table->integer('credit_to_id')->default(0)->constrained(table: 'users', indexName: 'id')->cascadeOnDelete();
            $table->float('credits')->default(0);
            $table->integer('playlist_id')->constrained('playlists')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_histories');
    }
};
