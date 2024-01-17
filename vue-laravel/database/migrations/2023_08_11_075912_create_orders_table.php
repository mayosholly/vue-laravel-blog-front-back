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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_name');
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->enum('currency', ['NGN', 'USD']);
            $table->enum('delivery_status', ['confirmed', 'unconfirmed', 'pending']);
            $table->decimal('amount', 10, 2);
            $table->boolean('payment_status')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
