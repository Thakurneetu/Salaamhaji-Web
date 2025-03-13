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
        Schema::dropIfExists('food_order_items');

        Schema::create('food_order_items', function (Blueprint $table) {
          $table->id();
          $table->integer('food_order_id');
          $table->date('date')->nullable();
          $table->string('day')->nullable();
          $table->string('meal')->nullable();
          $table->text('meal_items')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('food_order_items');
    }
};
