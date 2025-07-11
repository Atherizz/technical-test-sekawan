<x-admin>
    <main class="flex-1 overflow-y-auto p-6">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Driver Management</h1>
                <p class="text-gray-600">Manage your drivers and their details</p>
            </div>
            <a
                href="{{ route('drivers.create') }}"class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Add Driver
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
                                Driver ID</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Phone</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($drivers as $driver)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">
                                    DRV-{{ str_pad($driver->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $driver->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $driver->phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        switch ($driver->status) {
                                            case 'on_duty':
                                                $bg = 'bg-blue-100';
                                                $text = 'text-blue-800';
                                                $label = 'On Duty';
                                                break;
                                            case 'off_duty':
                                                $bg = 'bg-gray-100';
                                                $text = 'text-gray-800';
                                                $label = 'Off Duty';
                                                break;
                                            case 'inactive':
                                                $bg = 'bg-red-100';
                                                $text = 'text-red-800';
                                                $label = 'Inactive';
                                                break;
                                            default:
                                                $bg = 'bg-yellow-100';
                                                $text = 'text-yellow-800';
                                                $label = ucfirst($driver->status);
                                        }
                                    @endphp
                                    <span
                                        class="px-2 py-1 text-xs rounded-full {{ $bg }} {{ $text }}">
                                        {{ $label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('drivers.edit', $driver->id) }}"
                                            class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this driver?')"
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
