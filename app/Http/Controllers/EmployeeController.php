<?php

namespace App\Http\Controllers;

use App\Models\BookingHistory;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\VehicleBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function dashboard()
    {   
        $vehicleBooking = VehicleBooking::with(['vehicle', 'user', 'driver','approvedByLevel1', 'approvedByLevel2'])->where([['user_id', Auth::id()], ['is_returned', false]])->get();
        $bookingHistory = BookingHistory::with('vehicleBooking')
    ->whereHas('vehicleBooking', fn ($q) => $q->where('user_id', Auth::id()))
    ->get();

        return view('dashboard', [
            'vehicleBooking' => $vehicleBooking,
            'bookingHistory' => $bookingHistory
        ]);
    }

    public function returnVehicle()
    {

        $vehicleBooking = VehicleBooking::with(['vehicle', 'user', 'driver'])
    ->where([
        ['user_id', '=', Auth::id()],
        ['status', '=', 'approved_2'],
        ['is_returned' ,'=', false]
    ])
    ->first();

        return view('return_vehicle', [
            'vehicleBooking' => $vehicleBooking,
        ]);
    }

    public function vehicleList()
    {
        return view('vehicle_list', [
            'vehicles' => Vehicle::paginate(6)
        ]);
    }

    public function vehicleBooking()
    {
        if (request('vehicle_id')) {
            $id = request('vehicle_id');
        }

        return view('vehicle_booking', [
            'vehicle' => Vehicle::with('siteLocation', 'rentalVendor')->findOrFail($id),
            'availableDrivers' => Driver::where('status', 'available')->get(),
        ]);
    }

    public function store(Request $request)
    {

        $existingBooking = VehicleBooking::where([['user_id', $request->user_id], ['is_returned', false]])
        ->whereIn('status', ['pending', 'approved_1', 'approved_2']) 
        ->first();

    if ($existingBooking) {
        return redirect('/dashboard')->with('error', 'You already have an active booking');
    }
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'departure_time' => 'required|date',
            'purpose' => 'required|string',
            'driver_id' => 'nullable|exists:drivers,id'
        ]);

        $booking = VehicleBooking::create($validated);

   activity()
    ->causedBy(Auth::id())
    ->performedOn($booking)
    ->log("Mengajukan pemesanan kendaraan (Booking ID: {$booking->id})");

        return redirect('/dashboard')->with('success', 'Booking success!');
    }

public function submitHistory(Request $request)
{
    $validated = $request->validate([
        'vehicle_id' => 'required|exists:vehicles,id',
        'booking_id' => 'required|exists:vehicle_bookings,id',
        'return_time' => 'required|date',
        'start_odometer' => 'required|integer|min:0',
        'end_odometer' => 'required|integer|gt:start_odometer',
        'fuel_consumed' => 'required|numeric|min:0',
        'condition_note' => 'nullable|string',
    ]);

    $distance = $validated['end_odometer'] - $validated['start_odometer'];
    $fuelPerKm = $distance > 0 ? $validated['fuel_consumed'] / $distance : 0;

    BookingHistory::create([
        'booking_id' => $validated['booking_id'],
        'return_time' => $validated['return_time'],
        'start_odometer' => $validated['start_odometer'],
        'end_odometer' => $validated['end_odometer'],
        'fuel_consumed' => $validated['fuel_consumed'],
        'fuel_per_km' => round($fuelPerKm, 3),
        'condition_note' => $validated['condition_note'],
    ]);

    Vehicle::where('id', $validated['vehicle_id'])->update([
        'availability_status' => 'available',
    ]);

    VehicleBooking::where('id', $validated['booking_id'])->update([
        'is_returned' => true
    ]);

    return redirect('/dashboard')->with('success', 'Vehicle returned successfully!');
}

}
