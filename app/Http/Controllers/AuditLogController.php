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
    // 1. Cari data nasabah
    $item = \App\Models\ActivityLog::findOrFail($id); 
    $status = $request->status; // Menerima 'berhasil' atau 'gagal'

    // 2. Update status di tabel utama
    $item->update([
        'status_verifikasi' => $status,
    ]);

    // 3. SUSUN KETERANGAN DENGAN NAMA NASABAH
    // Variabel $item->nama akan mengambil nama nasabah dari database
    $keterangan = "Data dengan nama [" . $item->nama . "] telah di-verifikasi: " . $status;

    // 4. Kirim ke AuditLogController
    \App\Http\Controllers\AuditLogController::logVerification($keterangan, $status);

    return redirect()->back()->with('success', "Verifikasi untuk " . $item->nama . " berhasil disimpan.");
}

    public static function logVerification($keterangan, $status)
    {
        $userId = Auth::id();
        $ipAddress = request()->ip();
        $browser = request()->header('User-Agent');

        \App\Models\ActivityLog::create([
            'user_id' => $userId,
            'aktivitas' => 'Verifikasi Data',
            'keterangan' => $keterangan,
            'ip_address' => $ipAddress,
            'browser' => $browser,
            'status_verifikasi' => $status,
        ]);
    }
}