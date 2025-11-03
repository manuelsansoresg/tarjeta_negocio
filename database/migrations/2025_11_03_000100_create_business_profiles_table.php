<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('primary_color')->default('#c62828');
            $table->string('secondary_color')->default('#0d6efd');
            $table->string('accent_color')->default('#28a745');
            $table->string('background_color')->default('#0b0e16');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_profiles');
    }
};