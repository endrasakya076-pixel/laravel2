<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        // Ambil data persetujuan yang belum disetujui
        $approvals = Approval::where('is_approved', false)->get();

        // Tampilkan view dengan data persetujuan
        return view('approvals.index', compact('approvals'));
    }

    public function approve($id)
    {
        // Cari data persetujuan berdasarkan ID
        $approval = Approval::findOrFail($id);

        // Update status persetujuan
        $approval->is_approved = true;
        $approval->approved_by = Auth::id();
        $approval->save();

        // Redirect kembali ke halaman daftar persetujuan
        return redirect()->route('admin.approvals.index')->with('success', 'Persetujuan berhasil!');
    }
}
