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
        Schema::table('accessories', function (Blueprint $table) {
            $table->text('list_image_alt')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->text('short_description')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('accessories', function (Blueprint $table) {
            $table->string('list_image_alt')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->string('short_description')->nullable()->change();
        });
    }
};
