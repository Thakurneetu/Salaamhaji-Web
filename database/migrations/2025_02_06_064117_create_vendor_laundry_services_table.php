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
        Schema::create('vendor_laundry_services', function (Blueprint $table) {
          $table->id();
          $table->integer('vendor_id');
          $table->integer('category_id');
          $table->string('name')->nullable();
          $table->decimal('price', 8,2)->default(0.00);
          $table->boolean('status')->default(1);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_laundry_services');
    }
};
