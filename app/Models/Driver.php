<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $guarded = [];
    //
        public function vehicleBooking(): HasMany {
        return $this->hasMany(VehicleBooking::class, 'driver_id');
    }
}
