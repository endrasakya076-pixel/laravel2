@extends('layouts/app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-fw fa-tachometer-alt mr-2"></i>
    {{ $title }}</h1>
    <div class="row">
         <div class="col-xl-3 col-md-6 mb-4">
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

    </div>
@endsection
 