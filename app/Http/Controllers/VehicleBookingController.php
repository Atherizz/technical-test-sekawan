<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleBooking;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Driver;

class VehicleBookingController extends Controller
{
    public function index()
    {
        return view('dashboard.vehicle_bookings.index', [
            'title' => 'Bookings',
            'bookings' => VehicleBooking::with(['vehicle', 'user', 'driver'])->get()
        ]);
    }

    public function create()
    {
        return view('dashboard.vehicle_bookings.create', [
            'title' => 'Create Booking',
            'vehicles' => Vehicle::all(),
            'users' => User::all(),
            'drivers' => Driver::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'departure_time' => 'required|date',
            'return_time' => 'required|date|after_or_equal:departure_time',
            'purpose' => 'required|string',
            'driver_id' => 'nullable|exists:drivers,id',
            'status' => 'required|in:pending,partially_approved,fully_approved,rejected',
        ]);

        VehicleBooking::create($validated);

        return redirect('/dashboard/vehicle-bookings')->with('success', 'Booking created!');
    }

    public function show(string $id)
    {
        return view('dashboard.vehicle_bookings.show', [
            'title' => 'Booking Detail',
            'booking' => VehicleBooking::with(['vehicle', 'user', 'driver'])->findOrFail($id)
        ]);
    }

    public function edit(string $id)
    {
        return view('dashboard.vehicle_bookings.edit', [
            'title' => 'Edit Booking',
            'booking' => VehicleBooking::findOrFail($id),
            'vehicles' => Vehicle::all(),
            'users' => User::all(),
            'drivers' => Driver::all()
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'departure_time' => 'required|date',
            'return_time' => 'required|date|after_or_equal:departure_time',
            'purpose' => 'required|string',
            'driver_id' => 'nullable|exists:drivers,id',
            'status' => 'required|in:pending,partially_approved,fully_approved,rejected',
        ]);

        $booking = VehicleBooking::findOrFail($id);
        $booking->update($validated);

        return redirect('/dashboard/vehicle-bookings')->with('success', 'Booking updated!');
    }

    public function destroy(string $id)
    {
        VehicleBooking::destroy($id);
        return redirect('/dashboard/vehicle-bookings')->with('success', 'Booking deleted!');
    }
}
