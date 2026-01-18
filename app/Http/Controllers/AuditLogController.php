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
        $logs = \App\Models\ActivityLog::with('user')->latest()->paginate(20);

    // Arahkan ke folder 'audit' sesuai struktur folder Anda
    return view('admin.audit.index', [
        'logs' => $logs,
        'menuAudit' => 'active',
        'title' => 'Audit Log' // Tambahkan ini untuk memperbaiki error Gambar 20 ($title undefined)
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
}