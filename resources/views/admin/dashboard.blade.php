@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Overview</h1>
        <div class="btn-group">
            <button class="btn btn-outline-primary" id="today-btn">Hari Ini</button>
            <button class="btn btn-outline-primary" id="week-btn">Minggu Ini</button>
            <button class="btn btn-outline-primary" id="month-btn">Bulan Ini</button>
        </div>
    </div>
    
    <!-- Statistic Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card bg-gradient-primary">
                <div class="row">
                    <div class="col-8">
                        <h5 class="mb-0">Rp {{ number_format($totalSales, 0, ',', '.') }}</h5>
                        <p class="mb-0">Total Penjualan</p>
                    </div>
                    <div class="col-4 text-end">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card bg-gradient-success">
                <div class="row">
                    <div class="col-8">
                        <h5 class="mb-0">{{ number_format($totalOrders) }}</h5>
                        <p class="mb-0">Total Pesanan</p>
                    </div>
                    <div class="col-4 text-end">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card bg-gradient-info">
                <div class="row">
                    <div class="col-8">
                        <h5 class="mb-0">{{ number_format($totalUsers) }}</h5>
                        <p class="mb-0">Total Pengguna</p>
                    </div>
                    <div class="col-4 text-end">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card bg-gradient-warning">
                <div class="row">
                    <div class="col-8">
                        <h5 class="mb-0">{{ number_format($totalEbooks) }}</h5>
                        <p class="mb-0">Total E-Book</p>
                    </div>
                    <div class="col-4 text-end">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts -->
    <div class="row mb-4">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Grafik Penjualan 7 Hari Terakhir</h6>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="250"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Status Pesanan</h6>
                </div>
                <div class="card-body">
                    <canvas id="orderStatusChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Orders -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Pesanan Terbaru</h6>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kode Pesanan</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->order_code }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Top Selling E-Books -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">E-Book Terlaris</h6>
                </div>
                <div class="card-body">
                    @foreach($topEbooks as $ebook)
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('storage/' . $ebook->image) }}" alt="{{ $ebook->title }}" 
                             class="rounded" style="width: 60px; height: 80px; object-fit: cover;">
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-1">{{ Str::limit($ebook->title, 30) }}</h6>
                            <small class="text-muted">{{ $ebook->sales_count }} terjual</small>
                        </div>
                        <div class="text-end">
                            <strong>Rp {{ number_format($ebook->price, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: @json(array_column($salesData, 'date')),
            datasets: [{
                label: 'Penjualan (Rp)',
                data: @json(array_column($salesData, 'sales')),
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
    
    // Order Status Chart
    const statusCtx = document.getElementById('orderStatusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending', 'Processing', 'Cancelled'],
            datasets: [{
                data: [{{ $recentOrders->where('status', 'completed')->count() }},
                       {{ $recentOrders->where('status', 'pending')->count() }},
                       {{ $recentOrders->where('status', 'processing')->count() }},
                       {{ $recentOrders->where('status', 'cancelled')->count() }}],
                backgroundColor: [
                    '#10b981',
                    '#f59e0b',
                    '#3b82f6',
                    '#ef4444'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endpush
@endsection
