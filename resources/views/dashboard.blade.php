<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-12 bg-[#121214] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-white">
                <div class="bg-[#1a1a1e] p-6 rounded-xl border border-zinc-800 shadow-lg">
                    <p class="text-sm text-zinc-400">Revenue</p>
                    <h3 class="text-3xl font-bold mt-2">$192,400</h3>
                    <p class="text-emerald-500 text-sm mt-2 flex items-center gap-1">12% increase ↑</p>
                </div>

                <div class="bg-[#1a1a1e] p-6 rounded-xl border border-zinc-800 shadow-lg">
                    <p class="text-sm text-zinc-400">New customers</p>
                    <h3 class="text-3xl font-bold mt-2">1,340</h3>
                    <p class="text-rose-500 text-sm mt-2 flex items-center gap-1">3% decrease ↓</p>
                </div>

                <div class="bg-[#1a1a1e] p-6 rounded-xl border border-zinc-800 shadow-lg">
                    <p class="text-sm text-zinc-400">New orders</p>
                    <h3 class="text-3xl font-bold mt-2">3,543</h3>
                    <p class="text-emerald-500 text-sm mt-2 flex items-center gap-1">7% increase ↑</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 text-white">
                <div class="bg-[#1a1a1e] p-6 rounded-xl border border-zinc-800 shadow-lg">
                    <h4 class="text-lg font-semibold mb-4">Revenue</h4>
                    <div class="h-72">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="bg-[#1a1a1e] p-6 rounded-xl border border-zinc-800 shadow-lg">
                    <h4 class="text-lg font-semibold mb-4">Orders per month</h4>
                    <div class="h-72">
                        <canvas id="ordersChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Menggunakan json_encode agar aman dari bug parsing array multi-line di Blade
        const months = {!! json_encode($months ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']) !!};
        const revenueData = {!! json_encode($revenueData ?? [12200, 14800, 13100, 16100, 15300, 17800, 19100, 21300, 18800, 22000, 24800, 26200]) !!};
        const ordersData = {!! json_encode($ordersData ?? [230, 285, 310, 265, 340, 395, 420, 375, 460, 500, 488, 530]) !!};

        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { color: '#a1a1aa' } },
                y: { grid: { color: '#27272a' }, ticks: { color: '#a1a1aa' } }
            }
        };

        // Render Grafik Garis (Revenue)
        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    data: revenueData,
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.05)',
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#f59e0b'
                }]
            },
            options: chartOptions
        });

        // Render Grafik Batang (Orders)
        new Chart(document.getElementById('ordersChart'), {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    data: ordersData,
                    backgroundColor: '#f59e0b',
                    borderRadius: 4
                }]
            },
            options: chartOptions
        });
    </script>
</x-app-layout>