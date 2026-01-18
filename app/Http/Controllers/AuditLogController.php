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

    $logs = \App\Models\ActivityLog::with('user')->latest()->paginate(20);

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
}