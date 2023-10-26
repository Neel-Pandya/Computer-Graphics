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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable(false);
            $table->integer('Product_id')->unique()->nullable(false);
            $table->string('Product_name')->nullable(false);
            $table->string('Product_price')->nullable(false);
            $table->string('Product_category')->nullable(false);
            $table->string('Product_for')->nullable(false);
            $table->string('Product_size')->nullable(false);
            $table->string('Product_image')->nullable(false);
            $table->string('quantity')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
