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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->enum('role', ['admin', 'user', 'artist']);
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('nickname')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('dob')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password_reset')->nullable();
            $table->string('password');
            $table->float('wallet')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
