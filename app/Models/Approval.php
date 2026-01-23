<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = [
    'nasabah_name', 
    'amount', 
    'keterangan', 
    'status', 
    'is_approved', 
    'user_id',
    'approved_by'
];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function user()
{
    // 'user_id' adalah kolom di tabel approvals yang menyimpan ID pengirim/teller
    return $this->belongsTo(\App\Models\User::class, 'user_id');
}
}