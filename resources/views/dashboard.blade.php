<x-app-layout>
    @php
        $types = [
            'success' => 'green',
            'error' => 'red',
        ];
    @endphp

    @foreach ($types as $type => $color)
        @if (session($type))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
                class="flex items-center justify-between p-4 mb-4 text-sm text-{{ $color }}-800 rounded-lg bg-{{ $color }}-100"
                role="alert">
                <div class="flex items-center">
                    @if ($type === 'success')
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    @else
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    @endif
                    {{ session($type) }}
                </div>
                <button @click="show = false" class="text-{{ $color }}-800 hover:text-{{ $color }}-900">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        @endif
    @endforeach

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <!-- Active Booking -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">📅 Active Booking Status</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Booking ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vehicle</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Schedule</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Approval</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Driver</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($vehicleBooking as $booking)
                            <tr>
                                <td class="px-6 py-4 font-medium">
                                    BOOK-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4">{{ $booking->vehicle->brand }}</td>
                                <td class="px-6 py-4">
                                    <div>{{ $booking->departure_time }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 mr-2">{{ $booking->status }}</span>
                                        <span class="text-xs text-gray-500">Supervisor</span>
                                    </div>

                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-blue-600 font-medium">{{ $booking->driver->name ?? '-' }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Booking History -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">📄 My Booking History</h2>
                <div class="flex mb-4 space-x-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Status</label>
                        <select class="border border-gray-300 rounded-md px-3 py-1 text-sm">
                            <option>All</option>
                            <option>Pending</option>
                            <option>Approved</option>
                            <option>Rejected</option>
                            <option>Completed</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                        <input type="month" class="border border-gray-300 rounded-md px-3 py-1 text-sm"
                            value="2023-11">
                    </div>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Booking ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vehicle</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Purpose</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($bookingHistory as $history)
                            <tr>
                                <td class="px-6 py-4 font-medium">
                                    BOOK-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $history->vehicleBooking->vehicle->brand ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $history->vehicleBooking->departure_time }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $history->vehicleBooking->purpose ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full 
                            {{ $history->vehicleBooking->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst(str_replace('_', ' ', $history->vehicleBooking->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="text-blue-600 hover:text-blue-900 mr-2" title="View Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900" title="Delete History">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="mt-4 flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Showing 1 to 5 of 12 entries
                    </div>
                    <div class="flex space-x-1">
                        <button class="px-3 py-1 border rounded-md text-sm">Previous</button>
                        <button class="px-3 py-1 border rounded-md bg-blue-600 text-white text-sm">1</button>
                        <button class="px-3 py-1 border rounded-md text-sm">2</button>
                        <button class="px-3 py-1 border rounded-md text-sm">Next</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
