<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TugasController extends Controller
{
     public function index()
    {
        $data = array(

            'title' => 'Data Spesimen',
            'menuTugas' => 'active',
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
