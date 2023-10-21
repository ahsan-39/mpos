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
        Schema::create('item_unit_of_measures', function (Blueprint $table) {
            $table->id();
            $table->integer('uom_code')->nullable();
            $table->string('uom_name')->nullable();
            $table->integer('category_group_id')->nullable();
            $table->integer('child_uom_id')->nullable();
            $table->string('child_uom_value')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_unit_of_measures');
    }
};
