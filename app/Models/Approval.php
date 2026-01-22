<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    public function approver()
{
    return $this->belongsTo(User::class, 'approved_by');
}
}
