<x-admin>
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

    <main class="flex-1 overflow-y-auto p-6">
        <div class="mb-6 flex flex-wrap justify-between items-start gap-y-2">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Vehicle Booking Management</h1>
                <p class="text-gray-600">Manage your Vehicle Booking and their details</p>
            </div>

            <div class="text-sm flex flex-wrap items-center gap-2">
                <label class="font-medium text-gray-700">Filter Status:</label>
                <a href="?status=" class="px-3 py-1 rounded-md border border-gray-300 hover:bg-gray-100">All</a>
                <a href="?status=pending"
                    class="px-3 py-1 rounded-md border border-gray-300 hover:bg-yellow-100 text-yellow-700">Pending</a>
                <a href="?status=approved_1"
                    class="px-3 py-1 rounded-md border border-gray-300 hover:bg-green-100 text-green-700">Approved Level
                    1</a>
                <a href="?status=approved_2"
                    class="px-3 py-1 rounded-md border border-gray-300 hover:bg-green-200 text-green-800">Approved Level
                    2</a>

                <a href="/admin/dashboard/vehicle_booking/export/excel"
                    class="ml-auto px-4 py-2 rounded-md bg-primary-600 text-white hover:bg-primary-700 text-sm flex items-center">
                    <i class="fas fa-file-excel mr-2"></i> Export Excel
                </a>
            </div>
        </div>


        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Booking ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Renter</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vehicle</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Driver</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Departure Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Purpose</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            @can('superior')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">
                                    BOOK-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $booking->user->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $booking->vehicle->license_plate ?? '-' }}
                                    ({{ $booking->vehicle->brand ?? '-' }})
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $booking->driver->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $booking->departure_time }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $booking->purpose }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        switch ($booking->status) {
                                            case 'pending':
                                                $badge = ['bg-yellow-100', 'text-yellow-800', 'Pending'];
                                                break;
                                            case 'approved_1':
                                                $badge = ['bg-green-100', 'text-green-800', 'Approved Lv.1'];
                                                break;
                                            case 'approved_2':
                                                $badge = ['bg-green-200', 'text-green-900', 'Approved Lv.2'];
                                                break;
                                            case 'rejected':
                                                $badge = ['bg-red-100', 'text-red-800', 'Rejected'];
                                                break;
                                            default:
                                                $badge = ['bg-gray-100', 'text-gray-800', ucfirst($booking->status)];
                                        }
                                    @endphp
                                    <span
                                        class="px-2 py-1 text-xs rounded-full {{ $badge[0] }} {{ $badge[1] }}">
                                        {{ $badge[2] }}
                                    </span>
                                </td>
                                @can('manager')
                                    @if ($booking->status === 'pending')
                                        <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                            <form action="{{ route('bookings.approve.level1', $booking->id) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-full">
                                                    <i class="fas fa-check mr-1"></i> Approve L1
                                                </button>
                                            </form>

                                            <form action="{{ route('vehicle_booking.destroy', $booking->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to reject and remove this booking?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-full">
                                                    <i class="fas fa-times mr-1"></i> Reject
                                                </button>
                                            </form>

                                        </td>
                                    @endif
                                @endcan

                                @can('supervisor')
                                    @if ($booking->status === 'approved_1')
                                        <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                            <form action="{{ route('bookings.approve.level2', $booking->id) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-full">
                                                    <i class="fas fa-check mr-1"></i> Approve L2
                                                </button>
                                            </form>
                                            <form action="{{ route('vehicle_booking.destroy', $booking->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to reject and remove this booking?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-full">
                                                    <i class="fas fa-times mr-1"></i> Reject
                                                </button>
                                            </form>

                                        </td>
                                    @endif
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-admin>
