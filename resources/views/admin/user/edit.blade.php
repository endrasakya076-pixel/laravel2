@extends('layouts/app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-fw fa-edit mr-2"></i>
    {{ $title }}
</h1>

<div class="card shadow-sm">
    <div class="card-header bg-warning">
        <a href="{{ route('user') }}" class="btn btn-sm btn-success">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('userUpdate', $user->id) }}" method="post">
            @csrf
            <div class="row mb-4">
                <div class="col-xl-6 mb-2">
                    <label class="form-label font-weight-bold"><span class="text-danger">*</span> Nama :</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $user->nama) }}">
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-xl-6 mb-1">
                    <label class="form-label font-weight-bold"><span class="text-danger">*</span> Email :</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-xl-12">
                    <label class="form-label font-weight-bold"><span class="text-danger">*</span> Jabatan :</label>
                    
                    {{-- Proteksi Jabatan: Hanya ID 1 yang bisa akses --}}
                    @if(Auth::id() == 1)
                        <select name="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                            <option disabled>--Pilih Jabatan--</option>
                            @php
                                $roles = ['Admin','Supervisor 1', 'Supervisor 2', 'Supervisor 3', 'Supervisor 4', 'Supervisor 5','Kepala Cabang Gerung','Kepala Cabang Pancor','Kepala Cabang Tanjung', 'Kabag TI', 'Staff TI', 'Kabag SKAI', 'Head Teller', 'Teller', 'CS'];
                            @endphp
                            @foreach($roles as $role)
                                <option value="{{ $role }}" {{ $user->jabatan == $role ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                    @else
                        {{-- Tampilan untuk Admin ID 2 ke atas --}}
                        <select class="form-control bg-light" disabled>
                            <option selected>{{ $user->jabatan }}</option>
                        </select>
                        {{-- Hidden input agar data jabatan tidak hilang saat submit form --}}
                        <input type="hidden" name="jabatan" value="{{ $user->jabatan }}">
                        <small class="text-muted"><i class="fas fa-lock mr-1"></i> Anda tidak memiliki otoritas untuk mengubah jabatan.</small>
                    @endif

                    @error('jabatan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>            
            </div>

            <div class="row mb-4">
                <div class="col-xl-6 mb-2">
                    <label class="form-label font-weight-bold">Password :</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak ingin ganti">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-xl-6">
                    <label class="form-label font-weight-bold">Password Konfirmasi :</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                </div>
            </div>

            <div class="border-top pt-3">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection