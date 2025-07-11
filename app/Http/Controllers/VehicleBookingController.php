<?php

namespace App\Http\Controllers;

use App\Exports\ExportVehicleBooking;
use Illuminate\Http\Request;
use App\Models\VehicleBooking;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class VehicleBookingController extends Controller
{
    public function index()
    {
        $query = VehicleBooking::with(['vehicle', 'user', 'driver'])->where([

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

    public function exportExcel()
    {
        return Excel::download(new ExportVehicleBooking, "vehicle_booking.xlsx");
    }


    public function managerApprove(int $id)
    {
        Gate::authorize('manager');


        $vehicleBooking = VehicleBooking::findOrFail($id);

        if ($vehicleBooking->vehicle->operational_status !== 'active' || $vehicleBooking->vehicle->availability_status === 'in_use') {
            return redirect('/admin/dashboard/vehicle_booking')->with('error', 'Vehicle already in use or under maintenance!');
        }

        $vehicleBooking->update([
            'status' => 'approved_1',
            'approved_at_level_1' => now(),
            'approved_by_level_1' => Auth::id()

        ]);

        $vehicle = Vehicle::findOrFail($vehicleBooking->vehicle->id);
        $vehicle->update([
    'availability_status' => 'booked'
]);


        activity()
            ->causedBy(Auth::id())
            ->performedOn($vehicleBooking)
            ->log("Menyetujui booking level 1 (Booking ID: {$vehicleBooking->id})");

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

                $vehicle = Vehicle::findOrFail($vehicleBooking->vehicle->id);
        $vehicle->update([
    'availability_status' => 'in_use'
]);


        activity()
            ->causedBy(Auth::id())
            ->performedOn($vehicleBooking)
            ->log("Menyetujui booking level 2 (Booking ID: {$vehicleBooking->id})");


        return redirect('/admin/dashboard/vehicle_booking')->with('success', 'status updated!');
    }


    public function destroy(VehicleBooking $vehicleBooking)
    {
        $vehicleBooking->delete();

        activity()
            ->causedBy(Auth::id())
            ->performedOn($vehicleBooking)
            ->log("Menolak dan menghapus booking (Booking ID: {$vehicleBooking->id})");
        return redirect('/admin/dashboard/vehicle_booking')->with('success', 'Booking rejected!');
    }
}
