<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceSchedule;
use App\Models\Vehicle;

class MaintenanceScheduleController extends Controller
{
    public function index()
    {
        return view('dashboard.maintenance.index', [
            'title' => 'Maintenance List',
            'maintenances' => MaintenanceSchedule::with('vehicle')->get(),
        ]);
    }

    public function create()
    {
        return view('dashboard.maintenance.create', [
            'title' => 'Add Maintenance',
            'vehicles' => Vehicle::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'maintenance_date' => 'required|date',
            'description' => 'required|string',
            'maintenance_type' => 'required|in:minor,major',
            'status' => 'required|in:scheduled,completed',
        ]);

        MaintenanceSchedule::create($validated);

        return redirect('/dashboard/maintenance-schedules')->with('success', 'Maintenance added!');
    }

    public function show(MaintenanceSchedule $maintenanceSchedule)
    {


        return view('dashboard.maintenance.show', [
            'title' => 'Maintenance Detail',
            'maintenance' => $maintenanceSchedule
        ]);
    }

    public function edit(MaintenanceSchedule $maintenanceSchedule)
    {
        return view('dashboard.maintenance.edit', [
            'title' => 'Edit Maintenance',
            'maintenance' => $maintenanceSchedule,
            'vehicles' => Vehicle::all(),
        ]);
    }

    public function update(Request $request, MaintenanceSchedule $maintenanceSchedule)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'maintenance_date' => 'required|date',
            'description' => 'required|string',
            'maintenance_type' => 'required|in:minor,major',
            'status' => 'required|in:scheduled,completed',
        ]);


        $maintenanceSchedule->update($validated);

        return redirect('/dashboard/maintenance-schedules')->with('success', 'Maintenance updated!');
    }

    public function destroy(MaintenanceSchedule $maintenanceSchedule)
    {
        MaintenanceSchedule::destroy($maintenanceSchedule->id);
        return redirect('/dashboard/maintenance-schedules')->with('success', 'Maintenance deleted!');
    }
}
