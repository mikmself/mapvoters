<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        \Illuminate\Support\Facades\DB::unprepared(file_get_contents(public_path("insert_kabupaten.sql")));
    }

    public function down(): void
    {
        Schema::dropIfExists('kabupaten');
    }
};
