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
        Schema::create('vendor_local_fares', function (Blueprint $table) {
          $table->id();
          $table->integer('vendor_id');
          $table->integer('location_id')->nullable();
          $table->integer('cab_id');
          $table->decimal('price', 8, 2);
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_local_fares');
    }
};
