@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-check-double mr-2"></i> Daftar Persetujuan</h1>
    
    <div class="mb-4">
        <a href="{{ route('tugas') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Data Spesimen
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nama Nasabah</th>
                            <th>Jumlah Penarikan</th>
                            <th>Keterangan</th>
                            <th width="10%">Status</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
@foreach($approvals as $index => $approval)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>{{ $approval->nasabah_name }}</td>
    <td>Rp {{ number_format($approval->amount, 0, ',', '.') }}</td>
    <td>
        <span class="text-info font-italic">
            <i class="fas fa-comment-dots mr-1"></i> 
            {{ $approval->keterangan ?? 'Data Pembanding Sesuai' }}
        </span>
    </td>

   <td class="text-center">
    @php
        // Daftar jabatan yang memiliki otoritas otorisasi
        $authorizedPositions = [
            'Supervisor 1', 'Supervisor 2', 'Supervisor 3', 'Supervisor 4', 'Supervisor 5',
            'Kepala Cabang Gerung', 'Kepala Cabang Pancor', 'Kepala Cabang Tanjung'
        ];
        
        // Pengecekan apakah user yang login memiliki hak akses
        $canAccess = Auth::user()->nama === 'Hendra Sakya Permana' || 
                     Auth::user()->role === 'admin1' || 
                     in_array(Auth::user()->jabatan, $authorizedPositions);
    @endphp

    @if($canAccess)
        {{-- Tombol aksi hanya muncul jika status masih 'Baru Masuk' --}}
        @if($approval->status == 'Baru Masuk')
            <div class="btn-group">
                <form action="{{ route('approvals.hold', $approval->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success mr-1 shadow-sm" title="Setujui Transaksi">
                        <i class="fas fa-check-circle"></i> Setuju
                    </button>
                </form>

                <form action="{{ route('approvals.reject', $approval->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-warning mr-1 shadow-sm" title="Tolak Transaksi" onclick="return confirm('Apakah Anda yakin ingin MENOLAK transaksi ini?')">
                        <i class="fas fa-ban"></i> Tolak
                    </button>
                </form>

                <form action="{{ route('approvals.approve', $approval->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Hapus Data" onclick="return confirm('Hapus data ini dari daftar?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        @else
            {{-- Tampilan jika status sudah berubah (Setuju/Ditolak/Hapus) --}}
            @if($approval->status == 'Setuju')
                <span class="badge badge-success px-3 py-2"><i class="fas fa-check"></i> Disetujui</span>
            @elseif($approval->status == 'Ditolak')
                <span class="badge badge-warning px-3 py-2"><i class="fas fa-times"></i> Ditolak</span>
            @else
                <span class="badge badge-secondary px-3 py-2">{{ $approval->status }}</span>
            @endif
        @endif
    @else
        {{-- Tampilan untuk user yang tidak memiliki jabatan otorisasi (misal: Teller) --}}
        <span class="badge badge-light text-muted font-italic">
            <i class="fas fa-lock"></i> Menunggu Otorisasi Pejabat
        </span>
    @endif
</td>

    <td class="text-center">
        @if(auth()->user()->nama == 'Hendra Sakya Permana' || auth()->user()->role == 'admin1')
            
            {{-- Tombol hanya muncul jika status belum diproses (masih 'Baru Masuk' atau pending) --}}
            @if($approval->status == 'Baru Masuk' || $approval->status == '')
                <div class="btn-group" role="group">
                    <form action="{{ route('approvals.approve', $approval->id) }}" method="POST" class="d-inline">
                        @csrf
                        {{-- <button type="submit" class="btn btn-sm btn-danger mr-1" onclick="return confirm('Hapus data ini?')">Hapus</button> --}}
                    </form>

                    <form action="{{ route('approvals.hold', $approval->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success mr-1">Setuju</button>
                    </form>
                    
                    <form action="{{ route('approvals.reject', $approval->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                    </form>
                </div>
            @else
                <small class="text-muted"><i class="fas fa-check-double"></i> Selesai di Otorisasi</small>
            @endif

        @else
            <small class="text-muted">Menunggu Admin 1</small>
        @endif
    </td>
</tr>
@endforeach    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection