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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('payment_date');
            $table->enum('payment_method', ['credit_card','bank_transfer','paypal']);
            $table->decimal('amount', 10,2);
            $table->enum('payment_status', ['pending','completed','failed']);
            $table->timestamps();
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
