<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil log hanya jika user adalah Admin Utama (ID 1)
    // Gunakan Facade Auth agar tidak ada garis merah pada editor
    $logs = (\Illuminate\Support\Facades\Auth::id() == 1) 
            ? \App\Models\ActivityLog::with('user')->latest()->take(10)->get() 
            : collect();

    return view('admin.dashboard', [
        'title'         => 'Dashboard',      // Memperbaiki error Undefined variable $title
        'menuDashboard' => 'active',
        'logs'          => $logs             // Memperbaiki error Undefined variable $logs
    ]);
    }
}
