<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupens', function (Blueprint $table) {
            $table->id();
            $table->string('coupen_name')->unique();
            $table->integer('Quantity');
            $table->string('expire_date');
            $table->string('status')->default('Active');
            $table->string('discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupens');
    }
};