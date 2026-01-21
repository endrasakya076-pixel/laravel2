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
    $item = \App\Models\ActivityLog::findOrFail($id); 
    $status = $request->status; // 'berhasil' atau 'gagal'

    // Update status di database utama
    $item->update([
        'status_verifikasi' => $status,
    ]);

    // Kirim nama nasabah ke fungsi log
    // Gunakan strtolower agar rapi atau keep original
    $keterangan = "Data dengan nama " . $item->nama . " telah di-verifikasi: " . $status;

    // Panggil fungsi log
    \App\Http\Controllers\AuditLogController::logVerification($keterangan, $status);

    return redirect()->back()->with('success', 'Verifikasi berhasil dicatat.');
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