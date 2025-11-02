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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('brand'); // Toyota, Honda, etc
            $table->string('model'); // Avanza, Civic, etc
            $table->integer('year');
            $table->string('color');
            $table->enum('transmission', ['manual', 'automatic']);
            $table->enum('fuel_type', ['bensin', 'diesel', 'hybrid', 'electric']);
            $table->integer('mileage'); // kilometer
            $table->decimal('price', 15, 2);
            $table->string('license_plate')->nullable();
            $table->integer('engine_capacity')->nullable(); // cc
            $table->integer('passengers')->default(5);
            $table->text('description')->nullable();
            $table->text('features')->nullable(); // JSON or comma-separated
            $table->enum('condition', ['excellent', 'good', 'fair'])->default('good');
            $table->enum('status', ['available', 'sold', 'reserved'])->default('available');
            $table->string('main_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
