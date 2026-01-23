<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
   public function index()
    {
        $title = 'Persetujuan';
        // Mengambil semua data, yang terbaru muncul di atas
        $approvals = Approval::orderBy('created_at', 'desc')->get();

        return view('admin.approvals.index', compact('approvals', 'title'));
    }

    // Aksi untuk tombol "Hapus" (Hanya Hendra/Admin1)
    public function approve($id)
    {
        $approval = Approval::findOrFail($id);
    
        // Validasi Otoritas menggunakan kolom 'nama' sesuai database Anda
        if (Auth::user()->nama !== 'Hendra Sakya Permana' && Auth::user()->role !== 'admin1') {
            return redirect()->back()->with('error', 'Anda tidak memiliki otoritas!');
        }

        $approval->update([
            'status' => 'Hapus', 
            'is_approved' => true,
            'approved_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Data berhasil dihapus dari antrean.');
    }

    // Aksi untuk tombol "Tolak" (Hanya Hendra/Admin1)
    public function reject($id)
    {
        $approval = Approval::findOrFail($id);

        if (Auth::user()->nama !== 'Hendra Sakya Permana' && Auth::user()->role !== 'admin1') {
            return redirect()->back()->with('error', 'Anda tidak memiliki otoritas!');
        }

        $approval->update([
            'status' => 'Ditolak', 
            'is_approved' => false,
            'approved_by' => Auth::id(),
        ]);

        return redirect()->back()->with('error', 'Status diperbarui: Ditolak');
    }

    // Menerima input dari Teller (Sesuai maupun Tidak Sesuai)
    public function store(Request $request)
    {
        $request->validate([
            'nasabah_name' => 'required|string',
            'amount' => 'required',
            'keterangan' => 'nullable|string'
        ]);

        // Logika: Jika keterangan dikirim (Tidak Sesuai), gunakan itu. 
        // Jika null (Sesuai), gunakan default.
        Approval::create([
            'nasabah_name' => $request->nasabah_name,
            'amount' => $request->amount,
            'keterangan' => $request->keterangan ?? 'Data Pembanding Sesuai',
            'is_approved' => false,
            'status' => 'Baru Masuk',
        ]);

        return response()->json(['message' => 'Data berhasil masuk ke Persetujuan']);
    }

    // Aksi untuk tombol "Setuju" (Hanya Hendra/Admin1)
    public function hold($id)
    {
        $approval = Approval::findOrFail($id);
        $user = Auth::user(); 

        if ($user->nama !== 'Hendra Sakya Permana' && $user->role !== 'admin1') {
            return redirect()->back()->with('error', 'Otoritas ditolak.');
        }

        $approval->update([
            'status' => 'Setuju',
            'is_approved' => true, 
            'approved_by' => $user->id,
        ]);

        return redirect()->back()->with('info', 'Data berhasil ditandai sebagai Setuju.');
    }
}