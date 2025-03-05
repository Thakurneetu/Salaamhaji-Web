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
        Schema::create('cab_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('customer_id');
            $table->enum('tour_type', ['local','outstation'])->default('local');
            $table->string('hours')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();
            $table->string('cab_type')->nullable();
            $table->string('seats')->nullable();
            $table->string('luggage')->nullable();
            $table->string('pickup_location')->nullable();
            $table->string('instruction')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cab_orders');
    }
};
