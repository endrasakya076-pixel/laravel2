<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spesimen extends Model
{
    protected $table = 'spesimen';
    protected $fillable = [
        'foto',
        'cif',
        'no_rekening',
        'nama',
        'alamat',
        'nama_ibu',
        
    ];
}
