<?php 
 
 namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        return view('dashboard.drivers.index', [
            'title' => 'Drivers List',
            'drivers' => Driver::all(),
        ]);
    }

    public function create()
    {
        return view('dashboard.drivers.create', [
            'title' => 'Add Driver',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:available,on_duty,inactive',
        ]);

        Driver::create($validated);

        return redirect('/dashboard/drivers')->with('success', 'Driver created!');
    }

    public function show(Driver $driver)
    {
        return view('dashboard.drivers.show', [
            'title' => 'Driver Detail',
            'driver' => $driver,
        ]);
    }

    public function edit(Driver $driver)
    {
        return view('dashboard.drivers.edit', [
            'title' => 'Edit Driver',
            'driver' => $driver,
        ]);
    }

    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:available,on_duty,inactive',
        ]);

        $driver->update($validated);

        return redirect('/dashboard/drivers')->with('success', 'Driver updated!');
    }

    public function destroy(Driver $driver)
    {
        Driver::destroy($driver->id);
        return redirect('/dashboard/drivers')->with('success', 'Driver deleted!');
    }
}
