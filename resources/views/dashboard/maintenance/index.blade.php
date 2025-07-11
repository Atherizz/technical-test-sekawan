<x-admin>
    <main class="flex-1 overflow-y-auto p-6">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Maintenance Schedule Management</h1>
                <p class="text-gray-600">Manage your maintenance schedule and their details</p>
            </div>
            <a href="{{ route('maintenance_schedule.create') }}"
                class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Add Schedule
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
                                Maintenance ID</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vehicle</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Scheduled Date</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($maintenances as $maintenance)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">
                                    MNT-{{ str_pad($maintenance->id, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $maintenance->vehicle->license_plate ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $maintenance->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($maintenance->maintenance_date)->format('Y-m-d') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        switch ($maintenance->status) {
                                            case 'scheduled':
                                                $bg = 'bg-yellow-100';
                                                $text = 'text-yellow-800';
                                                $label = 'Scheduled';
                                                break;
                                            case 'completed':
                                                $bg = 'bg-green-100';
                                                $text = 'text-green-800';
                                                $label = 'Completed';
                                                break;
                                            default:
                                                $bg = 'bg-gray-100';
                                                $text = 'text-gray-800';
                                                $label = ucfirst($maintenance->status);
                                        }
                                    @endphp
                                    <span
                                        class="px-2 py-1 text-xs rounded-full {{ $bg }} {{ $text }}">
                                        {{ $label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('maintenance_schedule.edit', $maintenance->id) }}"
                                            class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('maintenance_schedule.destroy', $maintenance->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this schedule?')"
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
