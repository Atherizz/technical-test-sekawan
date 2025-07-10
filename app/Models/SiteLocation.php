<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteLocation extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function vehicle(): HasMany {
        return $this->hasMany(Vehicle::class, 'site_location_id');
    }
    
    public function user(): HasMany {
        return $this->hasMany(User::class, 'site_location_id');
    }
}
