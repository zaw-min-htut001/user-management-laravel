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
            $table->string('username')->unique();
            $table->integer('role_id');
            $table->string('phone')->unique();
            $table->text('address');
            $table->boolean('is_active');
            $table->string('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username')->unique();
            $table->dropColumn('role_id');
            $table->dropColumn('phone')->unique();
            $table->dropColumn('address');
            $table->dropColumn('is_active');
            $table->dropColumn('gender');
        });
    }
};
