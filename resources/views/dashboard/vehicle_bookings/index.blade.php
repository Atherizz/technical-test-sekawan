<x-admin>
    <main class="flex-1 overflow-y-auto p-6">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Vehicle Booking Management</h1>
                <p class="text-gray-600">Manage your Vehicle Booking and their details</p>
            </div>
            <!-- Filter Status -->
            <div>
                <label for="status-filter" class="mr-2 text-sm font-medium text-gray-700">Filter Status:</label>
                <select id="status-filter" name="status" class="border-gray-300 rounded-md shadow-sm text-sm">
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="approved_1">Approved Level 1</option>
                    <option value="approved_2">Approved Level 2</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>

        <!-- Vehicle Table -->
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
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
                                <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                    <!-- Tombol Approve -->
                                    <form action="" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-full">
                                            <i class="fas fa-check mr-1"></i> Approve
                                        </button>
                                    </form>

                                    <!-- Tombol Reject -->
                                    <form action="" method="POST"
                                        onsubmit="return confirm('Are you sure you want to reject this booking?')">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-full">
                                            <i class="fas fa-times mr-1"></i> Reject
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-admin>
