<x-admin>
    <main class="flex-1 overflow-y-auto p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Maintenance Schedule</h1>
            <p class="text-gray-600">Update the details of the scheduled maintenance</p>
        </div>

        <form action="{{ route('maintenance_schedule.update', $maintenance->id) }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Vehicle</label>
                <select name="vehicle_id" id="vehicle_id" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    <option value="">-- Select Vehicle --</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $maintenance->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->license_plate }}
                        </option>
                    @endforeach
                </select>
                @error('vehicle_id')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Type / Description</label>
                <input type="text" name="description" id="description"
                    value="{{ old('description', $maintenance->description) }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                @error('description')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="maintenance_date" class="block text-sm font-medium text-gray-700">Scheduled Date</label>
                <input type="date" name="maintenance_date" id="maintenance_date"
                    value="{{ old('maintenance_date', $maintenance->maintenance_date) }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                @error('maintenance_date')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    <option value="scheduled" {{ old('status', $maintenance->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="completed" {{ old('status', $maintenance->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('maintenance_schedule.index') }}"
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm">
                    Cancel
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 text-sm">
                    Update Schedule
                </button>
            </div>
        </form>
    </main>
</x-admin>
