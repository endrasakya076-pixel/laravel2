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
     * Helper Otoritas: Mengecek izin user
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
        $title = 'Daftar Persetujuan';
        // Eager loading 'user' untuk performa
        $approvals = Approval::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.approvals.index', compact('approvals', 'title'));
    }

    /**
     * STORE: Menyimpan data dari Menu Spesimen ke Tabel Approvals
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nasabah_name' => 'required|string|max:255',
            'amount'       => 'required',
            'keterangan'   => 'nullable|string'
        ]);

        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Sesi berakhir, silakan login kembali.'], 401);
        }

        try {
            DB::beginTransaction();
            $user = Auth::user();

            // 2. Bersihkan nominal (Hanya angka)
            $cleanAmount = preg_replace('/[^0-9]/', '', $request->amount);

            // 3. Simpan ke Tabel Approvals
            $approval = Approval::create([
                'nasabah_name' => $request->nasabah_name,
                'amount'       => (int) $cleanAmount,
                'keterangan'   => $request->keterangan ?? 'Data Pembanding Sesuai',
                'is_approved'  => false,
                'status'       => 'Baru Masuk',
                'user_id'      => $user->id,
            ]);

            // 4. Catat ke Audit Log
            ActivityLog::create([
                'user_id'    => $user->id,
                'aktivitas'  => 'Input Persetujuan',
                'keterangan' => "Teller [{$user->nama}] mengirim data nasabah {$request->nasabah_name} status: {$approval->keterangan}",
                'ip_address' => $request->ip(),
                'browser'    => $request->userAgent(),
            ]);

            DB::commit();
            return response()->json([
                'status'  => 'success',
                'message' => 'Berhasil! Data telah dikirim ke antrean otorisasi.'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Gagal Simpan Persetujuan: ' . $e->getMessage());
            
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal menyimpan data ke sistem persetujuan.'
            ], 500);
        }
    }

    /**
     * HOLD: Proses Approval oleh Pejabat
     */
    public function hold($id)
    {
        $approval = Approval::findOrFail($id);
        $user = Auth::user();

        if (!$this->hasAuthority($user)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses otorisasi!');
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
                'keterangan' => "Pejabat [{$user->nama}] MENYETUJUI nasabah {$approval->nasabah_name} sebesar " . number_format($approval->amount, 0, ',', '.'),
                'ip_address' => request()->ip(),
                'browser'    => request()->userAgent(),
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Transaksi Berhasil DISETUJUI.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memproses persetujuan.');
        }
    }

    /**
     * REJECT: Penolakan oleh Pejabat
     */
    public function reject($id)
    {
        $approval = Approval::findOrFail($id);
        $user = Auth::user();

        if (!$this->hasAuthority($user)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses otorisasi!');
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
            return redirect()->back()->with('warning', 'Transaksi telah DITOLAK.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memproses penolakan.');
        }
    }
}