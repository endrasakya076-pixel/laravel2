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
    'approved_by'
];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
