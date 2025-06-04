<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();  // identifier unik untuk profile, bisa slug atau bio (pilih salah satu)
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('profiles');
    }
};

