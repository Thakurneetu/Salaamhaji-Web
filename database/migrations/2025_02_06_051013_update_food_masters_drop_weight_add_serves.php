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
        Schema::table('food_masters', function (Blueprint $table) {
          $table->dropColumn('weight');
          $table->integer('serves')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food_masters', function (Blueprint $table) {
          $table->integer('weight')->default(0);
          $table->dropColumn('serves');
        });
    }
};
