@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Persetujuan</h1>
    <div class="mb-3">
        <a href="{{ route('tugas') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Data Spesimen
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Nasabah</th>
                <th>Jumlah Penarikan</th>
                <th>Keterangan</th>
                <th>Persetujuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($approvals as $approval)
            <tr>
                <td>{{ $approval->nasabah_name }}</td>
                <td>{{ $approval->amount }}</td>
                <td>{{ $approval->keterangan }}</td>
                <td>{{ $approval->status }}</td>
                <td>
                    <form action="{{ route('approvals.approve', $approval->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-success">Setujui</button>
                    </form>
                    <form action="{{ route('approvals.reject', $approval->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-danger">Tidak Setuju</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection