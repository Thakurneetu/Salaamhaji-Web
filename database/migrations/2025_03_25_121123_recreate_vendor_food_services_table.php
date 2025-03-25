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
      Schema::dropIfExists('vendor_food_services');

      Schema::create('vendor_food_services', function (Blueprint $table) {
        $table->id();
        $table->integer('vendor_id');
        $table->string('package');
        $table->time('breakfast_start')->nullable();
        $table->time('breakfast_end')->nullable();
        $table->time('lunch_start')->nullable();
        $table->time('lunch_end')->nullable();
        $table->time('dinner_start')->nullable();
        $table->time('dinner_end')->nullable();
        $table->decimal('all_price', 8, 2)->default('0.00');
        $table->decimal('combo_price', 8, 2)->default('0.00');
        $table->decimal('single_price', 8, 2)->default('0.00');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
