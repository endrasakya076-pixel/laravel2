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
        // Mengambil semua data agar riwayat yang sudah diproses tetap terlihat
        $approvals = Approval::orderBy('created_at', 'desc')->get();

        return view('admin.approvals.index', compact('approvals', 'title'));
    }

    public function approve($id)
    {
        $approval = Approval::findOrFail($id);
    
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

    public function store(Request $request)
    {
        $request->validate([
        'nasabah_name' => 'required|string',
        'amount' => 'required',
        'keterangan' => 'nullable|string' // Pastikan ini ada
    ]);

    Approval::create([
        'nasabah_name' => $request->nasabah_name,
        'amount' => $request->amount,
        // Jika keterangan kosong (dari tombol Sesuai), isi default. 
        // Jika ada isi (dari tombol Tidak Sesuai), gunakan isi tersebut.
        'keterangan' => $request->keterangan ?? 'Data Pembanding Sesuai',
        'is_approved' => false,
        'status' => 'Baru Masuk',
    ]);

    return response()->json(['message' => 'Data berhasil masuk ke Persetujuan']);
}

    public function hold($id)
    {
        $approval = Approval::findOrFail($id);
        $user = Auth::user(); 

        if ($user->nama !== 'Hendra Sakya Permana' && $user->role !== 'admin1') {
            return redirect()->back()->with('error', 'Otoritas ditolak.');
        }

        $approval->update([
            'status' => 'Setuju',
            'is_approved' => true, // Setujui secara sistem
            'approved_by' => $user->id,
        ]);

        return redirect()->back()->with('info', 'Data berhasil ditandai sebagai Setuju.');
    }
}