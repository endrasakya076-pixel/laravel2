<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil 5-10 log aktivitas terbaru untuk ditampilkan di widget dashboard
        // Jika user bukan Admin ID 1, kita kirimkan collection kosong agar tidak error
        $logs = (auth()->id() == 1) 
                ? ActivityLog::with('user')->latest()->take(10)->get() 
                : collect();
                
        $data = array(
            "title"         => "Dashboard",
            "menuDashboard" => "active",
            "logs"          => $logs,
        ); 
        return view('dashboard', $data);
    }
}
