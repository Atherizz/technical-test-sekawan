<x-admin>
    <main class="flex-1 overflow-y-auto p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Add New Driver</h1>
            <p class="text-gray-600">Fill in the form below to add a new driver</p>
        </div>

        <form action="{{ route('drivers.store') }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-6">
            @csrf

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="mt-1 block w-full border-gray-300 bg-gray-50 focus:bg-white rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                @error('name')
                    <div class="alert alert-danger">
                        <p style="color: red; font-style: italic">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            {{-- Phone --}}
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                    class="mt-1 block w-full border-gray-300 bg-gray-50 focus:bg-white rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                @error('phone')
                    <div class="alert alert-danger">
                        <p style="color: red; font-style: italic">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" required
                    class="mt-1 block w-full border-gray-300 bg-gray-50 focus:bg-white rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    <option value="on_duty" {{ old('status') == 'on_duty' ? 'selected' : '' }}>On Duty</option>
                    <option value="off_duty" {{ old('status') == 'off_duty' ? 'selected' : '' }}>Off Duty</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="alert alert-danger">
                        <p style="color: red; font-style: italic">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('drivers.index') }}"
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 text-sm">Cancel</a>
                <button type="submit"
                    class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 text-sm">Save Driver</button>
            </div>
        </form>
    </main>
</x-admin>
