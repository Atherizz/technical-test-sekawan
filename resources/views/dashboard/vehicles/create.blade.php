<x-admin>
    <main class="flex-1 overflow-y-auto p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Add New Vehicle</h1>
            <p class="text-gray-600">Fill in the form below to add a new vehicle</p>
        </div>

        <form action="{{ route('vehicles.store') }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-6">
            @csrf

            <div>
                <label for="license_plate" class="block text-sm font-medium text-gray-700">License Plate</label>
                <input type="text" name="license_plate" id="license_plate" value="{{ old('license_plate') }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                @error('license_plate')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                <input type="text" name="brand" id="brand" value="{{ old('brand') }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                @error('brand')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="vehicle_type" class="block text-sm font-medium text-gray-700">Vehicle Type</label>
                <select name="vehicle_type" id="vehicle_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        <option value="passenger">Passenger</option>
                        <option value="cargo">Cargo</option>
                   
                </select>
                @error('vehicle_type')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="site_location_id" class="block text-sm font-medium text-gray-700">Site Location</label>
                <select name="site_location_id" id="site_location_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    @foreach ($siteLocations as $location)
                        <option value="{{ $location->id }}" {{ old('site_location_id') == $location->id ? 'selected' : '' }}>{{ $location->location_name }}</option>
                    @endforeach
                </select>
                @error('site_location_id')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="ownership_status" class="block text-sm font-medium text-gray-700">Ownership Status</label>
                <select name="ownership_status" id="ownership_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    <option value="company owned" {{ old('ownership_status') == 'company owned' ? 'selected' : '' }}>Company Owned</option>
                    <option value="rented" {{ old('ownership_status') == 'rented' ? 'selected' : '' }}>Rented</option>
                </select>
                @error('ownership_status')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="rental_vendor_id" class="block text-sm font-medium text-gray-700">Rental Vendor (optional)</label>
                <select name="rental_vendor_id" id="rental_vendor_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    <option value="">-- None --</option>
                    @foreach ($rentalVendors as $vendor)
                        <option value="{{ $vendor->id }}" {{ old('rental_vendor_id') == $vendor->id ? 'selected' : '' }}>{{ $vendor->vendor_name }}</option>
                    @endforeach
                </select>
                @error('rental_vendor_id')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="operational_status" class="block text-sm font-medium text-gray-700">Operational Status</label>
                <select name="operational_status" id="operational_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="in_service">In Service</option>
                </select>
                @error('operational_status')
                    <p class="text-red-500 italic text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('vehicles.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 text-sm">Save Vehicle</button>
            </div>
        </form>
    </main>
</x-admin>
