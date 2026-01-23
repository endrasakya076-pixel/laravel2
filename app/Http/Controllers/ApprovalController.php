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
        
        // JANGAN memfilter 'is_approved' false saja jika ingin data yang ditolak/disetujui tetap tampil di tabel
        // Kita ambil semua data agar Admin bisa melihat riwayat statusnya
        $approvals = Approval::orderBy('created_at', 'desc')->get();

        return view('admin.approvals.index', compact('approvals', 'title'));
    }

    public function approve($id)
    {
        $approval = Approval::findOrFail($id);

        // Update status sesuai permintaan Anda
        $approval->is_approved = true;
        $approval->approved_by = Auth::id();
        $approval->status = 'Disetujui'; // Kolom status terisi otomatis
        $approval->save();

        return redirect()->route('admin.approvals.index')->with('success', 'Data penarikan berhasil disetujui!');
    }
    
    public function reject($id)
    {
        $approval = Approval::findOrFail($id);

        // Tetap false karena tidak disetujui, tapi status berubah menjadi 'Ditolak'
        $approval->is_approved = false; 
        $approval->approved_by = Auth::id();
        $approval->status = 'Ditolak'; // Kolom status terisi otomatis
        $approval->save();

        return redirect()->route('admin.approvals.index')->with('error', 'Data penarikan telah ditolak!');
    }

    public function store(Request $request)
    {
        // Validasi data (tambahkan 'keterangan' karena kita membutuhkannya dari modal teller)
        $request->validate([
            'nasabah_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        // Simpan data ke tabel approvals dengan status default 'pending'
        Approval::create([
            'nasabah_name' => $request->nasabah_name,
            'amount' => $request->amount,
            'keterangan' => $request->keterangan ?? 'Data Pembanding Sesuai', // Default dari input teller
            'is_approved' => false, 
            'status' => 'pending', // Status awal sebelum diolah Admin 1
        ]);

        return response()->json(['message' => 'Data berhasil dikirim ke Admin 1!']);
    }
}