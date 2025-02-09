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
        Schema::create('laundry_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('category_id');
            $table->decimal('total', 8, 2)->nullable();
            $table->date('service_date')->nullable();
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundry_carts');
    }
};
