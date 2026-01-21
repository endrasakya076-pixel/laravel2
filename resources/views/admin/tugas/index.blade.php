@extends('layouts/app')

<style>
    .modal-backdrop.show { opacity: 0.8; }
    .modal.fade .modal-dialog { transform: scale(0.8); transition: transform 0.3s ease-out; }
    .modal.show .modal-dialog { transform: scale(1); }
    /* Cursor awal untuk gambar di modal */
    .img-zoom-container { cursor: zoom-in; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #1a1a1a; height: 80vh; position: relative; }
</style>

@section('content')
<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-tasks mr-2"></i> {{ $title }}</h1>

<div class="card mb-5">
    <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
        <div class="mb-1 mr-1">
            <a href="{{ route('tugasSpesimen') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus mr-2"></i> Tambah Spesimen
            </a>
        </div>
        <form action="{{ url('tugasSearch') }}" method="GET">
            <div class="input-group">
                <input name="search" type="text" class="form-control bg-light border-0 small" placeholder="Cari Nama, CIF, No. Rekening" value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search fa-sm"></i></button>
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
                        <th>No. Rekening</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nama Ibu Kandung</th>
                        <th><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spesimen as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <center>
                                <img src="{{ asset('images/'. $item->foto) }}" 
                                     style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; border: 2px solid #007bff; border-radius: 8px;" 
                                     data-toggle="modal" data-target="#imageModal{{ $item->id }}" title="Klik untuk memperbesar">
                            </center>

                            <div class="modal fade" id="imageModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 95%;">
                                    <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
                                        <div style="background: linear-gradient(45deg, #007bff, #00c6ff); color: white; padding: 15px;">
                                            <button type="button" class="close text-white" data-dismiss="modal" style="opacity: 1;">
                                                <span aria-hidden="true" style="font-size: 2rem;">&times;</span>
                                            </button>
                                            <h4 class="mb-0">{{ $item->nama }}</h4>
                                            <small>CIF: {{ $item->cif }} | Rek: {{ $item->no_rekening }} | Ibu Kandung : {{ $item->nama_ibu }}</small>
                                        </div>
                                        <div class="modal-body p-0 img-zoom-container" id="wrapper{{ $item->id }}">
                                            <img src="{{ asset('images/'. $item->foto) }}" 
                                                 class="img-zoomable" 
                                                 data-id="{{ $item->id }}"
                                                 style="max-width: 100%; max-height: 100%; transition: transform 0.1s ease-out; transform: scale(1);">
                                            <div style="position: absolute; bottom: 10px; color: white; background: rgba(0,0,0,0.5); padding: 2px 10px; border-radius: 10px; font-size: 11px;">
                                                Scroll untuk Zoom | Drag untuk Geser
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-center" style="background: #f8f9fa; border-top: 1px solid #dee2e6;">
                                        <form action="{{ route('verifikasi.update', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                             <input type="hidden" name="status" value="gagal">
                                                 <button type="submit" class="btn btn-danger btn-lg mx-2" onclick="return confirm('Yakin menyatakan GAGAL verifikasi?')">
                                                <i class="fas fa-times-circle"></i> Gagal Verifikasi
                                                </button>
                                                </form>
                                                <form action="{{ route('verifikasi.update', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="berhasil">
                                                    <button type="submit" class="btn btn-success btn-lg mx-2" onclick="return confirm('Yakin menyatakan BERHASIL verifikasi?')">
                                                <i class="fas fa-check-circle"></i> Berhasil Verifikasi
                                                </button>
                                            </form>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $item->cif }}</td>
                        <td>{{ $item->no_rekening }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->nama_ibu }}</td>
                        <td class="text-center">
                            <a href="{{ route('tugasEdit', $item->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $item->id }}"><i class="fas fa-trash"></i></button>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Menangani semua elemen dengan class 'img-zoomable'
    document.querySelectorAll('.img-zoomable').forEach(function(img) {
        const container = img.parentElement;
        let scale = 1;
        let isDragging = false;
        let startX, startY, translateX = 0, translateY = 0;

        // Fungsi Zoom dan Drag diletakkan di sini (Gunakan kode JS yang saya berikan sebelumnya)
        // ...
    });
});
</script>