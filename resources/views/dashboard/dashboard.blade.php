<x-admin>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        <div class="minimal-card bg-white p-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Vehicles</p>
                    <h3 class="text-2xl font-semibold mt-1">{{ $totalVehicles }}</h3>
                </div>
                <div class="text-primary-500">
                    <i class="fas fa-truck text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100">

            </div>
        </div>

        <div class="minimal-card bg-white p-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Currently Operating</p>
                    <h3 class="text-2xl font-semibold mt-1">{{ $operatingVehicles }}</h3>
                </div>
                <div class="text-blue-500">
                    <i class="fas fa-road text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100">
            </div>
        </div>

        <div class="minimal-card bg-white p-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Needs Maintenance</p>
                    <h3 class="text-2xl font-semibold mt-1">{{ $onMaintenance }}</h3>
                </div>
                <div class="text-yellow-500">
                    <i class="fas fa-tools text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100">
            </div>
        </div>

        <div class="minimal-card bg-white p-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Available</p>
                    <h3 class="text-2xl font-semibold mt-1">{{ $availableVehicles }}</h3>
                </div>
                <div class="text-green-500">
                    <i class="fas fa-parking text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
        <div class="minimal-card bg-white p-5 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold">Latest Operational Status</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-xs bg-primary-50 text-primary-700 rounded">Today</button>
                    <button class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded">This Week</button>
                </div>
            </div>
            <div class="h-64 overflow-y-auto">
                <ul class="space-y-4 text-sm">
                    @foreach ($recentVehicleStatus as $vehicle)
                        <li class="flex justify-between items-center border-b pb-2">
                            <div>
                                <p class="font-medium">{{ $vehicle->license_plate }}</p>
                                <p class="text-gray-500 text-xs">Status: {{ ucfirst($vehicle->availability_status) }}</p>
                            </div>
                            <span class="text-xs text-gray-400">{{ $vehicle->updated_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="minimal-card bg-white p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold">Recent Activities</h3>
                <a href="#" class="text-xs text-primary-600 hover:text-primary-800">View All</a>
            </div>
            <div class="space-y-4">
                @foreach ($recentActivities as $activity)
                    <div class="flex items-start">
                        <div class="p-2 bg-gray-100 text-gray-600 rounded-full mr-3">
                            <i class="fas fa-info-circle text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">{{ $activity->description }}</p>
                            <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-admin>
