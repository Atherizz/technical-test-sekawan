<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
     protected $guarded = [];   
    public function vehicleBooking()
{
    return $this->belongsTo(VehicleBooking::class, 'booking_id');
}
}
