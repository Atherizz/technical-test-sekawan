<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MaintenanceScheduleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteLocationController;
use App\Http\Controllers\VehicleBookingController;
use App\Http\Controllers\VehicleController;
use App\Models\BookingHistory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/return_vehicle', function () {
//     return view('return_vehicle');
// })->middleware(['auth', 'verified'])->name('return_vehicle');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
    Route::get('/return_vehicle', [EmployeeController::class, 'returnVehicle'])->name('return_vehicle');
    Route::get('/vehicle_list', [EmployeeController::class, 'vehicleList'])->name('vehicle_list');
    Route::get('/vehicle_list/vehicle_booking', [EmployeeController::class, 'vehicleBooking'])->name('vehicle_booking');
    Route::post('/vehicle_list/vehicle_booking', [EmployeeController::class, 'store'])->name('booking.store');
    Route::post('/return_vehicle', [EmployeeController::class, 'submitHistory'])->name('store.return.vehicle');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('admin.dashboard');
    Route::resource('/admin/dashboard/drivers', DriverController::class);
    Route::resource('/admin/dashboard/maintenance_schedule', MaintenanceScheduleController::class);
    Route::resource('/admin/dashboard/site_location', SiteLocationController::class);
    Route::resource('/admin/dashboard/vehicles', controller: VehicleController::class);

    Route::resource('/admin/dashboard/vehicle_booking', VehicleBookingController::class);
    Route::put('/admin/dashboard/vehicle_bookings/{id}/approve-level1', [VehicleBookingController::class, 'managerApprove'])->name('bookings.approve.level1');
    Route::put('/admin/dashboard/vehicle_bookings/{id}/approve-level2', [VehicleBookingController::class, 'supervisorApprove'])->name('bookings.approve.level2');

    Route::get('/admin/dashboard/booking_history', function () {
            return view('dashboard.booking_histories.index', [
            'bookingHistories' => BookingHistory::with('vehicleBooking.vehicle', 'vehicleBooking.user')->get()  
        ]);
    });
});


require __DIR__ . '/auth.php';
