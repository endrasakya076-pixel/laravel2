<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\ActivityLog; // Pastikan Model ini di-import
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    /**
     * Helper untuk mengecek otoritas Jabatan
     */
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
        $approvals = Approval::orderBy('created_at', 'desc')->get();
        return view('admin.approvals.index', compact('approvals', 'title'));
    }

    /**
     * Fungsi STORE: Saat Teller klik "Sesuai" atau "Tidak Sesuai" di Menu Spesimen
     */
    public function store(Request $request)
    {
        $request->validate([
            'nasabah_name' => 'required|string',
            'amount'       => 'required',
            'keterangan'   => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $jam = now()->format('H:i');
            
            // Tentukan status untuk Audit Log berdasarkan keterangan dari JavaScript
            $isSesuai = !str_contains(strtolower($request->keterangan), 'tidak sesuai');
            $aktivitasLog = $isSesuai ? 'Data Pembanding Sesuai' : 'Data Pembanding Tidak Sesuai';

            // 1. Simpan ke Tabel Approvals
            $approval = Approval::create([
                'nasabah_name' => $request->nasabah_name,
                'amount'       => str_replace(['.', ','], '', $request->amount), // Bersihkan format rupiah
                'keterangan'   => ($request->keterangan ?? 'Data Pembanding Sesuai') . " (Oleh: {$user->nama} jam {$jam})",
                'is_approved'  => false,
                'status'       => 'Baru Masuk',
                'user_id'      => $user->id,
            ]);

            // 2. Simpan ke Audit Log (PENTING)
            ActivityLog::create([
                'user_id'    => $user->id,
                'aktivitas'  => $aktivitasLog,
                'keterangan' => "Petugas mengirim verifikasi nasabah [" . $request->nasabah_name . "] hasil: " . $aktivitasLog,
                'ip_address' => $request->ip(),
                'browser'    => $request->userAgent(),
            ]);

            DB::commit();
            return response()->json(['message' => 'Berhasil dikirim ke Persetujuan & Audit Log']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Fungsi HOLD: Saat Pejabat klik "SETUJU"
     */
    public function hold($id)
    {
        $approval = Approval::findOrFail($id);
        $user = Auth::user();

        if (!$this->hasAuthority($user)) {
            return redirect()->back()->with('error', 'Otoritas ditolak!');
        }

        try {
            DB::beginTransaction();

            $approval->update([
                'status'      => 'Setuju',
                'is_approved' => true, 
                'approved_by' => $user->id,
            ]);

            ActivityLog::create([
                'user_id'    => $user->id,
                'aktivitas'  => 'Otorisasi Disetujui',
                'keterangan' => "Pejabat [" . $user->nama . "] MENYETUJUI penarikan nasabah " . $approval->nasabah_name . " sebesar Rp " . number_format($approval->amount, 0, ',', '.'),
                'ip_address' => request()->ip(),
                'browser'    => request()->userAgent(),
            ]);

            DB::commit();
            return redirect()->back()->with('info', 'Data disetujui & tercatat di Audit Log.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Fungsi REJECT: Saat Pejabat klik "TOLAK"
     */
    public function reject($id)
    {
        $approval = Approval::findOrFail($id);
        $user = Auth::user();

        if (!$this->hasAuthority($user)) {
            return redirect()->back()->with('error', 'Otoritas ditolak!');
        }

        try {
            DB::beginTransaction();

            $approval->update([
                'status'      => 'Ditolak', 
                'is_approved' => false,
                'approved_by' => $user->id,
            ]);

            ActivityLog::create([
                'user_id'    => $user->id,
                'aktivitas'  => 'Otorisasi Ditolak',
                'keterangan' => "Pejabat [" . $user->nama . "] MENOLAK penarikan nasabah " . $approval->nasabah_name,
                'ip_address' => request()->ip(),
                'browser'    => request()->userAgent(),
            ]);

            DB::commit();
            return redirect()->back()->with('error', 'Status diperbarui: Ditolak & tercatat di Audit Log.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }
}