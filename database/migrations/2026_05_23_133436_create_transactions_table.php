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
            // CORRECTION : 'user_id' au lieu de 'users', lié explicitement à la table 'users'
            // Remplacer foreignId par foreignUuid si la table users utilise des UUID
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('code')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10);
            $table->string('phone')->nullable();
            $table->string('order_number')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->string('payment_method');
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
