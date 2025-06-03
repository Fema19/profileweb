<?php

// database/migrations/xxxx_xx_xx_create_description_translations_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('description_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('description_id')->constrained()->onDelete('cascade');
            $table->string('locale'); // 'id', 'en', 'de'
            $table->text('content');
            $table->timestamps();

            $table->unique(['description_id', 'locale']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('description_translations');
    }
};
