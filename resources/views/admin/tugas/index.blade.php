@extends('layouts/app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-tasks mr-2"></i>
    {{ $title }}</h1>
<div class="card mb-5">
    <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
        <div class="mb-1 mr-1">
            <a href="{{ route('tugasSpesimen') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Tambah Spesimen</a>
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
                    <!-- Search Form -->
                     <form
                       action="{{ route('tugasSearch') }}" method="GET">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Foto Spesimen</th>
                                            <th>CIF</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Nama Ibu Kandung</th>
                                            <th>Alamat Ibu Kandung</th>
                                            <th>
                                                <i class="fas fa-cog"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                    @foreach ($spesimen as $item)
                                        <tr>
                                            {{-- 1. Menampilkan nomor urut otomatis --}}
                                             <td class="text-center">{{ $loop->iteration }}</td>

                                            {{-- 2. Menampilkan foto (asumsi folder ada di public/storage) --}}
                                            <td>
                                            <a href="{{ asset('images/'. $item->foto) }}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ asset('images/'. $item->foto) }}" width="30%" height="30%" alt="" srcset="">
                                            </a>
                                            </td>
                                            {{-- 3. Menampilkan data teks dari kolom database --}}
                                            <td>{{ $item->cif }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->nama_ibu }}</td>    
                                            <td>{{ $item->alamat_ibu }}</td>    
                                            <td class="text-center">
                                            <a href="{{ route('tugasEdit', $item->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @include('admin/tugas/modal')
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
    </div>
</div>
@endsection