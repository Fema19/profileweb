<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('profile_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onDelete('cascade');
            $table->string('locale');  // id, en, de
            $table->text('bio');       // bio yang diterjemahkan
            $table->timestamps();

            $table->unique(['profile_id', 'locale']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('profile_translations');
    }
};

