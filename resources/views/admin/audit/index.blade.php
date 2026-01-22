@extends('layouts.app')

<style>
@media print {
    /* Sembunyikan elemen yang tidak perlu saat dicetak */
    .btn, 
    .sidebar, 
    .navbar, 
    .breadcrumb, 
    .card-header,
    footer,
    #debug-icon-wrapper { 
        display: none !important; 
    }

    /* Atur agar tabel memenuhi halaman */
    .container-fluid, .card, .card-body {
        padding: 0 !important;
        margin: 0 !important;
        border: none !important;
    }

    table {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    th, td {
        border: 1px solid #000 !important; /* Paksa garis tabel jadi hitam */
        padding: 8px !important;
    }
}
</style>

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Audit Log</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Audit Log</li>
    </ol>

    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
    <div><i class="fas fa-history mr-1"></i> Riwayat Aktivitas Sistem</div>
    
    <div class="d-flex align-items-center" style="gap: 10px;">
        {{-- TOMBOL CETAK BROWSER --}}
        <button onclick="window.print()" class="btn btn-info btn-sm">
            <i class="fas fa-print"></i> Cetak Log
        </button>

        @if(auth()->id() == 1)
            <form action="{{ route('audit-log.clear') }}" method="POST" onsubmit="return confirm('Hapus semua log?')">
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Kosongkan Log
                </button>
            </form>
        @endif
    </div>
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
                            <th width="15%">Browser</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            {{-- Format Waktu Indonesia Tengah (WITA) --}}
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d/m/Y H:i') }}</td>
                            
                            <td>
                                <strong>{{ $log->user->nama ?? 'System' }}</strong><br>
                                <small class="text-muted">{{ $log->user->jabatan ?? '-' }}</small>
                            </td>
                            
                            <td>
                                @php
                                    // Pewarnaan otomatis berdasarkan jenis aktivitas
                                    $badgeColor = 'badge-info';
                                    if(str_contains(strtolower($log->aktivitas), 'hapus')) $badgeColor = 'badge-danger';
                                    if(str_contains(strtolower($log->aktivitas), 'tambah')) $badgeColor = 'badge-success';
                                    if(str_contains(strtolower($log->aktivitas), 'edit')) $badgeColor = 'badge-warning';
                                @endphp
                                <span class="badge {{ $badgeColor }}">{{ $log->aktivitas }}</span>
                            </td>
                            
                            <td>{{ $log->keterangan }}</td>
                            
                            <td>
                                <code class="text-primary">{{ $log->ip_address }}</code>
                            </td>
                            <td>
                                <code class="text-primary">{{ $log->browser }}</code>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Tidak ada data log yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Menampilkan Tombol Next/Previous (Pagination) --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection