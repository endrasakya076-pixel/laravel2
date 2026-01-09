<?php

namespace App\Http\Controllers;

use App\Models\Spesimen;
use Illuminate\Http\Request;

class TugasController extends Controller
{
     public function index()
    {
        // Mengambil semua data dari tabel spesimen
        $spesimen = Spesimen::all();
        $data = array(

            'title' => 'Data Spesimen',
            'menuTugas' => 'active',
            'spesimen' => $spesimen,
        );
        return view('admin/tugas/index', $data);
    }
    public function spesimen()
    {
        $data = array(

            'title' => 'Tambah Spesimen',
            'menuTugas' => 'active',
        );
        return view('admin/tugas/spesimen', $data);
    }
}
