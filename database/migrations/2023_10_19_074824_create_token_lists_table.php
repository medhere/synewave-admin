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
        Schema::create('token_lists', function (Blueprint $table) {
            $table->id();
            $table->string('token_name');
            $table->string('token_desc')->nullable();
            $table->float('token_price')->default(0);
            $table->string('token_expiry')->nullable();
            $table->integer('credits')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_lists');
    }
};
