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

@if(session('success'))
<div class="modal fade show" id="successModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: block; background: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success"><i class="fas fa-check-circle"></i> Sukses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ session('success') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection