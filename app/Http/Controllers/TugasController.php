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
        // dd($request->all());
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cif' => 'required|unique:spesimen,cif',
            'nama' => 'required',
            'alamat' => 'required',
            'nama_ibu' => 'required',
            'alamat_ibu' => 'required',
        ],[
            'foto.required' => 'Foto wajib diisi',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, gif, atau svg',
            'foto.max' => 'Ukuran foto maksimal 2MB',
            'cif.required' => 'CIF wajib diisi',
            'cif.unique' => 'CIF sudah terdaftar',
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'nama_ibu.required' => 'Nama ibu wajib diisi',
            'alamat_ibu.required' => 'Alamat ibu wajib diisi',
        ]);

        $fotoName = time().'.'.$request->foto->extension();  
        $request->foto->move(public_path('images'), $fotoName);

        $spesimen= new Spesimen;
        $spesimen->foto =$fotoName;
        $spesimen->cif =$request->cif;
        $spesimen->nama =$request->nama;
        $spesimen->alamat =$request->alamat;
        $spesimen->nama_ibu =$request->nama_ibu;
        $spesimen->alamat_ibu =$request->alamat_ibu;
        $spesimen->save();

        return redirect()->route('spesimen')->with('success','Data user berhasil diedit');
    }
}
