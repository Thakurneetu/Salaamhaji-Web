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
        Schema::create('food_masters', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name')->nullable();
            $table->decimal('price', 8,2)->default(0.00);
            $table->integer('weight')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_masters');
    }
};
