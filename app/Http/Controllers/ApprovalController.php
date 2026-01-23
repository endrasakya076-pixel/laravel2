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
        
        // Proteksi: Hanya user bernama 'Hendra Sakya Permana' atau role 'admin1'
        if (Auth::user()->nama !== 'Hendra Sakya Permana' && Auth::user()->role !== 'admin1') {
            return redirect()->back()->with('error', 'Anda tidak memiliki otoritas Admin 1!');
        }

        $approval->update([
            'status'      => 'Disetujui',
            'is_approved' => true,
            'approved_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Penarikan berhasil disetujui oleh Admin 1.');
    }

    public function reject($id)
    {
        $approval = Approval::findOrFail($id);

        if (Auth::user()->nama !== 'Hendra Sakya Permana' && Auth::user()->role !== 'admin1') {
            return redirect()->back()->with('error', 'Anda tidak memiliki otoritas Admin 1!');
        }

        $approval->update([
            'status'      => 'Ditolak',
            'is_approved' => false,
            'approved_by' => Auth::id(),
        ]);

        return redirect()->back()->with('error', 'Penarikan ditolak oleh Admin 1.');
    
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
