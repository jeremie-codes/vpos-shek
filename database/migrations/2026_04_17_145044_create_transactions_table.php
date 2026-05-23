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
            $table->string('code')->unique();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('currency')->nullable();
            $table->string('phone')->nullable();
            $table->enum('payment_method', ['mobile', 'card'])->nullable();
            $table->string('order_number')->nullable();
            $table->foreignId('bundle_id')->constrained('bundles')->cascadeOnDelete();
            $table->enum('status', ['pending', 'success', 'failed', 'cancelled'])->default('pending');
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
