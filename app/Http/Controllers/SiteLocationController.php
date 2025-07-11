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

        return redirect('/admin/dashboard/site_location')->with('success', 'Location created!');
    }


    public function edit(SiteLocation $siteLocation)
    {


        return view('dashboard.site_locations.edit', [
            'title' => 'Edit Location',
            'location' => $siteLocation
        ]);
    }

    public function update(Request $request, SiteLocation $siteLocation)
    {
        $validated = $request->validate([
            'location_name' => 'required',
            'location_type' => 'required|in:head_office,branch,mine',
            'address' => 'required',
        ]);

        $siteLocation->update($validated);

        return redirect('/admin/dashboard/site_location')->with('success', 'Location updated!');
    }

    public function destroy(SiteLocation $siteLocation)
    {
        SiteLocation::destroy($siteLocation->id);
        return redirect('/admin/dashboard/site_location')->with('success', 'Location deleted!');
    }
}
