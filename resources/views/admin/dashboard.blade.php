<x-admin>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        <div class="minimal-card bg-white p-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Kendaraan</p>
                    <h3 class="text-2xl font-semibold mt-1">42</h3>
                </div>
                <div class="text-primary-500">
                    <i class="fas fa-truck text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100">
                <p class="text-xs text-gray-500"><span class="text-green-500">+2</span> dari bulan lalu</p>
            </div>
        </div>

        <div class="minimal-card bg-white p-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Sedang Beroperasi</p>
                    <h3 class="text-2xl font-semibold mt-1">28</h3>
                </div>
                <div class="text-blue-500">
                    <i class="fas fa-road text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100">
                <p class="text-xs text-gray-500"><span class="text-green-500">67%</span> dari total</p>
            </div>
        </div>

        <div class="minimal-card bg-white p-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Perlu Perawatan</p>
                    <h3 class="text-2xl font-semibold mt-1">5</h3>
                </div>
                <div class="text-yellow-500">
                    <i class="fas fa-tools text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100">
                <p class="text-xs text-gray-500"><span class="text-red-500">+1</span> dari kemarin</p>
            </div>
        </div>

        <div class="minimal-card bg-white p-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Tersedia</p>
                    <h3 class="text-2xl font-semibold mt-1">9</h3>
                </div>
                <div class="text-green-500">
                    <i class="fas fa-parking text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100">
                <p class="text-xs text-gray-500"><span class="text-green-500">21%</span> dari total</p>
            </div>
        </div>
    </div>

    <!-- Peta dan Aktivitas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
        <!-- Peta -->
        <div class="minimal-card bg-white p-5 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold">Pelacakan Langsung</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-xs bg-primary-50 text-primary-700 rounded">Hari Ini</button>
                    <button class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded">Minggu Ini</button>
                </div>
            </div>
            <div class="bg-gray-100 rounded-lg h-64 flex items-center justify-center">
                <div class="text-center">
                    <i class="fas fa-map-marked-alt text-4xl text-gray-400 mb-2"></i>
                    <p class="text-gray-500">Peta pelacakan kendaraan</p>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terkini -->
        <div class="minimal-card bg-white p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold">Aktivitas Terkini</h3>
                <button class="text-xs text-primary-600 hover:text-primary-800">Lihat Semua</button>
            </div>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-full mr-3">
                        <i class="fas fa-car text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">Kendaraan B 1234 CD mulai operasi</p>
                        <p class="text-xs text-gray-500">10 menit yang lalu</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="p-2 bg-yellow-50 text-yellow-600 rounded-full mr-3">
                        <i class="fas fa-exclamation-triangle text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">Perawatan rutin untuk B 5678 EF</p>
                        <p class="text-xs text-gray-500">35 menit yang lalu</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="p-2 bg-green-50 text-green-600 rounded-full mr-3">
                        <i class="fas fa-check-circle text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">Pengiriman selesai - B 9012 GH</p>
                        <p class="text-xs text-gray-500">2 jam yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Kendaraan -->
    <div class="minimal-card bg-white p-5">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold">Daftar Kendaraan</h3>
            <div class="flex space-x-3">
                <button class="px-3 py-2 border border-gray-300 rounded text-sm hover:bg-gray-50 flex items-center">
                    <i class="fas fa-filter mr-2"></i>
                    <span>Filter</span>
                </button>
                <button
                    class="px-3 py-2 bg-primary-600 text-white rounded text-sm hover:bg-primary-700 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah</span>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.
                            Polisi</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lokasi</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">B 1234 CD</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">Truk Box</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Beroperasi</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">Jl. Sudirman, Jakarta</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Baris lainnya... -->
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
            <div>Menampilkan 1-5 dari 42 kendaraan</div>
            <div class="flex space-x-2">
                <button class="w-8 h-8 flex items-center justify-center border rounded hover:bg-gray-50">1</button>
                <button
                    class="w-8 h-8 flex items-center justify-center border rounded bg-primary-600 text-white hover:bg-primary-700">2</button>
                <button class="w-8 h-8 flex items-center justify-center border rounded hover:bg-gray-50">3</button>
                <button class="w-8 h-8 flex items-center justify-center border rounded hover:bg-gray-50">→</button>
            </div>
        </div>
    </div>
</x-admin>
