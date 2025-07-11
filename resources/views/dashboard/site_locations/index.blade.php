<x-admin>
    <main class="flex-1 overflow-y-auto p-6">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800"> Location Management</h1>
                <p class="text-gray-600">Manage your Locations and their details</p>
            </div>
            <a href="{{ route('site_location.create') }}"
                class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Add location Location
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
                                location ID</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Location Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Location Type</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Address</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($locations as $location)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">
                                    SITE-{{ str_pad($location->id, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $location->location_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ ucfirst(str_replace('_', ' ', $location->location_type)) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $location->address }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('site_location.edit', $location->id) }}"
                                            class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('site_location.destroy', $location->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this location?')"
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
                    </tbody>
                </table>
            </div>
    </main>
</x-admin>
