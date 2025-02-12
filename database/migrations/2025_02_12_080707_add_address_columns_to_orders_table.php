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
        Schema::table('orders', function (Blueprint $table) {
          $table->string('address_line_1')->nullable();
          $table->string('address_line_2')->nullable();
          $table->string('landmark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
          $table->dropColumn([
            'address_line_1',
            'address_line_2',
            'landmark',
          ]);
        });
    }
};
