<?php

namespace App\Http\Controllers;

use id;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditLogController extends Controller
{
    public function index()
    {
        $logs = \App\Models\ActivityLog::with('user')->latest()->paginate(20);

    return view('admin.audit_log.index', [
        'logs' => $logs,
        'menuAudit' => 'active' // Ini yang membuat menu di sidebar menyala
    ]);
        return view('admin/audit/index', compact('logs'));
    }

    // Fungsi tambahan untuk membersihkan log lama (Opsional)
    public function clear()
    {
    // Menggunakan Auth Facade untuk menghindari error garis merah pada id()
    if (\Illuminate\Support\Facades\Auth::id() == 1) { 
        \App\Models\ActivityLog::truncate();
        return redirect()->route('audit-log')->with('success', 'Log berhasil dibersihkan');
    }
    
    return redirect()->back()->with('error', 'Akses ditolak');
    }
}
