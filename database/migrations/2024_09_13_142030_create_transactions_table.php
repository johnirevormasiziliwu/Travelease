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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('holiday_package_id')->constrained('holiday_packages')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('transaction_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_price', 10 , 2);
            $table->enum('payment_status', ['pending','paid', 'failed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
