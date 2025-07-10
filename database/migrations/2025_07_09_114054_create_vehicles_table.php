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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate');
            $table->string('brand');
            $table->enum('vehicle_type', ['passenger', 'cargo']);
            $table->foreignId('site_location_id')->constrained('site_locations')->onDelete('cascade');
            $table->enum('ownership_status', ['company owned', 'rented']);
            $table->foreignId('rental_vendor_id')->nullable()->constrained('rental_vendors')->onDelete('set null');
            $table->enum('operational_status', ['active', 'in_service', 'inactive']);
            $table->enum('availability_status', ['available', 'booked', 'in_use'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
