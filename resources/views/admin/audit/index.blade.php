@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Audit Log</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Audit Log</li>
    </ol>

    {{-- Form Filter --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('audit-log.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Cari Nama/Aktivitas</label>
                    <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <div><i class="fas fa-history mr-1"></i> Riwayat Aktivitas Sistem</div>
            @if(auth()->id() == 1)
                <form action="{{ route('audit-log.clear') }}" method="POST" onsubmit="return confirm('Hapus semua log?')">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Kosongkan Log</button>
                </form>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="15%">Waktu (WITA)</th>
                            <th width="15%">User</th>
                            <th width="15%">Aktivitas</th>
                            <th>Keterangan</th>
                            <th width="15%">IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d/m/Y H:i') }}</td>
                            <td>
                                <strong>{{ $log->user->nama ?? 'System' }}</strong><br>
                                <small class="text-muted">{{ $log->user->jabatan ?? '-' }}</small>
                            </td>
                            <td>
                                @php
                                    $badgeColor = 'badge-info';
                                    if(str_contains(strtolower($log->aktivitas), 'hapus')) $badgeColor = 'badge-danger';
                                    if(str_contains(strtolower($log->aktivitas), 'tambah')) $badgeColor = 'badge-success';
                                    if(str_contains(strtolower($log->aktivitas), 'edit')) $badgeColor = 'badge-warning';
                                @endphp
                                <span class="badge {{ $badgeColor }}">{{ $log->aktivitas }}</span>
                            </td>
                            <td>{{ $log->keterangan }}</td>
                            <td><code class="text-primary">{{ $log->ip_address }}</code></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Data tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Tombol Next/Previous dengan tetap membawa parameter filter --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $logs->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection