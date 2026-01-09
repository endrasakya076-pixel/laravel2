<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spesimen extends Model
{
    protected $fillable = [
        'foto',
        'cif',
        'nama',
        'alamat',
        'nama_ibu',
        'alamat_ibu',
    ];
}
