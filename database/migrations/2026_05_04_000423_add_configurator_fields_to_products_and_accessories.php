<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::table("products", function (Blueprint $table) {
            $table->string("line")->nullable();
            $table->string("control_type", 50)->nullable();
            $table->string("opening_side", 20)->nullable();
            $table->decimal("max_gas_power", 8, 2)->nullable();
            $table->string("configurator_image")->nullable();
            $table->string("list_image")->nullable();
            $table->json("features")->nullable();
            $table->json("card_info")->nullable();
        });

        Schema::table("accessories", function (Blueprint $table) {
            $table->string("configurator_position", 20)->nullable();
            $table->string("configurator_image")->nullable();
            $table->string("list_image")->nullable();
            $table->string("list_image_alt")->nullable();
            $table->string("commercial_name")->nullable();
            $table->string("accessory_line")->nullable();
            $table->string("accessory_category")->nullable();
            $table->string("accessory_subcategory")->nullable();
            $table->json("labels")->nullable();
            $table->boolean("is_featured")->default(false);
            $table->boolean("prefooter")->default(false);
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::table("products", function (Blueprint $table) {
            $table->dropColumn([
                "line",
                "control_type",
                "opening_side",
                "configurator_image",
                "list_image",
                "features",
                "max_gas_power",
                "card_info",
            ]);
        });

        Schema::table("accessories", function (Blueprint $table) {
            $table->dropColumn([
                "configurator_position",
                "configurator_image",
                "list_image",
                "list_image_alt",
                "commercial_name",
                "accessory_line",
                "accessory_category",
                "accessory_subcategory",
                "labels",
                "is_featured",
                "prefooter",
            ]);
        });

        Schema::enableForeignKeyConstraints();
    }
};
