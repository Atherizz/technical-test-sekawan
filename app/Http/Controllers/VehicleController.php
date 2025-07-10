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
            'vehicles' => Vehicle::with([ 'siteLocation', 'rentalVendor'])->latest()->get()
            
        ]);
    }

    public function create()
    {
        return view('dashboard.vehicles.create', [
            'title' => 'Add Vehicle',
            'vehicle' => Vehicle::all(),
            'locations' => SiteLocation::all(),
            'vendors' => RentalVendor::all()
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'license_plate' => 'required|unique:vehicles',
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|digits:4',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'site_location_id' => 'required|exists:site_locations,id',
            'ownership_status' => 'required|in:company_owned,rented',
            'rental_vendor_id' => 'nullable|exists:rental_vendors,id',
            'operational_status' => 'required|in:active,in_service,inactive',
        ]);

        Vehicle::create($validate);

        return redirect('/dashboard/vehicles')->with('success', 'Vehicle added successfully!');
    }

    public function edit(int $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('dashboard.vehicles.edit', [
            'title' => 'Edit Vehicle',
            'vehicle' => $vehicle,
            'locations' => SiteLocation::all(),
            'vendors' => RentalVendor::all()
        ]);
    }

    public function update(Request $request, int $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $validate = $request->validate([
            'license_plate' => 'required|unique:vehicles,license_plate,' . $id,
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|digits:4',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'site_location_id' => 'required|exists:site_locations,id',
            'ownership_status' => 'required|in:company_owned,rented',
            'rental_vendor_id' => 'nullable|exists:rental_vendors,id',
            'operational_status' => 'required|in:active,in_service,inactive',
        ]);

        $vehicle->update($validate);

        return redirect('/dashboard/vehicles')->with('success', 'Vehicle updated successfully!');
    }

    public function destroy(Vehicle $vehicle)
    {
        Vehicle::destroy($vehicle->id);
        return redirect('/dashboard/vehicles')->with('success', 'Vehicle deleted successfully!');
    }

    public function show(string $id)
    {
        // Optional: kalau mau detail page
        $vehicle = Vehicle::with(['vehicleType', 'siteLocation', 'rentalVendor'])->findOrFail($id);
        return view('dashboard.vehicles.show', [
            'title' => 'Vehicle Detail',
            'vehicle' => $vehicle
        ]);
    }
}
