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
        Schema::create('pemilih_potensial', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->unique();
            $table->string('foto_ktp');
            $table->string('telephone')->nullable();
            $table->string('tps');
            $table->string('provinsi_id')->index()->references('id')->on('provinsi');
            $table->string('kabupaten_id')->index()->references('id')->on('kabupaten');
            $table->string('kecamatan_id')->index()->references('id')->on('kecamatan');
            $table->string('kelurahan_id')->index()->references('id')->on('kelurahan');
            $table->foreignId('koordinator_id')->constrained('koordinator');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemilih_potensial');
    }
};
