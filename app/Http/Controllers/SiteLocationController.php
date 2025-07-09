<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteLocation;

class SiteLocationController extends Controller
{
    public function index()
    {
        return view('dashboard.site_locations.index', [
            'title' => 'All Locations',
            'locations' => SiteLocation::all(),
        ]);
    }

    public function create()
    {
        return view('dashboard.site_locations.create', [
            'title' => 'Add Location',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_name' => 'required',
            'location_type' => 'required|in:head_office,branch,mine',
            'address' => 'required',
        ]);

        SiteLocation::create($validated);

        return redirect('/dashboard/site-locations')->with('success', 'Location created!');
    }

    public function show(string $id)
    {
        $location = SiteLocation::findOrFail($id);

        return view('dashboard.site_locations.show', [
            'title' => 'Detail Location',
            'location' => $location
        ]);
    }

    public function edit(string $id)
    {
        $location = SiteLocation::findOrFail($id);

        return view('dashboard.site_locations.edit', [
            'title' => 'Edit Location',
            'location' => $location
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'location_name' => 'required',
            'location_type' => 'required|in:head_office,branch,mine',
            'address' => 'required',
        ]);

        $location = SiteLocation::findOrFail($id);
        $location->update($validated);

        return redirect('/dashboard/site-locations')->with('success', 'Location updated!');
    }

    public function destroy(string $id)
    {
        SiteLocation::destroy($id);
        return redirect('/dashboard/site-locations')->with('success', 'Location deleted!');
    }
}
