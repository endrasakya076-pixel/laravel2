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
                        @forelse($approvals as $index => $approval)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="font-weight-bold">{{ $approval->nasabah_name }}</td>
                            <td>Rp {{ number_format($approval->amount, 0, ',', '.') }}</td>
                            <td>
                                <small class="text-muted d-block">Catatan Teller:</small>
                                <span>{{ $approval->keterangan ?? 'Data Pembanding Sesuai' }}</span>
                            </td>
                            <td class="text-center">
                                @if($approval->status == 'pending')
                                    <span class="badge badge-warning p-2">Menunggu</span>
                                @elseif($approval->status == 'approved')
                                    <span class="badge badge-success p-2">Disetujui</span>
                                @else
                                    <span class="badge badge-danger p-2">Ditolak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($approval->status == 'pending')
                                <form action="{{ route('approvals.approve', $approval->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success" onclick="return confirm('Setujui penarikan ini?')">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                </form>
                                <form action="{{ route('approvals.reject', $approval->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Tolak penarikan ini?')">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                                @else
                                <span class="text-muted small">Sudah Diproses</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center italic">Belum ada data persetujuan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection