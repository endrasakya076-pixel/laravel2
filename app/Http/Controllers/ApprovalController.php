<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
   /**
     * Fungsi Privat untuk mengecek otoritas (Helper)
     * Agar tidak mengulang kode yang sama di setiap function
     */
    private function hasAuthority($user)
    {
        // Daftar Jabatan yang diizinkan
        $authorizedPositions = [
            'Supervisor 1', 'Supervisor 2', 'Supervisor 3', 'Supervisor 4', 'Supervisor 5',
            'Kepala Cabang Gerung', 'Kepala Cabang Pancor', 'Kepala Cabang Tanjung'
        ];

        // Cek Nama Spesifik (Hendra) ATAU Role Admin1 ATAU Jabatan dalam daftar
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

    public function approve($id)
    {
        $approval = Approval::findOrFail($id);
    
        if (!$this->hasAuthority(Auth::user())) {
            return redirect()->back()->with('error', 'Anda tidak memiliki otoritas!');
        }

        $approval->update([
            'status' => 'Hapus', 
            'is_approved' => true,
            'approved_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Data berhasil dihapus dari antrean.');
    }

    public function reject($id)
    {
        $approval = Approval::findOrFail($id);

        if (!$this->hasAuthority(Auth::user())) {
            return redirect()->back()->with('error', 'Anda tidak memiliki otoritas!');
        }

        $approval->update([
            'status' => 'Ditolak', 
            'is_approved' => false,
            'approved_by' => Auth::id(),
        ]);

        return redirect()->back()->with('error', 'Status diperbarui: Ditolak');
    }

    public function store(Request $request)
    {
        // Validasi data yang masuk dari fetch JavaScript
    $request->validate([
        'nasabah_name' => 'required|string',
        'amount'       => 'required',
        'keterangan'   => 'nullable|string'
    ]);

    if (Auth::check()) { // Menggunakan Facade Auth
    $user = Auth::user();
    $namaPengirim = $user->nama; 
    $jamInput = now()->format('H:i');

        // 1. Tentukan Status Aktivitas & Keterangan untuk Audit Log
        // Jika request memiliki keterangan "Tidak Sesuai"
        $isSesuai = !str_contains(strtolower($request->keterangan), 'tidak sesuai');
        $statusAktivitas = $isSesuai ? 'Data Pembanding Sesuai' : 'Data Pembanding Tidak Sesuai';
        
        // 2. Format Keterangan Lengkap (untuk tabel approvals)
        $txtKeterangan = $request->keterangan ?? 'Data Pembanding Sesuai';
        $keteranganFinal = $txtKeterangan . " (Oleh: " . ($user->nama ?? $user->name) . " jam " . $jamInput . " WITA)";

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            // 3. Simpan ke Tabel Approvals (Daftar Persetujuan)
            \App\Models\Approval::create([
                'nasabah_name' => $request->nasabah_name,
                'amount'       => str_replace(['.', ','], '', $request->amount),
                'keterangan'   => $keteranganFinal,
                'is_approved'  => false,
                'status'       => 'Baru Masuk',
                'user_id'      => $user->id,
            ]);

            // 4. SIMPAN KE TABEL ACTIVITY_LOGS (Audit Log)
            \App\Models\ActivityLog::create([
                'user_id'    => $user->id,
                'aktivitas'  => $statusAktivitas,
                'keterangan' => "Petugas memverifikasi nasabah [" . $request->nasabah_name . "] dengan hasil: " . $statusAktivitas,
                'ip_address' => $request->ip(),
                'browser'    => $request->userAgent(),
            ]);

            \Illuminate\Support\Facades\DB::commit();

            return response()->json(['message' => 'Berhasil tersimpan di Persetujuan & Audit Log']);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function hold($id)
    {
        $approval = Approval::findOrFail($id);
        $user = Auth::user(); 

        if (!$this->hasAuthority($user)) {
            return redirect()->back()->with('error', 'Otoritas ditolak.');
        }

        $approval->update([
            'status' => 'Setuju',
            'is_approved' => true, 
            'approved_by' => $user->id,
        ]);

        return redirect()->back()->with('info', 'Data berhasil ditandai sebagai Setuju.');
    }
}