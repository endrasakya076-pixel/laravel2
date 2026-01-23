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

<td class="align-middle">
    @if(str_contains($approval->keterangan, 'Tidak Sesuai'))
        <span class="text-danger font-weight-bold">
            <i class="fas fa-exclamation-triangle mr-1"></i> 
            {{ $approval->keterangan }}
        </span>
    @else
        <span class="text-info font-italic">
            <i class="fas fa-check-circle mr-1"></i> 
            {{ $approval->keterangan }}
        </span>
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