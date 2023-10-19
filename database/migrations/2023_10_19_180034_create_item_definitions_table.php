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
        Schema::create('item_definitions', function (Blueprint $table) {
            $table->id();
            $table->integer('item_code')->nullable();
            $table->integer('is_expiry')->nullable();
            $table->integer('generic_id')->nullable();
            $table->integer('item_type_id')->nullable();
            $table->integer('size_specification_id')->nullable();
            $table->integer('dosage_form_id')->nullable();
            $table->integer('dosage_route_id')->nullable();
            $table->integer('uom_id')->nullable();
            $table->integer('strength_id')->nullable();
            $table->string('pack_size')->nullable();
            $table->string('unit_pack_size')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_definitions');
    }
};
