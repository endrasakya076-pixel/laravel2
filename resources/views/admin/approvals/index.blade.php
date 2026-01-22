@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Persetujuan</h1>
    <div class="mb-3">
        <a href="{{ route('tugas') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Data Spesimen
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama Nasabah</th>
                <th>Jumlah Penarikan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($approvals as $approval)
            <tr>
                <td>{{ $approval->nasabah_name }}</td>
                <td>{{ $approval->amount }}</td>
                <td>
                    <form action="{{ route('approvals.approve', $approval->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-success">Setujui</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection