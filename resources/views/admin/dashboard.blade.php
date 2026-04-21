@extends('admin.includes.main')
@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0"><strong>Admin</strong> Dashboard</h1>
            <span class="text-muted">{{ \Carbon\Carbon::now()->format('l, d M Y') }}</span>
        </div>

        {{-- Stat Cards --}}
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 small text-uppercase fw-semibold">Total Orders</p>
                            <h3 class="mb-0 fw-bold">{{ $totalOrders }}</h3>
                        </div>
                        <div class="ms-3 p-3 rounded-circle bg-primary bg-opacity-10">
                            <i data-feather="shopping-bag" class="text-primary" style="width:24px;height:24px;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 small text-uppercase fw-semibold">Total Revenue</p>
                            <h3 class="mb-0 fw-bold">Rs. {{ number_format($totalRevenue, 2) }}</h3>
                        </div>
                        <div class="ms-3 p-3 rounded-circle bg-success bg-opacity-10">
                            <i data-feather="dollar-sign" class="text-success" style="width:24px;height:24px;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 small text-uppercase fw-semibold">Total Products</p>
                            <h3 class="mb-0 fw-bold">{{ $totalProducts }}</h3>
                        </div>
                        <div class="ms-3 p-3 rounded-circle bg-warning bg-opacity-10">
                            <i data-feather="box" class="text-warning" style="width:24px;height:24px;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 small text-uppercase fw-semibold">Total Customers</p>
                            <h3 class="mb-0 fw-bold">{{ $totalUsers }}</h3>
                        </div>
                        <div class="ms-3 p-3 rounded-circle bg-info bg-opacity-10">
                            <i data-feather="users" class="text-info" style="width:24px;height:24px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Charts Row --}}
        <div class="row">
            {{-- Monthly Revenue Chart --}}
            <div class="col-xl-8 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                        <h5 class="card-title mb-0 fw-semibold">Monthly Revenue</h5>
                        <p class="text-muted small mb-0">Last 6 months</p>
                    </div>
                    <div class="card-body px-4">
                        <canvas id="revenueChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            {{-- Order Status Pie --}}
            <div class="col-xl-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                        <h5 class="card-title mb-0 fw-semibold">Order Status</h5>
                        <p class="text-muted small mb-0">Breakdown by status</p>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center px-4">
                        <canvas id="statusChart" height="200"></canvas>
                        <div class="mt-3 w-100">
                            @foreach($orderStatus as $s)
                            <div class="d-flex justify-content-between mb-1 small">
                                <span class="text-capitalize">{{ $s->status }}</span>
                                <strong>{{ $s->count }}</strong>
                            </div>
                            @endforeach
                            @if($orderStatus->isEmpty())
                                <p class="text-muted text-center small">No orders yet</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Orders --}}
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0 fw-semibold">Recent Orders</h5>
                            <p class="text-muted small mb-0">Latest 7 orders</p>
                        </div>
                        <a href="{{ route('order.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4 py-3">Order #</th>
                                        <th class="py-3">Customer</th>
                                        <th class="py-3">Date</th>
                                        <th class="py-3">Amount</th>
                                        <th class="py-3">Payment</th>
                                        <th class="py-3">Status</th>
                                        <th class="py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentOrders as $order)
                                    <tr>
                                        <td class="px-4 py-3 fw-semibold">{{ $order->order_number }}</td>
                                        <td class="py-3">{{ $order->first_name }} {{ $order->last_name }}</td>
                                        <td class="py-3 text-muted small">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="py-3 fw-semibold">Rs. {{ number_format($order->total_amount, 2) }}</td>
                                        <td class="py-3">
                                            @if($order->payment_status === 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($order->payment_status) }}</span>
                                            @endif
                                        </td>
                                        <td class="py-3">
                                            @php
                                                $statusColors = [
                                                    'process'   => 'warning',
                                                    'delivered' => 'success',
                                                    'cancel'    => 'danger',
                                                    'new'       => 'info',
                                                ];
                                                $color = $statusColors[$order->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $color }}">{{ ucfirst($order->status) }}</span>
                                        </td>
                                        <td class="py-3">
                                            <a href="{{ route('order.show', $order->id) }}" class="btn btn-sm btn-outline-secondary">
                                                <i data-feather="eye" style="width:14px;height:14px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">No orders found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Monthly Revenue Chart
    const revenueLabels = @json($monthlyRevenue->pluck('month'));
    const revenueData   = @json($monthlyRevenue->pluck('revenue'));

    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: revenueLabels.length ? revenueLabels : ['No Data'],
            datasets: [{
                label: 'Revenue (Rs.)',
                data: revenueData.length ? revenueData : [0],
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1,
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Order Status Pie Chart
    const statusLabels = @json($orderStatus->pluck('status')->map(fn($s) => ucfirst($s)));
    const statusData   = @json($orderStatus->pluck('count'));
    const statusColors = ['#3b82f6','#22c55e','#f59e0b','#ef4444','#8b5cf6','#06b6d4'];

    if (statusData.length) {
        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusData,
                    backgroundColor: statusColors.slice(0, statusData.length),
                    borderWidth: 2,
                    borderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                cutout: '65%',
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12, padding: 16 } }
                }
            }
        });
    } else {
        document.getElementById('statusChart').parentElement.innerHTML =
            '<p class="text-muted text-center small py-4">No order data yet</p>';
    }

    // Re-init feather icons
    feather.replace();
});
</script>
@endpush

@endsection
