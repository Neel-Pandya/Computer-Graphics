<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     */

    public function up(): void
    {
        Schema::create('customer_registration', function (Blueprint $table) {
            $genders = ['Male', 'Female'];

            $table->id();
            $table->string('customer_name')->nullable(false);
            $table->string('customer_email')->nullable(false);
            $table->string('customer_mobile')->nullable(false);
            $table->string('customer_password')->nullable(false);
            $table->enum('customer_gender', $genders);
            $table->string('customer_profile')->nullable(false);
            $table->string('customer_status')->default('Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_registration');
    }
};
