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
        Schema::create('laundry_cart_items', function (Blueprint $table) {
            $table->id();
            $table->integer('laundry_cart_id');
            $table->integer('service_id');
            $table->decimal('price_per_piece', 8, 2);
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundry_cart_items');
    }
};
