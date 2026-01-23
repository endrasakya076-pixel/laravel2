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
     $approval = Approval::findOrFail($id);
    
    // Validasi Otoritas Hendra
    if (Auth::user()->nama !== 'Hendra Sakya Permana' && Auth::user()->role !== 'admin1') {
        return redirect()->back()->with('error', 'Anda tidak memiliki otoritas!');
    }

    $approval->update([
        'status' => 'Disetujui', // Nilai ini yang akan masuk ke kolom Status
        'is_approved' => true,
        'approved_by' => Auth::id(),
    ]);

    return redirect()->back()->with('success', 'Status diperbarui: Disetujui');
    }

    public function reject($id)
    {
    $approval = Approval::findOrFail($id);

    if (Auth::user()->nama !== 'Hendra Sakya Permana' && Auth::user()->role !== 'admin1') {
        return redirect()->back()->with('error', 'Anda tidak memiliki otoritas!');
    }

    $approval->update([
        'status' => 'Ditolak', // Nilai ini yang akan masuk ke kolom Status
        'is_approved' => false,
        'approved_by' => Auth::id(),
    ]);

    return redirect()->back()->with('error', 'Status diperbarui: Ditolak');
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

        public function hold($id)
    {
        // 1. Ambil data berdasarkan ID yang diklik
        $approval = Approval::findOrFail($id);

        // 2. Definisikan user yang sedang login agar tidak error
        $user = Auth::user(); 

        // 3. Proteksi Spesifik untuk Hendra Sakya Permana
        // Pastikan pengecekan kolom 'name' sesuai dengan kolom di tabel users Anda
        if ($user->name !== 'Hendra Sakya Permana' && $user->role !== 'admin1') {
            return redirect()->back()->with('error', 'Otoritas ditolak. Hanya Admin 1 yang bisa menunda proses.');
        }

        // 4. Update status menjadi Menunggu
        $approval->update([
            'status' => 'Menunggu',
            'is_approved' => false,
            'approved_by' => $user->id, // Menggunakan ID dari user yang sedang login
        ]);

        return redirect()->back()->with('info', 'Data berhasil ditandai sebagai Menunggu.');
    }
    
}
