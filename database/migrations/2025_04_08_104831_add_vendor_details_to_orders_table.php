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
          $table->string('vendor_name')->nullable();
          $table->string('vendor_phone')->nullable();
          $table->string('vendor_address')->nullable();
          $table->timestamp('delivered_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
          $table->dropColumn('vendor_name');
          $table->dropColumn('vendor_phone');
          $table->dropColumn('vendor_address');
          $table->dropColumn('delivered_at');
        });
    }
};
