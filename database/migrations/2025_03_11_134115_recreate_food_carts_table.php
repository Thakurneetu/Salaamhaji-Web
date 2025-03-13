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
      // Drop the table if it exists
      Schema::dropIfExists('food_carts');

      Schema::create('food_carts', function (Blueprint $table) {
        $table->id();
        $table->integer('customer_id');
        $table->integer('package_id');
        $table->enum('meal', ['All','Combo','Single'])->default('All');
        $table->enum('meal_type', ['breakfast','lunch','dinner','breakfast-lunch','breakfast-dinner','lunch-dinner'])->nullable();
        $table->date('from')->nullable();
        $table->date('to')->nullable();
        $table->integer('quantity')->default(1);
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('food_carts');
    }
};
