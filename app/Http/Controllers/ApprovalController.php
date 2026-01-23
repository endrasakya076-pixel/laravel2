<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    private function hasAuthority($user)
    {
        $authorizedPositions = [
            'Supervisor 1', 'Supervisor 2', 'Supervisor 3', 'Supervisor 4', 'Supervisor 5',
            'Kepala Cabang Gerung', 'Kepala Cabang Pancor', 'Kepala Cabang Tanjung'
        ];
        return $user->nama === 'Hendra Sakya Permana' || 
               $user->role === 'admin1' || 
               in_array($user->jabatan, $authorizedPositions);
    }

    public function index()
    {
        $title = 'Persetujuan';
        // Menggunakan with('user') agar loading data lebih cepat
        $approvals = Approval::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.approvals.index', compact('approvals', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nasabah_name' => 'required|string',
            'amount'       => 'required',
            'keterangan'   => 'nullable|string'
        ]);

        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Sesi berakhir, silakan login kembali.'], 401);
        }

        try {
            DB::beginTransaction();
            $user = Auth::user();
            $cleanAmount = preg_replace('/[^0-9]/', '', $request->amount);

            // SIMPAN DATA
            $approval = Approval::create([
                'nasabah_name' => $request->nasabah_name,
                'amount'       => $cleanAmount,
                'keterangan'   => $request->keterangan ?? 'Data Pembanding Sesuai',
                'is_approved'  => false,
                'status'       => 'Baru Masuk',
                'user_id'      => $user->id,
            ]);

            // CATAT AUDIT LOG
            ActivityLog::create([
                'user_id'    => $user->id,
                'aktivitas'  => 'Input Persetujuan',
                'keterangan' => "Teller [{$user->nama}] mengirim nasabah {$request->nasabah_name} senilai Rp " . number_format($cleanAmount, 0, ',', '.'),
                'ip_address' => $request->ip(),
                'browser'    => $request->userAgent(),
            ]);

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Data masuk antrean otorisasi.']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }

    // Fungsi hold & reject sudah aman sesuai kode sebelumnya...
}