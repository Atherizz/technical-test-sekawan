<x-admin>
    <main class="flex-1 overflow-y-auto p-6">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Booking History</h1>
                <p class="text-gray-600">View all completed vehicle returns</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Return Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fuel/Liter</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fuel/km</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Odometer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Condition</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($bookingHistories as $history)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">BOOK-{{ str_pad($history->vehicleBooking->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $history->vehicleBooking->vehicle->brand ?? '-' }} ({{ $history->vehicleBooking->vehicle->license_plate ?? '-' }})
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $history->vehicleBooking->user->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$history->return_time}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ number_format($history->fuel_consumed, 1) }} L
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ number_format($history->fuel_per_km, 3) }} L/km
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $history->start_odometer }} - {{ $history->end_odometer }} km
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $history->condition_note ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500 italic">No booking history found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
{{-- 
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </a>
                    <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </a>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium">{{ $bookingHistories->firstItem() }}</span> to
                            <span class="font-medium">{{ $bookingHistories->lastItem() }}</span> of
                            <span class="font-medium">{{ $bookingHistories->total() }}</span> results
                        </p>
                    </div>
                    <div>
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-admin>
