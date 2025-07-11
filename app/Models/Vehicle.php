<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function siteLocation(): BelongsTo {
        return $this->belongsTo(SiteLocation::class);
    }

    public function rentalVendor(): BelongsTo {
        return $this->belongsTo(RentalVendor::class);
    }

    public function maintenance(): HasMany {
        return $this->hasMany(MaintenanceSchedule::class, 'vehicle_id');
    }
    public function vehicleBooking(): HasMany {
        return $this->hasMany(VehicleBooking::class, 'vehicle_id');
    }
}
