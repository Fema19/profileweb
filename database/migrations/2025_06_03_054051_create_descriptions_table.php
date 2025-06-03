<?php

// database/migrations/xxxx_xx_xx_create_descriptions_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // contoh: about-me
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('descriptions');
    }
};


