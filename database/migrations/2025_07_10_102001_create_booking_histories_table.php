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
        Schema::create('booking_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('vehicle_bookings')->onDelete('cascade');
            $table->dateTime('return_time');
            $table->decimal('fuel_consumed', 8, 2)->nullable(); 
            $table->integer('start_odometer')->nullable();
            $table->integer('end_odometer')->nullable();
            $table->decimal('fuel_per_km', 8, 4)->nullable();
            $table->text('condition_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_histories');
    }
};
