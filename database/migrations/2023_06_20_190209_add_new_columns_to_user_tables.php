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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->after('name')->nullable();
            $table->string('username')->after('email')->nullable();
            $table->integer('role_id')->after('username')->nullable()->index();
            $table->boolean('is_active')->after('role_id')->nullable()->default(true)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone','username','role_id','is_active']);
        });
    }
};
