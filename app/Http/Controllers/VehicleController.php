<?php 
namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\SiteLocation;
use App\Models\RentalVendor;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        return view('dashboard.vehicles.index', [
            'title' => 'Vehicle List',
            'vehicles' => Vehicle::with([ 'siteLocation', 'rentalVendor'])->latest()->paginate(5),
            
        ]);
    }

    public function create()
    {
        return view('dashboard.vehicles.create', [
            'title' => 'Add Vehicle',
            'vehicle' => Vehicle::all(),
            'siteLocations' => SiteLocation::all(),
            'rentalVendors' => RentalVendor::all()
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'license_plate' => 'required|unique:vehicles',
            'brand' => 'required',
            'vehicle_type' => 'required|in:passenger,cargo',
            'site_location_id' => 'required|exists:site_locations,id',
            'ownership_status' => 'required|in:company owned,rented',
            'rental_vendor_id' => 'nullable|exists:rental_vendors,id',
            'operational_status' => 'required|in:active,in_service,inactive',
        ]);

        Vehicle::create($validate);

        return redirect('/admin/dashboard/vehicles')->with('success', 'Vehicle added successfully!');
    }

    public function edit(Vehicle $vehicle)
    {

        return view('dashboard.vehicles.edit', [
            'title' => 'Edit Vehicle',
            'vehicle' => $vehicle,
            'siteLocations' => SiteLocation::all(),
            'rentalVendors' => RentalVendor::all()
        ]);
    }

    public function update(Request $request, Vehicle $vehicle)
    {

        $validate = $request->validate([
            'license_plate' => 'required|unique:vehicles,license_plate,' . $vehicle->id,
            'brand' => 'required',
            'vehicle_type' => 'required|in:passenger,cargo',
            'site_location_id' => 'required|exists:site_locations,id',
            'ownership_status' => 'required|in:company owned,rented',
            'rental_vendor_id' => 'nullable|exists:rental_vendors,id',
            'operational_status' => 'required|in:active,in_service,inactive',
        ]);

        $vehicle->update($validate);

        return redirect('/admin/dashboard/vehicles')->with('success', 'Vehicle updated successfully!');
    }

    public function destroy(Vehicle $vehicle)
    {
        Vehicle::destroy($vehicle->id);
        return redirect('/admin/dashboard/vehicles')->with('success', 'Vehicle deleted successfully!');
    }

}
