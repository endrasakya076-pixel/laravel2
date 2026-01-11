@extends('layouts/app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-fw fa-plus mr-2"></i>
    {{ $title }}</h1>
<div class="card">
    <div class="card-header bg-primary">
            <a href="{{ route('tugas')  }}" class="btn btn-sm btn-success">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('tugasStore') }}" method="post" enctype="multipart/form-data">
            @csrf
    <div class="row mb-4">
    <div class="col-xl-6 mb-2">
        <label class="form-label">
            <span class="text-danger">*</span>
            Foto Spesimen :
        </label>
        <div class="custom-file">
                <div class="form-group">
                <input type="file" name="foto" id="foto" class="foto">
                </div>
        </div>
    </div>
        <div class="col-xl-6 mb-1">
                <label class="form-label">
                    <span class="text-danger">*</span>
                    Cif:</label>
                <input type="cif" name="cif" class="form-control @error('cif') is-invalid @enderror" value="{{ old('cif') }}">
                    @error('cif')
                @enderror
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-xl-6">
                <label class="form-label">
                    <span class="text-danger">*</span>
                    Nama :</label>
                <input type="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-xl-6">
                <label class="form-label">
                    <span class="text-danger">*</span>
                    Alamat :</label>
                <input type="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-xl-6">
                <label class="form-label">
                    <span class="text-danger">*</span>
                    Nama Ibu Kandung :</label>
                <input type="nama_ibu" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" value="{{ old('nama_ibu') }}">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-xl-6">
                <label class="form-label">
                    <span class="text-danger">*</span>
                    Alamat :</label>
                <input type="alamat_ibu" name="alamat_ibu" class="form-control @error('alamat_ibu') is-invalid @enderror" value="{{ old('alamat_ibu') }}">
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fas fa-save mr-2"></i>
                    Simpan Edit
            </button>
        </div>
        </form>
    </div>
</div>
@endsection