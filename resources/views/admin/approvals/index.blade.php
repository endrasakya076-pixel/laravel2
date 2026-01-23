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
                            <th>Keterangan & Metadata</th>
                            <th width="15%" class="text-center">Aksi / Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($approvals as $index => $approval)
                        <tr>
                            <td class="align-middle text-center">{{ $index + 1 }}</td>
                            <td class="align-middle font-weight-bold">{{ $approval->nasabah_name }}</td>
                            <td class="align-middle text-dark">Rp {{ number_format($approval->amount, 0, ',', '.') }}</td>
                            
                            <td class="align-middle">
                                <div class="mb-1">
                                    @if(str_contains($approval->keterangan, 'Tidak Sesuai'))
                                        <span class="text-danger font-weight-bold">
                                            <i class="fas fa-exclamation-triangle mr-1"></i> 
                                            {{ $approval->keterangan }}
                                        </span>
                                    @else
                                        <span class="text-info font-italic">
                                            <i class="fas fa-check-circle mr-1"></i> 
                                            {{ $approval->keterangan ?? 'Data Pembanding Sesuai' }}
                                        </span>
                                    @endif
                                </div>

                                <div class="border-top pt-1 mt-1" style="font-size: 0.75rem;">
                                    <span class="text-muted">
                                        <i class="fas fa-user-edit"></i> Pengirim: 
                                        <span class="text-dark font-weight-bold">{{ $approval->user->nama ?? 'Teller Terdaftar' }}</span>
                                    </span>
                                    <span class="text-muted ml-3">
                                        <i class="fas fa-clock"></i> 
                                        {{ \Carbon\Carbon::parse($approval->created_at)->translatedFormat('H:i') }} WITA
                                    </span>
                                </div>
                            </td>

<td class="text-center align-middle">
    @php
        $authorizedPositions = [
            'Supervisor 1', 'Supervisor 2', 'Supervisor 3', 'Supervisor 4', 'Supervisor 5',
            'Kepala Cabang Gerung', 'Kepala Cabang Pancor', 'Kepala Cabang Tanjung'
        ];
        
        $canAccess = Auth::user()->nama === 'Hendra Sakya Permana' || 
                     Auth::user()->role === 'admin1' || 
                     in_array(Auth::user()->jabatan, $authorizedPositions);
    @endphp

    @if($approval->status == 'Baru Masuk')
        @if($canAccess)
            {{-- Tampilan untuk Pejabat: Muncul Tombol --}}
            <div class="btn-group">
                <form action="{{ route('approvals.hold', $approval->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success mr-1 shadow-sm" title="Setujui">
                        <i class="fas fa-check"></i> Setuju
                    </button>
                </form>

                <form action="{{ route('approvals.reject', $approval->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-warning mr-1 shadow-sm" title="Tolak" onclick="return confirm('Tolak transaksi ini?')">
                        <i class="fas fa-ban"></i> Tolak
                    </button>
                </form>
            </div>
        @else
            {{-- Tampilan untuk Teller/Cash: Muncul Status Menunggu --}}
            <span class="badge badge-primary px-3 py-2 shadow-sm">
                <i class="fas fa-clock fa-spin mr-1"></i> Menunggu Otorisasi
            </span>
        @endif
    @else
        {{-- Tampilan untuk SEMUA USER jika status sudah berubah (Setuju/Ditolak) --}}
        @if($approval->status == 'Setuju')
            <span class="badge badge-success px-3 py-2 shadow-sm">
                <i class="fas fa-check-circle mr-1"></i> Setuju
            </span>
        @elseif($approval->status == 'Ditolak')
            <span class="badge badge-warning px-3 py-2 shadow-sm">
                <i class="fas fa-times-circle mr-1"></i> Ditolak
            </span>
        @else
            <span class="badge badge-secondary px-3 py-2 shadow-sm">
                {{ $approval->status }}
            </span>
        @endif
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
