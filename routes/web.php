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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
    return view('dashboard.dashboard');
    })->name('admin.dashboard');
    Route::resource('/admin/dashboard/drivers', DriverController::class);
    Route::resource('/admin/dashboard/maintenance_schedule', MaintenanceScheduleController::class);
    Route::resource('/admin/dashboard/site_location', SiteLocationController::class);
    Route::resource('/admin/dashboard/vehicle_booking', VehicleBookingController::class);
    Route::resource('/admin/dashboard/vehicles', controller: VehicleController::class);
});


require __DIR__.'/auth.php';
