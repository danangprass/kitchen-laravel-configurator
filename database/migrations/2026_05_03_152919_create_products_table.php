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
        Schema::disableForeignKeyConstraints();

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->string('sku', 100)->unique();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('type', 100)->nullable();
            $table->string('panel', 100)->nullable();
            $table->string('power_supply', 100)->nullable();
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('depth', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->integer('number_of_trays')->nullable();
            $table->string('tray_size', 50)->nullable();
            $table->integer('distance_between_trays')->nullable();
            $table->string('voltage', 100)->nullable();
            $table->decimal('electric_power', 8, 2)->nullable();
            $table->string('frequency', 50)->nullable();
            $table->decimal('consumption_kwh', 8, 2)->nullable();
            $table->decimal('co2_emission', 8, 2)->nullable();
            $table->boolean('energy_star_certified')->default(0);
            $table->decimal('price', 12, 2)->nullable();
            $table->boolean('is_active')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
