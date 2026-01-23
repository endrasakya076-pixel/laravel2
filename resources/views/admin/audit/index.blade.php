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
                
                <button onclick="window.print()" class="btn btn-info btn-sm">
                <i class="fas fa-print"></i> Cetak Log
                </button>
             
                {{-- TOMBOL KOSONGKAN LOG (Hanya Admin ID 1) --}}
                @if(auth()->id() == 1)
                    <form action="{{ route('audit-log.clear') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua log? Tindakan ini tidak dapat dibatalkan.')" class="m-0">
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
                            <th width="12%">Waktu (WITA)</th>
                            <th width="15%">User</th>
                            <th width="12%">Aktivitas</th>
                            <th>Keterangan</th>
                            <th width="10%">IP Address</th>
                            <th width="18%">Browser</th>
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
        $aktivitas = strtolower($log->aktivitas);
        $badgeColor = 'badge-info'; // Warna default (biru muda)

        // Deteksi Bahaya / Penghapusan
        if(str_contains($aktivitas, 'hapus')) {
            $badgeColor = 'badge-danger'; 
        }
        // Deteksi Penambahan / Keberhasilan / Persetujuan
        elseif(str_contains($aktivitas, 'tambah') || str_contains($aktivitas, 'berhasil') || str_contains($aktivitas, 'disetujui')) {
            $badgeColor = 'badge-success';
        }
        // Deteksi Perubahan / Penolakan
        elseif(str_contains($aktivitas, 'edit') || str_contains($aktivitas, 'update') || str_contains($aktivitas, 'ditolak')) {
            $badgeColor = 'badge-warning';
        }
        // Deteksi Verifikasi Spesimen (Warna Biru Utama)
        elseif(str_contains($aktivitas, 'sesuai')) {
            $badgeColor = 'badge-primary';
        }
    @endphp
    <span class="badge {{ $badgeColor }} px-2 py-1 shadow-sm">
        <i class="fas {{ str_contains($aktivitas, 'hapus') ? 'fa-trash' : (str_contains($aktivitas, 'sesuai') ? 'fa-check-double' : 'fa-info-circle') }} mr-1"></i>
        {{ $log->aktivitas }}
    </span>
</td>
                            <td>{{ $log->keterangan }}</td>
                            <td><code class="text-primary">{{ $log->ip_address }}</code></td>
                            <td><small class="text-muted">{{ $log->browser }}</small></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Tidak ada data log yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection