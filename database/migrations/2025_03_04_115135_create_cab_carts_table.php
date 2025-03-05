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
        Schema::create('cab_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->enum('tour_type', ['local','outstation'])->default('local');
            $table->date('service_date')->nullable();
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->integer('fare_id')->nullable();
            $table->string('pickup_location')->nullable();
            $table->string('hours')->nullable();
            $table->string('instruction')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cab_carts');
    }
};
