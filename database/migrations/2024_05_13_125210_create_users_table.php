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
            $table->string('nama');
            $table->string('password');
            $table->string('nik')->nullable();
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->string('foto')->nullable();
            $table->enum('role',['superadmin','paslon','koordinator','saksi'])->nullable();
            $table->char('provinsi_id', 2)->index()->references('id')->on('provinsi');
            $table->char('kabupaten_id', 6)->index()->references('id')->on('kabupaten');
            $table->char('kecamatan_id', 6)->index()->references('id')->on('kecamatan');
            $table->char('kelurahan_id', 10)->index()->references('id')->on('kelurahan');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
