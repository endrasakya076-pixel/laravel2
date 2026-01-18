{{-- @section('content')
<div class="container-fluid">
    {{-- Header Dashboard --}}
    {{-- <div class="row">
        <div class="col-lg-12">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4 shadow-sm">
                <li class="breadcrumb-item active">
                    <i class="fas fa-user-circle mr-1"></i> Selamat Datang, {{ Auth::user()->nama }}
                </li>
            </ol>
        </div>
    </div> --}}

    {{-- Widget Ringkasan (Opsional - Contoh Statistik) --}}
    {{-- <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Status Anda</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{-- {{ auth()->id() == 1 ? 'Super Admin' : 'Admin' }} --}}
                            {{-- </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- Tabel Log Aktivitas - Hanya muncul untuk Admin 1 --}}
    {{-- @if(auth()->id() == 1) --}}
    {{-- <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white d-flex align-items-center">
            <i class="fas fa-history mr-2"></i>
            <h6 class="m-0 font-weight-bold">Log Aktivitas Admin (Terbaru)</h6>
        </div>
        <div class="card-body p-0"> {{-- p-0 agar tabel penuh ke pinggir card --}}
            {{-- <div class="table-responsive">
                <table class="table table-hover table-striped mb-0" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th class="px-4">Waktu</th>
                            <th>Nama Admin</th>
                            <th>Aktivitas</th>
                            <th>Keterangan</th>
                            <th>IP Address</th>
                        </tr>
                    </thead>
                    <tbody> --}}
                        {{-- @forelse($logs as $log)
                        <tr> --}}
                            {{-- <td class="px-4">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge badge-light p-2">
                                    <i class="fas fa-user mr-1"></i> {{ $log->user->nama ?? 'System' }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $badgeColor = 'info';
                                    if(str_contains(strtolower($log->aktivitas), 'hapus')) $badgeColor = 'danger';
                                    if(str_contains(strtolower($log->aktivitas), 'tambah')) $badgeColor = 'success';
                                @endphp
                                <span class="badge badge-{{ $badgeColor }}">{{ $log->aktivitas }}</span>
                            </td>
                            <td>{{ $log->keterangan }}</td>
                            <td>
                                <code class="small text-muted">{{ $log->ip_address }}</code>
                            </td> --}}
                        {{-- </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="50" class="mb-3 opacity-50">
                                <p class="text-muted">Belum ada aktivitas tercatat.</p>
                            </td>
                        </tr>
                        @endforelse --}}
                    {{-- </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted font-italic">
            * Menampilkan 50 aktivitas terbaru secara otomatis.
        </div>
    </div> --}}
    {{-- @endif --}}
{{-- </div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Audit Log</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Audit Log</li>
    </ol>

    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <div><i class="fas fa-history mr-1"></i> Riwayat Aktivitas Sistem</div>
            @if(auth()->id() == 1)
                <form action="{{ route('audit.clear') }}" method="POST" onsubmit="return confirm('Hapus semua log?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Kosongkan Log</button>
                </form>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Waktu</th>
                            <th>Admin</th>
                            <th>Aktivitas</th>
                            <th>Keterangan</th>
                            <th>IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                            <td><strong>{{ $log->user->nama ?? 'System' }}</strong></td>
                            <td>
                                <span class="badge badge-info">{{ $log->aktivitas }}</span>
                            </td>
                            <td>{{ $log->keterangan }}</td>
                            <td><small class="text-muted">{{ $log->ip_address }}</small></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data log.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $logs->links() }} {{-- Navigasi Halaman --}}
            </div>
        </div>
    </div>
</div>
@endsection