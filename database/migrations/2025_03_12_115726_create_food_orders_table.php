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
        Schema::create('food_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('order_id');
            $table->string('package')->nullable();
            $table->enum('meal', ['All','Combo','Single'])->default('All');
            $table->enum('meal_type', ['breakfast','lunch','dinner','breakfast-lunch','breakfast-dinner','lunch-dinner'])->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 8, 2)->default('0.00');
            $table->decimal('total', 8, 2)->default('0.00');
            $table->time('breakfast_start')->nullable();
            $table->time('breakfast_end')->nullable();
            $table->time('lunch_start')->nullable();
            $table->time('lunch_end')->nullable();
            $table->time('dinner_start')->nullable();
            $table->time('dinner_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_orders');
    }
};
