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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('store_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('manufacturer_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('inventory_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('promotion_type', ['flat', 'percent', 'bogo']);
            $table->enum('promotional_region', ['city', 'state', 'country'])->nullable();
            $table->decimal('flat', $precision = 8, $scale = 2)->nullable();
            $table->decimal('percent', $precision = 4, $scale = 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('promotions');
    }
};
