<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HaloController extends Controller
{
    function index() 
    {
        $nama = "Hendra Sakya";
        return view('latihan', compact('nama')); 
    }
    
};
