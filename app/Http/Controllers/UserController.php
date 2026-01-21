<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog; // Pastikan Model Log sudah dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $userLogin = Auth::user();

        // Hirarki: Admin 1 melihat semua, Admin 2-5 sembunyikan Admin 1
        if ($userLogin->id == 1) {
            $userList = User::orderBy('jabatan', 'asc')->get();
        } else {
            $userList = User::where('id', '!=', 1)
                            ->orderBy('jabatan', 'asc')
                            ->get();
        }

        $data = [
            'title'    => 'Data User',
            'menuUser' => 'active',
            'user'     => $userList
        ];

        return view('admin/user/index', $data);
    }

    public function create()
    {
        // Hanya Admin 1 yang boleh menambah admin baru
        if (Auth::id() != 1) {
            abort(403, 'Hanya Super Admin yang dapat menambah user baru.');
        }

        $data = [
            'title'    => 'Tambah Data User',
            'menuUser' => 'active',
        ];
        return view('admin/user/create', $data);
    }

    public function store(Request $request)
    {
        if (Auth::id() != 1) { abort(403); }

        $request->validate([
            'nama'     => 'required',
            'email'    => 'required|email|unique:users',
            'jabatan'  => 'required',
            'password' => 'required|confirmed|min:8',
        ], [
            'nama.required'      => 'Nama wajib diisi',
            'email.required'     => 'Email wajib diisi',
            'email.unique'       => 'Email sudah terdaftar',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password.min'       => 'Password minimal 8 karakter',
        ]);

        $user = new User;
        $user->nama     = $request->nama;
        $user->email    = $request->email;
        $user->jabatan  = $request->jabatan;
        $user->role     = 'admin'; // Menandai sebagai admin
        $user->password = Hash::make($request->password);
        $user->save();

        // CATAT LOG
        ActivityLog::create([
            'user_id'   => Auth::id(),
            'aktivitas' => 'Tambah User',
            'keterangan'=> 'Menambahkan user baru: ' . $user->nama,
            'ip_address'=> $request->ip()
        ]);

        return redirect()->route('user')->with('success', 'Data user berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Admin 2-5 tidak boleh mengintip/edit profil Admin 1
        if (Auth::id() != 1 && $id == 1) {
            abort(403, 'Akses dilarang.');
        }

        // Admin 2-5 hanya boleh edit profilnya sendiri (Opsional, hapus jika Admin 2-5 boleh saling edit)
        if (Auth::id() != 1 && Auth::id() != $id) {
            abort(403, 'Anda hanya boleh mengedit profil sendiri.');
        }

        $data = [
            'title'    => 'Edit Data User',
            'menuUser' => 'active',
            'user'     => User::findOrFail($id),
        ];
        return view('admin/user/edit', $data);
    }

    public function update(Request $request, $id)
{
    // Proteksi: Admin lain tidak boleh mengedit data Admin Utama (ID 1)
    if (Auth::id() != 1 && $id == 1) { 
        abort(403, 'Anda tidak memiliki hak akses untuk mengubah data Admin Utama.'); 
    }

    $request->validate([
        'nama'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email,' . $id,
        'jabatan'  => 'required',
        'password' => 'nullable|confirmed|min:8',
    ]);

    $user = User::findOrFail($id);
    
    // Simpan data lama untuk perbandingan di Log (Opsional)
    $jabatanLama = $user->jabatan;

    $user->nama  = $request->nama;
    $user->email = $request->email;

    // PROTEKSI JABATAN: Hanya Admin ID 1 yang boleh mengubah kolom jabatan
    if (Auth::id() == 1) {
        $user->jabatan = $request->jabatan;
    } 
    // Jika bukan ID 1, jabatan tidak diupdate (tetap menggunakan nilai lama)

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }
    
    $user->save();

    // CATAT LOG DENGAN DETAIL LENGKAP
    \App\Models\ActivityLog::create([
        'user_id'   => Auth::id(),
        'aktivitas' => 'Update User',
        'keterangan'=> 'Mengubah data user: ' . $user->nama . ' (Jabatan: ' . $user->jabatan . ')',
        'ip_address'=> $request->ip(),
        'browser'   => $request->userAgent(), // Menambahkan data browser agar tidak error
    ]);

    return redirect()->route('user')->with('success', 'Data user ' . $user->nama . ' berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Admin 1 tidak bisa dihapus oleh siapapun
        if ($id == 1) {
            return redirect()->back()->with('error', 'Admin Utama tidak bisa dihapus!');
        }

        // Hanya Admin 1 yang bisa menghapus admin lainnya
        if (Auth::id() != 1) {
            abort(403);
        }

        $user = User::findOrFail($id);
        $namaUser = $user->nama;
        $user->delete();

        // CATAT LOG
        ActivityLog::create([
            'user_id'   => Auth::id(),
            'aktivitas' => 'Hapus User',
            'keterangan'=> 'Menghapus user: ' . $namaUser,
            'ip_address'=> request()->ip()
        ]);

        return redirect()->route('user')->with('success', 'Data user berhasil dihapus');
    }
}