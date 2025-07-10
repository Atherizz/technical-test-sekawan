<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicle List') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters Section -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow">
                <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-4 md:space-y-0">
                    <div class="w-full md:w-1/4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Type</label>
                        <select
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All Types</option>
                            <option value="passenger">Passenger</option>
                            <option value="cargo">Cargo</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <select
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All Locations</option>
                            <option value="1">Main Office</option>
                            <option value="2">North Mine</option>
                            <option value="3">Processing Plant</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="available">Available</option>
                            <option value="all">All Statuses</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/4 flex items-end">
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                            Filter Vehicles
                        </button>
                    </div>
                </div>
            </div>

            <!-- Vehicles Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($vehicles as $vehicle)
                    <!-- Vehicle Card 1 -->
                    <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $vehicle->license_plate }}</h3>
                                    <p class="text-gray-600">{{ $vehicle->brand }}</p>
                                </div>
                                <span
                                    class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">{{ $vehicle->availability_status }}</span>
                            </div>

                            <div class="mt-4 space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Type:</span>
                                    <span class="text-sm font-medium">{{ $vehicle->vehicle_type }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Location:</span>
                                    <span class="text-sm font-medium">{{ $vehicle->siteLocation->location_name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Ownership:</span>
                                    <span class="text-sm font-medium">{{ $vehicle->ownership_status }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">Operational:</span>
                                    <span class="text-sm font-medium">{{ $vehicle->operational_status }}</span>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-200">
                                @if ($vehicle->operational_status === 'inactive' || $vehicle->availability_status === 'in_use')
                                    <button
                                        class="w-full bg-gray-300 text-gray-600 px-4 py-2 rounded-md cursor-not-allowed"
                                        disabled>
                                        Currently Unavailable
                                    </button>
                                @elseif ($vehicle->operational_status === 'in_service')
                                    <button
                                        class="w-full bg-gray-300 text-gray-600 px-4 py-2 rounded-md cursor-not-allowed"
                                        disabled>
                                        Under Maintenance
                                    </button>
                                @else
                                    <a href="/vehicle_list/vehicle_booking?vehicle_id={{ $vehicle->id }}"
                                        class="block w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-center">
                                        Book This Vehicle
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach



                {{-- <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">In Service</span> --}}



                {{ $vehicles->links() }}

</x-app-layout>
