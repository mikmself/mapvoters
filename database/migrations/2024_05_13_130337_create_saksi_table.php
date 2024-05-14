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
        Schema::create('saksi', function (Blueprint $table) {
            $table->id();
            $table->string('tps');
            $table->integer('jumlah_suara')->nullable();
            $table->string('foto_kertas_suara')->nullable();
            $table->string('provinsi_id')->index()->references('id')->on('provinsi');
            $table->string('kabupaten_id')->index()->references('id')->on('kabupaten');
            $table->string('kecamatan_id')->index()->references('id')->on('kecamatan');
            $table->string('kelurahan_id')->index()->references('id')->on('kelurahan');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('koordinator_id')->constrained('koordinator');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saksi');
    }
};
