<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = ['nasabah_name', 'amount', 'is_approved'];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
