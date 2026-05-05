<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_sections', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->json('content')->nullable();
            $table->string('background_type')->default('none');
            $table->string('background_data')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_url')->nullable();
            $table->json('product_ids')->nullable();
            $table->string('line_family')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_sections');
    }
};
