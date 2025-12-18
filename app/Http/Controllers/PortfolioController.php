<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class PortfolioController extends Controller
{
     public function index()
    {
        return view('portfolio.index');
    }
    
    public function sendMessage(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);
    
    // Simpan ke database
    ContactMessage::create($request->all());
    
    return response()->json([
        'success' => true,
        'message' => 'Terima kasih ' . $request->name . '! Pesan Anda telah berhasil dikirim.'
    ]);
}
}
