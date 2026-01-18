@extends('layouts/app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
    {{ $title }}</h1>
    <div class="row">
         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                User</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(auth()->id() == 1)
<div class="card mt-4">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Log Aktivitas Admin (Terbaru)</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Nama Admin</th>
                    <th>Aktivitas</th>
                    <th>Keterangan</th>
                    <th>IP</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                    <td><strong>{{ $log->user->nama }}</strong></td>
                    <td><span class="badge badge-info">{{ $log->aktivitas }}</span></td>
                    <td>{{ $log->keterangan }}</td>
                    <td><small class="text-muted">{{ $log->ip_address }}</small></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
    </div>
@endsection
 