<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicle Booking') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Vehicle Information -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Vehicle Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">License Plate</p>
                                <p class="font-medium">{{ $vehicle->license_plate }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Brand & Type</p>
                                <p class="font-medium">{{ $vehicle->brand }} ({{ ucfirst($vehicle->vehicle_type) }})</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Location</p>
                                <p class="font-medium">{{ $vehicle->siteLocation->location_name}}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        Available
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

        
                    <form method="POST" action="{{ route('booking.store') }}">
                        @csrf

         
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->User()->id }}">

                        <div class="mb-6">
                            <label for="departure_time" class="block text-sm font-medium text-gray-700 mb-1">
                                Departure Date & Time *
                            </label>
                            <input type="datetime-local" id="departure_time" name="departure_time" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                   min="{{ now()->format('Y-m-d\TH:i') }}"
                                   required>
                            @error('departure_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                   
                        <div class="mb-6">
                            <label for="driver_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Select Driver (Optional)
                            </label>
                            <select id="driver_id" name="driver_id" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="">-- No Driver (Self Drive) --</option>
                                @foreach($availableDrivers as $driver)
                                    <option value="{{ $driver->id }}">
                                        {{ $driver->name }} (Phone: {{ $driver->phone }})
                                    </option>
                                @endforeach
                            </select>
                            @error('driver_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                 
                        <div class="mb-6">
                            <label for="purpose" class="block text-sm font-medium text-gray-700 mb-1">
                                Purpose of Use 
                            </label>
                            <textarea id="purpose" name="purpose" rows="3"
                                      class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                      placeholder="Describe the purpose of this vehicle booking (min. 20 characters)"
                                      required></textarea>
                            @error('purpose')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('vehicles.index') }}" 
                               class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Submit Booking Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            
            now.setHours(now.getHours() + 1);
            const minDateTime = now.toISOString().slice(0, 16);
            document.getElementById('departure_time').min = minDateTime;
        });
    </script>
</x-app-layout>