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
        Schema::create('products', function (Blueprint $table) {
            $products_gender = ['Male', 'Female'];
            $table->id('Product_id');
            $table->string('Product_name')->nullable(false);
            $table->string('Product_price')->nullable(false);
            $table->string('Product_category')->nullable(false);
            $table->enum('Product_for', $products_gender);
            $table->string('Product_size')->nullable(false);
            $table->string('Product_image')->nullable(false);
            $table->string('Product_status')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
