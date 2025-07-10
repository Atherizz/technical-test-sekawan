<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleBooking;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class VehicleBookingController extends Controller
{
    public function index()
    {
        $query = VehicleBooking::with(['vehicle', 'user', 'driver'])->where([
            ['status', '!=', 'rejected'],
            ['is_returned', '=', false]
        ]);

        if (request('status')) {
            $query->where('status', request('status'));
        }

        $bookings = $query->get();

        return view('dashboard.vehicle_bookings.index', [
            'title' => 'Bookings',
            'bookings' => $bookings
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



    public function show(VehicleBooking $vehicleBooking)
    {
        return view('dashboard.vehicle_bookings.show', [
            'title' => 'Booking Detail',
            'booking' => $vehicleBooking->load(['vehicle', 'user', 'driver'])
        ]);
    }
    public function managerApprove(int $id)
    {
         Gate::authorize('manager');

        $vehicleBooking = VehicleBooking::findOrFail($id);

        if (!$vehicleBooking->vehicle->isAvailableFor()) {
            return redirect('/admin/dashboard/vehicle_booking')->with('error', 'Vehicle already in use or under maintenance!');
        }

        $vehicleBooking->update([
            'status' => 'approved_1',
            'approved_at_level_1' => now(),
            'approved_by_level_1' => Auth::id()

        ]);

        return redirect('/admin/dashboard/vehicle_booking')->with('success', 'status updated!');
    }

    public function supervisorApprove(int $id)
    {


        Gate::authorize('supervisor');
        
        $vehicleBooking = VehicleBooking::findOrFail($id);

        $vehicleBooking->update([
            'status' => 'approved_2',
            'approved_at_level_2' => now(),
            'approved_by_level_2' => Auth::id()
        ]);

        return redirect('/admin/dashboard/vehicle_booking')->with('success', 'status updated!');
    }


    public function destroy(VehicleBooking $vehicleBooking)
    {
        $vehicleBooking->delete();
        return redirect('/admin/dashboard/vehicle_booking')->with('success', 'Booking rejected!');
    }
}
