@extends('layouts/app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-fw fa-user mr-2"></i>
    {{ $title }}</h1>
<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
        <div class="mb-1 mr-1">
            <a href="{{ route('userCreate') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Tambah Data</a>
        </div>
        {{-- <div>
            <a href="#" class="btn btn-sm btn-success">
                <i class="fas fa-file-excel mr-2"></i>
                File Excel
            </a>
            <a href="#" class="btn btn-sm btn-danger">
                <i class="fas fa-file-excel mr-2"></i>
                PDF
            </a>
        </div> --}}
    </div>
    <div class="card-body">
        <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Jabatan</th>
                                            <th>Tugas </th>
                                            <th>
                                                <i class="fas fa-cog"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                    @foreach ($user as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-info">
                                                {{ $item->email }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($item->jabatan == 'Admin')
                                                <span class="badge badge-primary">
                                                    {{ $item->jabatan }}
                                                </span>
                                            @elseif ($item->jabatan == 'Karyawan')
                                                <span class="badge badge-secondary">
                                                    {{ $item->jabatan }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->is_tugas == false)
                                                <span class="badge badge-primary">
                                                    Belum Ada Tugas
                                                </span>
                                            @else
                                                <span class="badge badge-success">
                                                   Sudah Ada Tugas
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('userEdit', $item->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @include('admin/user/modal')
                                        </td>
                                        
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
    </div>
</div>
@endsection