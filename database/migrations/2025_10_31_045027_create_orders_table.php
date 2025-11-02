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
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 15, 2); // harga saat order dibuat
            $table->decimal('down_payment', 15, 2)->nullable(); // DP
            $table->enum('payment_method', ['cash', 'credit', 'leasing'])->default('cash');
            $table->string('id_card_path')->nullable(); // KTP upload
            $table->string('driver_license_path')->nullable(); // SIM upload
            $table->text('customer_notes')->nullable();
            $table->enum('status', ['pending', 'processing', 'approved', 'rejected', 'completed', 'cancelled'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('completed_at')->nullable();
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
