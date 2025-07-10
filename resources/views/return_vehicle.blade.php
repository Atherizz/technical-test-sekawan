<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Return Vehicle') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mb-8 p-4 border border-gray-200 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Active Booking Details</h3>

                    @if ($vehicleBooking)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Booking Code</p>
                                <p class="font-medium">BOOK-{{ $vehicleBooking->id ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Vehicle</p>
                                <p class="font-medium">
                                    {{ $vehicleBooking->vehicle->brand?? '-' }} ({{ $vehicleBooking->vehicle->license_plate ?? '-' }})
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Driver</p>
                                <p class="font-medium">{{ $vehicleBooking->driver->name ?? 'Self Drive' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Departure Time</p>
                                <p class="font-medium">{{ $vehicleBooking->departure_time }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Purpose</p>
                                <p class="font-medium">{{ $vehicleBooking->purpose }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 text-sm italic">No active bookings found.</p>
                    @endif
                </div>

                @if ($vehicleBooking)
                <form action="{{ route('store.return.vehicle') }}" method="POST">
                    @csrf
                    <div class="space-y-6 px-4 pb-6">
                        <div>
                            <label for="return_time" class="block text-sm font-medium text-gray-700">Return Time *</label>
                            <div class="mt-1">
                                <input type="datetime-local" id="return_time" name="return_time"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       required>
                            </div>
                        </div>

                        <input type="hidden" name="booking_id" value="{{ $vehicleBooking->id }}">
                        <input type="hidden" name="vehicle_id" value="{{ $vehicleBooking->vehicle->id }}">


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_odometer" class="block text-sm font-medium text-gray-700">Start Odometer (km) *</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" id="start_odometer" name="start_odometer"
                                           class="block w-full rounded-md border-gray-300 pl-3 pr-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                           placeholder="0" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">km</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="end_odometer" class="block text-sm font-medium text-gray-700">End Odometer (km) *</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" id="end_odometer" name="end_odometer"
                                           class="block w-full rounded-md border-gray-300 pl-3 pr-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                           placeholder="0" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">km</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="fuel_consumed" class="block text-sm font-medium text-gray-700">Fuel Consumed (Liters) *</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="number" step="0.1" id="fuel_consumed" name="fuel_consumed"
                                       class="block w-full rounded-md border-gray-300 pl-3 pr-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       placeholder="0.0" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">liters</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="condition_note" class="block text-sm font-medium text-gray-700">Vehicle Condition Notes</label>
                            <div class="mt-1">
                                <textarea id="condition_note" name="condition_note" rows="3"
                                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                          placeholder="Any damage or issues to report"></textarea>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Please note any scratches, dents, or mechanical issues</p>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('dashboard') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Submit Return
                            </button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
