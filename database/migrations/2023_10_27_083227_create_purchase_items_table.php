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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable(false);
            $table->string('address')->nullable(false);
            $table->string('Product_id')->nullable(false);
            $table->string('Product_name')->nullable(false);
            $table->string('Product_price')->nullable(false);
            $table->string('Product_size')->nullable(false);
            $table->string('Product_for')->nullable(false);
            $table->string('Product_category')->nullable(false);
            $table->string('Quantity')->nullable(false);
            $table->string('total')->nullable(false);
            $table->string('FullTotal')->nullable(false);
            $table->string('image')->nullable(false);
            $table->string('status')->nullable(false);
            $table->string('coupen')->nullable(true);
            $table->string('purchased_date')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
