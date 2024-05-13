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
            $table->string('foto_ktp');
            $table->string('tps');
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
