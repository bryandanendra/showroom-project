<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For SQLite, we need to recreate the table with the new enum values
        // First, create a temporary table with the new structure
        Schema::create('orders_temp', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 15, 2);
            $table->decimal('down_payment', 15, 2)->nullable();
            $table->enum('payment_method', ['cash', 'transfer', 'credit'])->default('cash');
            $table->string('id_card_path')->nullable();
            $table->string('driver_license_path')->nullable();
            $table->string('credit_approval_path')->nullable();
            $table->text('customer_notes')->nullable();
            $table->enum('status', ['pending', 'processing', 'approved', 'rejected', 'completed', 'cancelled'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        // Copy data from old table to new table
        DB::statement('INSERT INTO orders_temp SELECT * FROM orders');

        // Drop old table
        Schema::dropIfExists('orders');

        // Rename temp table to orders
        Schema::rename('orders_temp', 'orders');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse: recreate with old enum values
        Schema::create('orders_temp', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 15, 2);
            $table->decimal('down_payment', 15, 2)->nullable();
            $table->enum('payment_method', ['cash', 'credit', 'leasing'])->default('cash');
            $table->string('id_card_path')->nullable();
            $table->string('driver_license_path')->nullable();
            $table->string('credit_approval_path')->nullable();
            $table->text('customer_notes')->nullable();
            $table->enum('status', ['pending', 'processing', 'approved', 'rejected', 'completed', 'cancelled'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        DB::statement('INSERT INTO orders_temp SELECT * FROM orders');
        Schema::dropIfExists('orders');
        Schema::rename('orders_temp', 'orders');
    }
};
