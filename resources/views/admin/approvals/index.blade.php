
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
    <td>{{ $approval->keterangan }}</td>

    <td class="text-center">
        @if($approval->status == 'Disetujui')
            <span class="badge badge-success"><i class="fas fa-check-circle"></i> Disetujui</span>
        @elseif($approval->status == 'Ditolak')
            <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Ditolak</span>
        @else
            <span class="badge badge-warning text-dark"><i class="fas fa-clock"></i> Pending</span>
        @endif
    </td>

    <td class="text-center">
        @if(Auth::user()->nama == 'Hendra Sakya Permana' || Auth::user()->role == 'admin1')
            @if($approval->status != 'Disetujui' && $approval->status != 'Ditolak')
                <div class="btn-group">
                    <form action="{{ route('approvals.approve', $approval->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-success mr-1">Setujui</button>
                    </form>
                    <form action="{{ route('approvals.reject', $approval->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-danger">Tolak</button>
                    </form>
                    <form action="{{ route('approvals.reject', $approval->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-danger">Ya</button>
                    </form>
                </div>
            @else
                <span class="text-muted small"><i class="fas fa-lock"></i> Selesai</span>
            @endif
        @else
            <small class="text-muted">Otoritas Hendra</small>
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