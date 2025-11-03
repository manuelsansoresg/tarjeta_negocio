<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_profile_id')->constrained()->onDelete('cascade');
            $table->string('platform'); // e.g. whatsapp, facebook, instagram
            $table->string('url');
            $table->string('icon_class')->nullable(); // e.g. bi bi-whatsapp
            $table->string('button_color')->nullable();
            $table->boolean('enabled')->default(true);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_links');
    }
};