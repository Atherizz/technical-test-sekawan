<x-admin>
          <main class="flex-1 overflow-y-auto p-6">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Driver Management</h1>
                    <p class="text-gray-600">Manage your drivers and their details</p>
                </div>
                <button class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Add Driver
                </button>
            </div>

            <!-- Vehicle Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Driver ID</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>
<tbody class="bg-white divide-y divide-gray-200">
    @foreach ($drivers as $driver)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap font-medium">DRV-{{ str_pad($driver->id, 3, '0', STR_PAD_LEFT) }}</td>
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
                <span class="px-2 py-1 text-xs rounded-full {{ $bg }} {{ $text }}">
                    {{ $label }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <button class="text-blue-600 hover:text-blue-900 mr-3">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="text-red-600 hover:text-red-900">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
</tbody>

</table>
                </div>
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </a>
                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">42</span> results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a href="#" aria-current="page" class="z-10 bg-primary-50 border-primary-500 text-primary-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 1 </a>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 2 </a>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 3 </a>
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </main>    
</x-admin>