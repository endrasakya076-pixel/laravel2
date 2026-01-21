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
    // 1. Ambil data dari tabel spesimen berdasarkan ID
    // Pastikan Nama Modelnya sesuai (misal: Spesimen)
    $nasabah = \App\Models\Spesimen::findOrFail($id); 
    
    $status = $request->status; // 'berhasil' atau 'gagal'

    // 2. Update status verifikasi di tabel spesimen tersebut
    $nasabah->update([
        'status_verifikasi' => $status,
    ]);

    // 3. SUSUN KETERANGAN: Mengambil kolom 'nama' dari tabel spesimen
    $namaNasabah = $nasabah->nama; 
    $keteranganLog = "Data dengan nama [" . $namaNasabah . "] telah di-verifikasi: " . $status;

    // 4. Kirim ke AuditLogController
    // Pastikan Anda mempassing variabel $keteranganLog yang sudah ada namanya
    \App\Http\Controllers\AuditLogController::logVerification($keteranganLog, $status);

    return redirect()->back()->with('success', "Status verifikasi " . $namaNasabah . " berhasil diperbarui.");
    }
    public static function logVerification($keterangan, $status)
    {
        $userId = Auth::id();
        $ipAddress = request()->ip();
        $browser = request()->header('User-Agent');

        \App\Models\ActivityLog::create([
            'id' => $userId,
            'aktivitas' => 'Verifikasi Data',
            'keterangan' => $keterangan,
            'ip_address' => $ipAddress,
            'browser' => $browser,
            'status_verifikasi' => $status,
        ]);
    }
}