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
        Schema::create('vendor_outstation_fares', function (Blueprint $table) {
          $table->id();
          $table->integer('vendor_outstation_id');
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
        Schema::dropIfExists('vendor_outstation_fares');
    }
};
