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
        Schema::create('vehicle_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->dateTime('departure_time');
            $table->text('purpose');
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->onDelete('set null');
            $table->enum('status', ['pending', 'approved_1', 'approved_2'])->default('pending');
            $table->timestamp('approved_at_level_1')->nullable();
            $table->timestamp('approved_at_level_2')->nullable();
            $table->foreignId('approved_by_level_1')->nullable()->constrained('users');
            $table->foreignId('approved_by_level_2')->nullable()->constrained('users');
            $table->boolean('is_returned')->default(false);
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_bookings');
    }
};
