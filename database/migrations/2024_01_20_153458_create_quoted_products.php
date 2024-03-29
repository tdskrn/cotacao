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
        Schema::create('quoted_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')->references('id')->on('quotes');
            $table->foreignId('vendor_id')->references('id')->on('vendors');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quoted_products');
    }
};
