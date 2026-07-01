<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('transaction_id')->unique()->nullable();
            $table->string('gateway')->nullable(); // sslcommerz / shurjopay / bkash / nagad / card
            $table->string('status')->default('pending'); // pending / completed / failed / refunded
            $table->json('gateway_response')->nullable()->comment('Full webhook payload from gateway');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
