<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditLogController extends Controller
{
    public function index()
    {
        // Proteksi Akses: Hanya Hendra Sakya Permana (ID 1) atau Admin1
        if (Auth::id() != 1 && Auth::user()->role !== 'admin1') {
            return redirect()->route('dashboard.index')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $logs = ActivityLog::with('user')->latest()->paginate(10);

        return view('admin.audit.index', [
            'logs' => $logs,
            'menuAudit' => 'active',
            'title' => 'Audit Log'
        ]);
    }

    /**
     * Fungsi Statis Universal untuk mencatat aktivitas
     * Bisa dipanggil dari Controller manapun
     */
    public static function recordLog($aktivitas, $keterangan)
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id'    => Auth::id(),
                'aktivitas'  => $aktivitas,
                'keterangan' => $keterangan,
                'ip_address' => request()->ip(),
                'browser'    => request()->userAgent(),
            ]);
        }
    }

    /**
     * Integrasi untuk Verifikasi Spesimen (Sesuai/Tidak Sesuai)
     */
    public function updateVerifikasi(Request $request, $id)
    {
        $nasabah = \App\Models\Spesimen::findOrFail($id); 
        $status = $request->status; // 'Sesuai' atau 'Tidak Sesuai'

        // Update status di tabel spesimen
        $nasabah->update([
            'status_verifikasi' => $status,
        ]);

        // Tentukan Judul Aktivitas untuk Log
        $aktivitas = "Verifikasi Spesimen: " . $status;
        $keteranganLog = "Petugas " . Auth::user()->nama . " memverifikasi nasabah [" . $nasabah->nama . "] dengan hasil: " . $status;

        // Panggil fungsi recordLog
        self::recordLog($aktivitas, $keteranganLog);

        return redirect()->back()->with('success', "Status verifikasi " . $nasabah->nama . " berhasil dicatat.");
    }

    public function clear()
    {
        if (Auth::id() == 1) { 
            ActivityLog::truncate();
            return redirect()->route('audit.index')->with('success', 'Log berhasil dibersihkan');
        }
        
        return redirect()->back()->with('error', 'Akses ditolak');
    }
}