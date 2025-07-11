<x-admin>
    <main class="flex-1 overflow-y-auto p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Add New Location</h1>
            <p class="text-gray-600">Fill in the form below to add a new site location</p>
        </div>

        <form action="{{ route('site_location.store') }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-6">
            @csrf

            <div>
                <label for="location_name" class="block text-sm font-medium text-gray-700">Location Name</label>
                <input type="text" name="location_name" id="location_name" value="{{ old('location_name') }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                @error('location_name')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="location_type" class="block text-sm font-medium text-gray-700">Location Type</label>
                <select name="location_type" id="location_type" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    <option value="head_office">Head Office</option>
                    <option value="branch">Branch</option>
                    <option value="mine">Mine</option>
                    
                </select>
                @error('location_type')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="address" id="address" rows="3" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('site_location.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 text-sm">Save Location</button>
            </div>
        </form>
    </main>
</x-admin>
