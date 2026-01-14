@extends('layouts/app')
<style>
    /* Membuat latar belakang modal lebih gelap */
    .modal-backdrop.show {
        opacity: 0.8;
    }
    
    /* Animasi zoom saat modal terbuka */
    .modal.fade .modal-dialog {
        transform: scale(0.8);
        transition: transform 0.3s ease-out;
    }
    .modal.show .modal-dialog {
        transform: scale(1);
    }
</style>

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
                     <form action="{{ url('tugasSearch') }}" method="GET">
    <div class="input-group">
        <input name="search" type="text" 
               class="form-control bg-light border-0 small" 
               placeholder="Cari Nama, CIF, No. Rekening"
               aria-label="Search" 
               aria-describedby="basic-addon2"
               value="{{ request('search') }}"> <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
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
                                            <th>No. Rekening</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Nama Ibu Kandung</th>
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
    <center>
    <img src="{{ asset('images/'. $item->foto) }}" 
         style="width: 50px; height: 50px; object-fit: cover; cursor: pointer; border: 2px solid #007bff; border-radius: 8px; transition: 0.3s;" 
         data-toggle="modal" 
         data-target="#imageModal{{ $item->id }}"
         title="Klik untuk memperbesar"
         onmouseover="this.style.opacity='0.7'" 
         onmouseout="this.style.opacity='1'">
</center>

<div class="modal fade" id="imageModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background: transparent; border: none;">
            
            <div class="shadow-lg" style="background: linear-gradient(45deg, #007bff, #00c6ff); color: white; padding: 15px; border-radius: 15px 15px 0 0; border-bottom: 2px solid rgba(255,255,255,0.2); position: relative; z-index: 10;">
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" 
                        style="position: absolute; right: 15px; top: 10px; opacity: 1; outline: none;">
                    <span aria-hidden="true" style="font-size: 2rem;">&times;</span>
                </button>
                
                <h4 class="mb-1" style="font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
                    {{ $item->nama }}
                </h4>
                <div style="font-size: 0.9rem; opacity: 0.9;">
                    <i class="fas fa-id-card mr-1"></i> CIF: <strong>{{ $item->cif }}</strong> 
                    <span class="mx-2">|</span>
                    <i class="fas fa-id-card mr-1"></i> No. Rekening: <strong>{{ $item->no_rekening }}</strong>
                    <span class="mx-2">|</span>
                    <i class="fas fa-female mr-1"></i> Ibu Kandung: <strong>{{ $item->nama_ibu }}</strong>
                </div>
            </div>

            <div class="modal-body p-0 shadow-lg" style="background: white; border-radius: 0 0 15px 15px; overflow: hidden; position: relative;">
    <div class="zoom-wrapper" style="overflow: hidden; cursor: zoom-in;">
        <img id="imageZoom{{ $item->id }}" 
             src="{{ asset('images/'. $item->foto) }}" 
             class="img-fluid" 
             style="width: 100%; transition: transform 0.3s ease; transform-origin: center;">
    </div>
</div>
                
                <div style="position: absolute; bottom: 10px; right: 10px; background: rgba(0,0,0,0.5); color: white; padding: 2px 10px; border-radius: 20px; font-size: 10px;">
                    Scroll untuk Zoom In/Out
                </div>
            </div>
            
        </div>
    </div>
</div>
    {{-- <center>
        <img src="{{ asset('images/'. $item->foto) }}" 
             style="width: 50px; height: 50px; object-fit: cover; cursor: pointer; border: 2px solid #007bff; border-radius: 8px; transition: 0.3s;" 
             data-toggle="modal" 
             data-target="#imageModal{{ $item->id }}"
             title="Klik untuk memperbesar"
             onmouseover="this.style.opacity='0.7'" 
             onmouseout="this.style.opacity='1'">
    </center>

    <div class="modal fade" id="imageModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="background: transparent; border: none;">
                
                <div class="shadow-lg" style="background: linear-gradient(45deg, #007bff, #00c6ff); color: white; padding: 15px; border-radius: 15px 15px 0 0; border-bottom: 2px solid rgba(255,255,255,0.2); position: relative;">
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" 
                            style="position: absolute; right: 15px; top: 10px; opacity: 1; outline: none;">
                        <span aria-hidden="true" style="font-size: 2rem;">&times;</span>
                    </button>
                    
                    <h4 class="mb-1" style="font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
                        {{ $item->nama }}
                    </h4>
                    <div style="font-size: 0.9rem; opacity: 0.9;">
                        <i class="fas fa-id-card mr-1"></i> CIF: <strong>{{ $item->cif }}</strong> 
                        <span class="mx-2">|</span>
                        <i class="fas fa-id-card mr-1"></i> No. Rekening: <strong>{{ $item->no_rekening }}</strong>
                        <span class="mx-2">|</span>
                        <i class="fas fa-female mr-1"></i> Ibu Kandung: <strong>{{ $item->nama_ibu }}</strong>
                    </div>
                </div>

                <div class="modal-body p-0 shadow-lg" style="background: white; border-radius: 0 0 15px 15px; overflow: hidden;">
                    <img src="{{ asset('images/'. $item->foto) }}" class="img-fluid" style="width: 100%; display: block;">
                </div>
                
            </div>
        </div>
    </div>
</td> --}}

{{-- <td>
    <center>
        <img src="{{ asset('images/'. $item->foto) }}" 
             style="width: 50px; height: 50px; object-fit: cover; cursor: pointer; border-radius: 5px;" 
             data-toggle="modal" 
             data-target="#imageModal{{ $item->id }}"
             title="Klik untuk memperbesar">
    </center>
    <div class="modal fade" id="imageModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="background: transparent; border: none;">
                <div class="modal-body text-center">
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="font-size: 3rem; opacity: 1;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img src="{{ asset('images/'. $item->foto) }}" class="img-fluid rounded shadow-lg">
                    <div class="text-white mt-3">
                        <h5>{{ $item->nama }} <br> ({{ $item->cif }})</h5> <br> ({{ $item->nama_ibu }})
                    </div>
                </div>
            </div>
        </div>
    </div>
</td> --}}
                                            {{-- 3. Menampilkan data teks dari kolom database --}}
                                            <td>{{ $item->cif }}</td>
                                            <td>{{ $item->no_rekening }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->nama_ibu }}</td>        
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

<script>
// Tunggu sampai dokumen siap
document.addEventListener('DOMContentLoaded', function() {
    const img = document.getElementById('imageZoom{{ $item->id }}');
    let isZoomed = false;

    img.addEventListener('click', function() {
        if (!isZoomed) {
            // Zoom In ke 2x lipat
            this.style.transform = "scale(2)";
            this.parentElement.style.cursor = "zoom-out";
            isZoomed = true;
        } else {
            // Zoom Out ke normal
            this.style.transform = "scale(1)";
            this.parentElement.style.cursor = "zoom-in";
            isZoomed = false;
        }
    });

    // Reset saat modal ditutup agar tidak nyangkut dalam kondisi zoom
    $('#imageModal{{ $item->id }}').on('hidden.bs.modal', function () {
        img.style.transform = "scale(1)";
        isZoomed = false;
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/@panzoom/panzoom@4.5.1/dist/panzoom.min.js"></script>