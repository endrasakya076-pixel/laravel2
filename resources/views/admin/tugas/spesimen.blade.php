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
        <form action="{{ route('userStore') }}" method="post">
            @csrf
        {{-- <div class="row mb-4">
            <div class="col-xl-6 mb-2">
                <label class="form-label">
                    <span class="text-danger">*</span>
                    Foto Spesimen :</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                    @error('nama')
                <small class="text-danger">
                    {{ $message }}   
                </small>
                @enderror
            </div> --}}
            <div class="row mb-4">
    <div class="col-xl-6 mb-2">
        <label class="form-label">
            <span class="text-danger">*</span>
            Foto Spesimen :
        </label>
        
        <div class="custom-file">
            <input type="file" 
                   name="nama" 
                   class="custom-file-input @error('nama') is-invalid @enderror" 
                   id="fotoSpesimen"
                   accept="image/*">
            <label class="custom-file-label" for="fotoSpesimen">Pilih file...</label>
            
            @error('nama')
            <small class="text-danger">
                {{ $message }}   
            </small>
            @enderror
        </div>
        <div class="mt-2">
            <img id="img-preview" class="img-fluid img-thumbnail" style="max-height: 200px; display: none;">
        </div>
    </div>
            <div class="col-xl-6 mb-1">
                <label class="form-label">
                    <span class="text-danger">*</span>
                    Cif:</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                <small class="text-danger">
                    {{ $message }}   
                </small>
                @enderror
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-xl-6">
                <label class="form-label">
                    <span class="text-danger">*</span>
                    Nama :</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-xl-6">
                <label class="form-label">
                    <span class="text-danger">*</span>
                    Alamat :</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-xl-6">
                <label class="form-label">
                    <span class="text-danger">*</span>
                    Nama Ibu Kandung :</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-xl-6">
                <label class="form-label">
                    <span class="text-danger">*</span>
                    Alamat :</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fas fa-save mr-2"></i>
                    Simpan
            </button>
        </div>
        </form>
    </div>
</div>
@endsection

<script>
   function previewImage() {
    const image = document.querySelector('#fotoSpesimen');
    const imgPreview = document.querySelector('#img-preview');
    const label = document.querySelector('.custom-file-label');

    // Menampilkan nama file di label
    label.textContent = image.files[0].name;

    // Logika Preview
    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.style.display = 'block';
        imgPreview.src = oFREvent.target.result;
    }
}
</script>