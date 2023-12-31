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
        Schema::create('token_purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('token_name')->nullable();
            $table->float('token_price')->default(0);
            $table->integer('credits')->default(0);
            // $table->string('token_to_expire')->nullable();
            $table->string('token_purchase_txref');
            $table->integer('token_purchase_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_purchases');
    }
};
