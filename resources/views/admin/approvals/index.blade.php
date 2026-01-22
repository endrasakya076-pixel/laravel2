@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Persetujuan</h1>
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