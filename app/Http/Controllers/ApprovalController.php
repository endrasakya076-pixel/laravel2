<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        $title = 'Persetujuan'; // Menambahkan variabel $title untuk view
        // Ambil data persetujuan yang belum disetujui
        $approvals = Approval::where('is_approved', false)->get();

        // Tampilkan view dengan data persetujuan
        return view('admin.approvals.index', compact('approvals', 'title'));
    }

    public function approve($id)
    {
       // 1. Proteksi Keamanan
        if (Auth::user()->role !== 'admin1') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses otorisasi!');
        }

        // 2. Eksekusi Perubahan Status
        $approval = Approval::findOrFail($id);
        $approval->update([
            'status' => 'Disetujui', // Sesuaikan dengan kata yang ingin tampil di tabel
            'is_approved' => true,
            'approved_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Penarikan berhasil disetujui.');
    }
    
    public function reject($id)
    {
        // Cari data persetujuan berdasarkan ID
        $approval = Approval::findOrFail($id);

        // Update status penolakan
        $approval->is_approved = false;
        $approval->approved_by = Auth::id();
        $approval->status = 'Ditolak'; // Kembalikan keterangan menjadi 'Ditolak' jika tombol Tidak Setuju ditekan
        $approval->save();

        // Redirect kembali ke halaman daftar persetujuan
        return redirect()->route('admin.approvals.index')->with('success', 'Persetujuan ditolak!');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nasabah_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        // Simpan data ke tabel approvals
        Approval::create([
            'nasabah_name' => $request->nasabah_name,
            'amount' => $request->amount,
            'is_approved' => false, // Default belum disetujui
        ]);

        return response()->json(['message' => 'Data berhasil disimpan!']);
    }
    
}
