@extends('layouts.app')

<style>
@media print {
    /* Sembunyikan elemen navigasi dan tombol saat dicetak */
    .btn, .sidebar, .navbar, .breadcrumb, .card-header, footer, #debug-icon-wrapper, .pagination-wrapper { 
        display: none !important; 
    }

    /* Optimasi Tabel untuk Kertas A4 */
    .container-fluid, .card, .card-body {
        padding: 0 !important;
        margin: 0 !important;
        border: none !important;
    }

    table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 10pt !important; /* Ukuran font lebih kecil saat cetak */
    }

    th, td {
        border: 1px solid #000 !important;
        padding: 6px !important;
        word-wrap: break-word;
    }

    .badge {
        border: none !important;
        padding: 0 !important;
        color: #000 !important; /* Badge jadi teks hitam biasa saat cetak */
        background: none !important;
    }
}

/* Style untuk efek visual di layar */
.badge-danger-soft { background-color: #ffe5e5; color: #d9534f; border: 1px solid #d9534f; }
</style>

@section('content')
<div class="container-fluid">
    <h1 class="h3 mt-4 mb-2 text-gray-800"><i class="fas fa-clipboard-list mr-2"></i>Audit Log Sistem</h1>
    <p class="mb-4">Log riwayat transaksi dan otorisasi Pejabat/Admin 1.</p>

    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-history mr-1"></i> Log Aktivitas Otorisasi</h6>
            
            <div class="d-flex align-items-center" style="gap: 10px;">
                <button onclick="window.print()" class="btn btn-info btn-sm shadow-sm">
                    <i class="fas fa-print"></i> Cetak Laporan Log
                </button>
             
                {{-- Tombol Kosongkan Log khusus untuk user dengan otoritas tertinggi (Hendra/ID 1) --}}
                @if(auth()->user()->nama == 'Hendra Sakya Permana' || auth()->id() == 1)
                    <form action="{{ route('audit-log.clear') }}" method="POST" onsubmit="return confirm('PERINGATAN: Semua riwayat audit akan dihapus permanen. Lanjutkan?')" class="m-0">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                            <i class="fas fa-trash-alt"></i> Bersihkan Log
                        </button>
                    </form>
                @endif
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="auditTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th width="12%">Waktu</th>
                            <th width="18%">Pelaksana</th>
                            <th width="15%">Aktivitas</th>
                            <th>Detail Perubahan / Keterangan</th>
                            <th width="10%">IP</th>
                            <th width="12%">Perangkat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td class="small align-middle">{{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d M Y, H:i') }} WITA</td>
                            <td class="align-middle">
                                <strong>{{ $log->user->nama ?? 'System' }}</strong><br>
                                <span class="badge badge-secondary">{{ $log->user->jabatan ?? '-' }}</span>
                            </td>
                            <td class="text-center align-middle">
                                @php
                                    $act = strtolower($log->aktivitas);
                                    $badgeClass = 'badge-info';
                                    
                                    if(str_contains($act, 'tidak sesuai') || str_contains($act, 'tolak') || str_contains($act, 'hapus')) {
                                        $badgeClass = 'badge-danger';
                                    } elseif(str_contains($act, 'setuju') || str_contains($act, 'sesuai') || str_contains($act, 'tambah')) {
                                        $badgeClass = 'badge-success';
                                    } elseif(str_contains($act, 'edit') || str_contains($act, 'update')) {
                                        $badgeClass = 'badge-warning';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }} p-2 w-100">{{ strtoupper($log->aktivitas) }}</span>
                            </td>
                            <td class="align-middle">
                                @if(str_contains(strtolower($log->keterangan), 'tidak sesuai'))
                                    <span class="text-danger font-weight-bold"><i class="fas fa-exclamation-circle"></i> {{ $log->keterangan }}</span>
                                @else
                                    {{ $log->keterangan }}
                                @endif
                            </td>
                            <td class="align-middle text-center"><small class="text-primary">{{ $log->ip_address }}</small></td>
                            <td class="align-middle small text-muted text-truncate" style="max-width: 150px;" title="{{ $log->browser }}">
                                {{ $log->browser }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3"></i><br>Belum ada data log aktivitas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center pagination-wrapper">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection