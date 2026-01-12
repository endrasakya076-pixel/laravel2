<?php

namespace App\Http\Controllers;

use App\Models\Spesimen;
use Illuminate\Http\Request;

class TugasController extends Controller
{
     public function index()
    {
        // Mengambil semua data dari tabel spesimen
        $spesimen = Spesimen::all();
        $data = array(

            'title' => 'Data Spesimen',
            'menuTugas' => 'active',
            'spesimen' => $spesimen,
        );
        return view('admin/tugas/index', $data);
    }
    public function spesimen()
    {
        $data = array(

            'title' => 'Tambah Spesimen',
            'menuTugas' => 'active',
        );
        return view('admin/tugas/spesimen', $data);
    }
    public function store(Request $request){
    // 1. Tambahkan Validasi
    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg|min:1024', // min:1024 KB = 1 MB
        'cif' => 'required',
        'nama' => 'required',
        // Kolom lain nullable agar bisa dikosongkan seperti permintaan awal Anda
        'alamat' => 'nullable',
        'nama_ibu' => 'nullable',
        'alamat_ibu' => 'nullable',
    ], [
        // Pesan error kustom (opsional)
        'foto.min' => 'Ukuran foto terlalu kecil, minimal harus 1 MB agar gambar terlihat jelas saat verifikasi.',
        'foto.required' => 'Foto spesimen wajib diunggah.',
    ]);

    // 2. Proses upload jika validasi lolos
    $nm = $request->foto;
    $namaFile = time().rand(100,999).$nm->getClientOriginalName();

    $spesimen = new Spesimen();
    $spesimen->foto = $namaFile;
    $nm->move(public_path().'/images', $namaFile);
    
    $spesimen->cif = $request->cif;
    $spesimen->nama = $request->nama;
    $spesimen->alamat = $request->alamat;
    $spesimen->nama_ibu = $request->nama_ibu;
    $spesimen->alamat_ibu = $request->alamat_ibu;
    $spesimen->save();

    return redirect()->route('tugas')->with('success','Data user berhasil ditambahkan');
}
//     public function store(Request $request){
//         $nm = $request->foto;
//         $namaFile = time().rand(100,999).""."".$nm->getClientOriginalName();

//         $spesimen = new Spesimen();
//         $spesimen->foto = $namaFile;
//         $nm->move(public_path().'/images', $namaFile);
//         $spesimen->cif = $request->cif;
//         $spesimen->nama = $request->nama;
//         $spesimen->alamat = $request->alamat;
//         $spesimen->nama_ibu = $request->nama_ibu;
//         $spesimen->alamat_ibu = $request->alamat_ibu;
//         $spesimen->save();

// return redirect()->route('tugas')->with('success','Data user berhasil ditambahkan');
//     }
    public function edit($id)
    {
        $spesimen = Spesimen::find($id);
        $data = array(
            'title' => 'Edit Spesimen',
            'menuTugas' => 'active',
            'spesimen' => Spesimen::findOrFail($id),
        );
        return view('admin/tugas/edit', $data);
    }
    public function update(Request $request, $id)
    {
        $spesimen = Spesimen::find($id);

        if ($request->hasFile('foto')) {
            $nm = $request->foto;
            $namaFile = time().rand(100,999).""."".$nm->getClientOriginalName();
            $nm->move(public_path().'/images', $namaFile);
            $spesimen->foto = $namaFile;
        }

        $spesimen->cif = $request->cif;
        $spesimen->nama = $request->nama;
        $spesimen->alamat = $request->alamat;
        $spesimen->nama_ibu = $request->nama_ibu;
        $spesimen->alamat_ibu = $request->alamat_ibu;
        $spesimen->save();
        return redirect()->route('tugas')->with('success', 'Data spesimen berhasil diperbarui');
    }
    public function destroy($id)
    {
        $spesimen = Spesimen::find($id);
        if ($spesimen) {
            $spesimen->delete();
            return redirect()->route('tugas')->with('success', 'Data spesimen berhasil dihapus');
        } else {
            return redirect()->route('tugas')->with('error', 'Data spesimen tidak ditemukan');
        }
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        // Pencarian mencakup semua kolom relevan
    $spesimen = Spesimen::where('nama', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('cif', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('alamat', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('nama_ibu', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('alamat_ibu', 'LIKE', '%' . $searchTerm . '%')
        ->get();

    $data = array(
        'title' => 'Hasil Pencarian: ' . $searchTerm,
        'menuTugas' => 'active',
        'spesimen' => $spesimen,
    );

        return view('admin/tugas/index', $data);
    }
}