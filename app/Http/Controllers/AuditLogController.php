<?php

namespace App\Http\Controllers;

// Hapus 'use id;' karena tidak diperlukan dan bisa menyebabkan error
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditLogController extends Controller
{
    public function index()
    {
        // Cek apakah user yang login adalah ID 1
    if (Auth::id() != 1) {
        return redirect()->route('dashboard.index')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }

    $logs = \App\Models\ActivityLog::with('user')->latest()->paginate(10);

    return view('admin.audit.index', [
        'logs' => $logs,
        'menuAudit' => 'active',
        'title' => 'Audit Log'
    ]);
    }

    public function clear()
    {
        // Proteksi khusus Admin ID 1
        if (Auth::id() == 1) { 
            ActivityLog::truncate();
            return redirect()->route('audit-log')->with('success', 'Log berhasil dibersihkan');
        }
        
        return redirect()->back()->with('error', 'Akses ditolak');
    }
    public function updateVerifikasi(Request $request, $id)
{
    // Mengambil data berdasarkan ID
    $item = \App\Models\ActivityLog::findOrFail($id); 
    $status = $request->status; // 'berhasil' atau 'gagal'

    // 1. Update status verifikasi di tabel MasterData
    $item->update([
        'status_verifikasi' => $status,
    ]);

    // 2. Gunakan fungsi logVerification dari AuditLogController yang sudah kita buat tadi
    // Ini lebih bersih dan terpusat
    \App\Http\Controllers\AuditLogController::logVerification($item->nama, $status);

    return redirect()->back()->with('success', "Data $item->nama telah di-verifikasi: $status");
}

    // Fungsi untuk mencatat log verifikasi
    public static function logVerification($nama, $status)
    {
        $aktivitas = $status === 'berhasil' ? 'Verifikasi Berhasil' : 'Verifikasi Gagal';
        $keterangan = "Data dengan nama $nama telah di-verifikasi: $status";

        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => $aktivitas,
            'keterangan' => $keterangan,
            'ip_address' => request()->ip(),
            'browser' => request()->header('User-Agent'),
        ]);
    }
}