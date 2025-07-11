<aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
    <!-- Logo -->
    <div class="p-4 border-b border-gray-200">
        <div class="flex items-center space-x-2 text-primary-700">
            <i class="fas fa-truck-moving text-2xl"></i>
            <h1 class="text-xl font-bold">PinjamMobil</h1>
        </div>
    </div>

    <!-- Menu -->
    <nav class="flex-1 overflow-y-auto p-4">
        <div class="mb-8">
            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">DASHBOARD</h3>
            <ul class="space-y-1">
                <li>
                    <a href="/admin/dashboard"
                        class="flex items-center space-x-3 p-3 rounded-lg bg-primary-50 text-primary-700 font-medium">
                        <i class="fas fa-chart-pie w-5"></i>
                        <span>Overview</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="mb-8">
            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">MANAGEMENT</h3>
            <ul class="space-y-1">
                <li>
                    <a href="/admin/dashboard/vehicles"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                        <i class="fas fa-car w-5"></i>
                        <span>Vehicle</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/dashboard/drivers"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                        <i class="fas fa-users w-5"></i>
                        <span>Driver</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/dashboard/site_location"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                        <i class="fas fa-map-marker-alt w-5"></i>
                        <span>Site Location</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/dashboard/vehicle_booking"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                        <i class="fas fa-calendar-check w-5"></i>
                        <span>Vehicle Booking</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/dashboard/maintenance_schedule"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                        <i class="fas fa-tools w-5"></i>
                        <span>Maintenance Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/dashboard/booking_history"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                        <i class="fas fa-clock w-5"></i>
                        <span>Booking History</span>
                    </a>
                </li>

            </ul>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">OTHER</h3>
            <ul class="space-y-1">
                <li>
                    <a href="#"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                        <i class="fas fa-cog w-5"></i>
                        <span>Setting</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                        <i class="fas fa-home w-5"></i>
                        <span>Back to Home</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Profile -->
    <div class="p-4 border-t border-gray-200">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-700">
                <span>AD</span>
            </div>
            <div>
                <p class="font-medium text-sm">{{ auth()->User()->name }}</p>
                <p class="text-xs text-gray-500">{{ auth()->User()->email }}</p>
            </div>
        </div>
    </div>
</aside>
