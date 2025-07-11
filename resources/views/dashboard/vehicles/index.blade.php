<x-admin>
    <style></style>
    <main class="flex-1 overflow-y-auto p-6">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Vehicle Management</h1>
                <p class="text-gray-600">Manage your fleet vehicles and their details</p>
            </div>
            <a href="{{ route('vehicles.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Add Vehicle
            </a>
        </div>

        <!-- Vehicle Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                License Plate</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Brand</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vehicle Type</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Site Location</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ownership Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rental Vendor</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Maintenance</th> --}}
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($vehicles as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $item->license_plate }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->brand }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->vehicle_type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->siteLocation->location_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->ownership_status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ optional($item->rentalVendor)->vendor_name ?? '-' }}</td>
                                @php
                                    switch ($item->operational_status) {
                                        case 'active':
                                            $bg = 'bg-green-100';
                                            $text = 'text-green-800';
                                            break;
                                        case 'inactive':
                                            $bg = 'bg-gray-100';
                                            $text = 'text-gray-800';
                                            break;
                                        case 'in_service':
                                            $bg = 'bg-yellow-100';
                                            $text = 'text-yellow-800';
                                            break;
                                        default:
                                            $bg = 'bg-red-100';
                                            $text = 'text-red-800';
                                    }
                                @endphp

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full {{ $bg }} {{ $text }}">
                                        {{ ucfirst(str_replace('_', ' ', $item->operational_status)) }}
                                    </span>
                                </td>

  <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('vehicles.edit', $item->id) }}"
                                            class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('vehicles.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this vehicle?')"
                                            style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More rows... -->
                    </tbody>
                </table>
            </div>

            {{ $vehicles->links() }}

        </div>
        </div>
        </div>
        </div>
    </main>
</x-admin>
