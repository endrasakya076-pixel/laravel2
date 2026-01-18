@extends('layouts.app') {{-- Sesuaikan dengan nama file di folder layouts Anda --}}

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Selamat Datang, {{ Auth::user()->nama }}</li>
            </ol>
        </div>
    </div>

    {{-- Tabel Log Aktivitas - Hanya muncul untuk Admin 1 --}}
    @if(auth()->id() == 1)
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <i class="fas fa-history mr-1"></i>
            Log Aktivitas Admin (Terbaru)
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Nama Admin</th>
                            <th>Aktivitas</th>
                            <th>Keterangan</th>
                            <th>IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            <td><strong>{{ $log->user->nama ?? 'System' }}</strong></td>
                            <td><span class="badge badge-info">{{ $log->aktivitas }}</span></td>
                            <td>{{ $log->keterangan }}</td>
                            <td><small class="text-muted">{{ $log->ip_address }}</small></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada aktivitas tercatat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection