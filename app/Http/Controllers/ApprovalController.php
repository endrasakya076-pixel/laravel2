<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApprovalController extends Controller
{
    /**
     * Helper Otoritas (Pusat Kendali Izin)
     */
    private function hasAuthority($user)
    {
        if (!$user) return false;

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
        // Mengambil data beserta relasi user agar tidak error saat memanggil nama pengirim
        $approvals = Approval::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.approvals.index', compact('approvals', 'title'));
    }

    /**
     * STORE: Dipicu oleh Teller dari Menu Spesimen
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nasabah_name' => 'required|string',
            'amount'       => 'required',
            'keterangan'   => 'nullable|string'
        ]);

        // 2. Cek apakah User Login (Sangat Penting untuk user_id)
        if (!Auth::check()) {
            return response()->json(['message' => 'Sesi berakhir, silakan login kembali.'], 401);
        }

        try {
            DB::beginTransaction();
            $user = Auth::user();

            // 3. Bersihkan nominal (Menghapus titik/koma agar menjadi integer)
            $cleanAmount = preg_replace('/[^0-9]/', '', $request->amount);

            // 4. Proses Simpan ke Tabel Approvals
            $approval = Approval::create([
                'nasabah_name' => $request->nasabah_name,
                'amount'       => $cleanAmount,
                'keterangan'   => $request->keterangan ?? 'Data Pembanding Sesuai',
                'is_approved'  => false,
                'status'       => 'Baru Masuk',
                'user_id'      => $user->id, // Pastikan kolom ini sudah ada di DB
            ]);

            // 5. Catat ke Audit Log
            ActivityLog::create([
                'user_id'    => $user->id,
                'aktivitas'  => 'Input Persetujuan',
                'keterangan' => "Teller [{$user->nama}] mengirim data nasabah {$request->nasabah_name} untuk diotorisasi.",
                'ip_address' => $request->ip(),
                'browser'    => $request->userAgent(),
            ]);

            DB::commit();
            return response()->json([
                'status'  => 'success',
                'message' => 'Berhasil dikirim ke antrean otorisasi.'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            // Mencatat error asli ke file log (storage/logs/laravel.log) untuk pelacakan
            Log::error('Gagal Simpan Persetujuan: ' . $e->getMessage());
            
            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * HOLD: Setuju
     */
    public function hold($id)
    {
        $approval = Approval::findOrFail($id);
        $user = Auth::user();

        if (!$this->hasAuthority($user)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki otoritas!');
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
                'keterangan' => "Pejabat [{$user->nama}] MENYETUJUI nasabah {$approval->nasabah_name} sebesar Rp " . number_format($approval->amount, 0, ',', '.'),
                'ip_address' => request()->ip(),
                'browser'    => request()->userAgent(),
            ]);

            DB::commit();
            return redirect()->back()->with('info', 'Transaksi telah DISETUJUI.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    /**
     * REJECT: Tolak
     */
    public function reject($id)
    {
        $approval = Approval::findOrFail($id);
        $user = Auth::user();

        if (!$this->hasAuthority($user)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki otoritas!');
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
                'keterangan' => "Pejabat [{$user->nama}] MENOLAK nasabah {$approval->nasabah_name}.",
                'ip_address' => request()->ip(),
                'browser'    => request()->userAgent(),
            ]);

            DB::commit();
            return redirect()->back()->with('error', 'Transaksi telah DITOLAK.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }
}