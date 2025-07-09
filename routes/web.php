<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\MaintenanceScheduleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteLocationController;
use App\Http\Controllers\VehicleBookingController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/dashboard/drivers', DriverController::class);
Route::resource('/dashboard/maintenance', MaintenanceScheduleController::class);
Route::resource('/dashboard/site_location', SiteLocationController::class);
Route::resource('/dashboard/vehicle_booking', VehicleBookingController::class);
Route::resource('/dashboard/vehicle', VehicleController::class);


require __DIR__.'/auth.php';
