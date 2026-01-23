<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $table = 'approvals'; // Memastikan tabel yang digunakan benar

    protected $fillable = [
        'nasabah_name', 
        'amount', 
        'keterangan', 
        'status', 
        'is_approved', 
        'user_id',      // ID Teller/Pengirim
        'approved_by'   // ID Pejabat/Penyetuju
    ];

    /**
     * Casting tipe data agar Laravel otomatis mengenali formatnya
     */
    protected $casts = [
        'is_approved' => 'boolean',
        'amount'      => 'decimal:0', // Menjaga akurasi angka nominal
    ];

    /**
     * Relasi ke User (Pejabat yang menyetujui)
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Relasi ke User (Teller yang menginput/mengirim)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}