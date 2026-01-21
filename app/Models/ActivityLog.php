<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'activity_logs';

    // Kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'aktivitas',
        'keterangan',
        'ip_address',
        'browser'
    ];

    /**
     * Relasi ke model User
     * Menghubungkan log dengan admin yang melakukannya
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    
}
