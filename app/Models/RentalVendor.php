<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class RentalVendor extends Model
{
    protected $guarded = [];

    public function vehicle(): HasMany {
        return $this->hasMany(Vehicle::class, 'rental_vendor_id');
    }
}
