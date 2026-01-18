<?php

namespace App\Http\Controllers;

use App\Models\Spesimen;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class TugasController extends Controller
{
    public function index()
    {
        // Menggunakan with('user') agar nama penginput bisa langsung tampil tanpa query berulang
        $spesimen = Spesimen::with('user')->orderBy('created_at', 'desc')->get();
        
        $data = [
            'title'     => 'Data Spesimen',
            'menuTugas' => 'active',
            'spesimen'  => $spesimen,
        ];
        
        return view('admin/tugas/index', $data);
    }

    public function spesimen()
    {
        $data = [
            'title'     => 'Tambah Spesimen',
            'menuTugas' => 'active',
        ];
        return view('admin/tugas/spesimen', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto'        => 'required|image|mimes:jpeg,png,jpg|max:400',
            'cif'         => 'required|string',
            'no_rekening' => 'required|string',
            'nama'        => 'required|string',
            'alamat'      => 'nullable',
            'nama_ibu'    => 'nullable',
        ], [
            'foto.required' => 'Foto spesimen wajib diunggah.',
            'foto.max'      => 'Ukuran foto maksimal 400 KB.',
        ]);

        try {
            DB::beginTransaction();

            $file = $request->file('foto');
            $namaFile = time() . "_" . rand(100, 999) . "." . $file->getClientOriginalExtension();
            
            $spesimen = new Spesimen();
            $spesimen->user_id     = Auth::id();
            $spesimen->foto        = $namaFile;
            $spesimen->cif         = $request->cif;
            $spesimen->no_rekening = $request->no_rekening;
            $spesimen->nama        = $request->nama;
            $spesimen->alamat      = $request->alamat;
            $spesimen->nama_ibu    = $request->nama_ibu;
            $spesimen->save();

            // Simpan file fisik
            $file->move(public_path('images'), $namaFile);

            ActivityLog::create([
                'user_id'   => Auth::id(),
                'aktivitas' => 'Tambah Spesimen',
                'keterangan'=> "Menambah data nasabah: {$request->nama} (CIF: {$request->cif})",
                'ip_address'=> $request->ip()
            ]);

            DB::commit();
            return redirect()->route('tugas')->with('success', 'Data spesimen berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $spesimen = Spesimen::findOrFail($id);
        
        // Proteksi: Admin 2-5 hanya boleh edit data yang mereka buat sendiri (Opsional)
        // if (Auth::id() != 1 && $spesimen->user_id != Auth::id()) {
        //    abort(403, 'Anda tidak diizinkan mengedit data ini.');
        // }

        $data = [
            'title'     => 'Edit Spesimen',
            'menuTugas' => 'active',
            'spesimen'  => $spesimen,
        ];
        return view('admin/tugas/edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:400',
            'cif'  => 'required',
            'nama' => 'required',
        ]);

        $spesimen = Spesimen::findOrFail($id);

        try {
            DB::beginTransaction();

            if ($request->hasFile('foto')) {
                $oldPath = public_path('images/' . $spesimen->foto);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                $file = $request->file('foto');
                $namaFile = time() . "_" . rand(100, 999) . "." . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $namaFile);
                $spesimen->foto = $namaFile;
            }

            $spesimen->cif         = $request->cif;
            $spesimen->no_rekening = $request->no_rekening;
            $spesimen->nama        = $request->nama;
            $spesimen->alamat      = $request->alamat;
            $spesimen->nama_ibu    = $request->nama_ibu;
            $spesimen->save();

            ActivityLog::create([
                'user_id'   => Auth::id(),
                'aktivitas' => 'Update Spesimen',
                'keterangan'=> "Mengubah data nasabah: {$spesimen->nama}",
                'ip_address'=> $request->ip()
            ]);

            DB::commit();
            return redirect()->route('tugas')->with('success', 'Data spesimen berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui data.');
        }
    }

    public function destroy($id)
    {
        // Hanya Admin 1 yang boleh menghapus data spesimen (Opsional/Saran Security)
        if (Auth::id() != 1) {
            abort(403, 'Hanya Admin 1 yang dapat menghapus data spesimen.');
        }

        $spesimen = Spesimen::findOrFail($id);
        
        try {
            DB::beginTransaction();

            $filePath = public_path('images/' . $spesimen->foto);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $namaNasabah = $spesimen->nama;
            $spesimen->delete();

            ActivityLog::create([
                'user_id'   => Auth::id(),
                'aktivitas' => 'Hapus Spesimen',
                'keterangan'=> "Menghapus data nasabah: {$namaNasabah}",
                'ip_address'=> request()->ip()
            ]);

            DB::commit();
            return redirect()->route('tugas')->with('success', 'Data spesimen berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data.');
        }
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        
        // Ditambahkan with('user') untuk efisiensi
        $spesimen = Spesimen::with('user')
            ->where(function($query) use ($searchTerm) {
                $query->where('nama', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('cif', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('no_rekening', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('alamat', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('nama_ibu', 'LIKE', "%{$searchTerm}%");
            })->get();

        $data = [
            'title'     => 'Hasil Pencarian: ' . $searchTerm,
            'menuTugas' => 'active',
            'spesimen'  => $spesimen,
        ];

        return view('admin/tugas/index', $data);
    }
    public function dashboard()
{
   // Menggunakan Auth facade agar lebih stabil
    $user = \Illuminate\Support\Facades\Auth::user();

    // Ambil log jika user adalah Admin 1, jika bukan kirim koleksi kosong
    // Ini agar variabel $logs SELALU ada dan tidak menyebabkan error Undefined
    $logs = ($user && $user->id == 1) 
            ? \App\Models\ActivityLog::with('user')->latest()->take(50)->get() 
            : collect(); 

    // Pastikan diarahkan ke folder admin
    return view('admin/dashboard', compact('logs'));
}
}