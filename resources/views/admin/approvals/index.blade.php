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
        @if($approval->status == 'Disetujui')
            <span class="badge badge-success"><i class="fas fa-check-circle"></i> Disetujui</span>
        @elseif($approval->status == 'Ditolak')
            <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Ditolak</span>
        @elseif($approval->status == 'Menunggu')
            <span class="badge badge-warning text-dark"><i class="fas fa-pause-circle"></i> Menunggu</span>
        @else
            <span class="badge badge-secondary">Baru Masuk</span>
        @endif
    </td>

    <td class="text-center">
        @if(auth()->user()->nama == 'Hendra Sakya Permana' || auth()->user()->role == 'admin1')
            
            {{-- Tombol muncul jika status belum Disetujui/Ditolak --}}
            @if($approval->status != 'Disetujui' && $approval->status != 'Ditolak')
                <div class="btn-group" role="group">
                    <form action="{{ route('approvals.approve', $approval->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger mr-1">Hapus</button>
                    </form>

                    <form action="{{ route('approvals.hold', $approval->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success mr-1">Setuju</button>
                    </form>
                    
                    <form action="{{ route('approvals.reject', $approval->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-warning">Tolak</button>
                    </form>
                </div>
            @else
                <span class="text-muted small"><i class="fas fa-lock"></i> Tindakan Selesai</span>
            @endif

        @else
            <small class="text-muted">Otoritas Admin 1</small>
        @endif
    </td>
</tr>
@endforeach        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection