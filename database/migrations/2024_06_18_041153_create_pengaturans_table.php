<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paslon_id')->unique()->constrained('paslon')->onDelete('cascade');
            $table->integer('target_suara');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
