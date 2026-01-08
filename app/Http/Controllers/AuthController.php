<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }
    public function loginProses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8',
        ],
        [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        $data = array(
            'email' => $request->input('email'),
            'password' => $request->input('password'), 
        );
        if(Auth::attempt($data)){
          return redirect()->route('dashboard.index')->with('success', 'Anda berhasil login.');
        } else{
          return redirect()->route('login')->with('error', 'Email atau password salah.');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}

//$email = $request->input('email');
   //     $password = $request->input('password');

        // Contoh validasi sederhana (ganti dengan logika autentikasi yang sesuai)
    //    if ($email === '<EMAIL>' && $password === 'password') {
            // Jika autentikasi berhasil, arahkan ke dashboard
    //        return redirect()->route('dashboard.index');
     //   } else {
            // Jika autentikasi gagal, kembali ke halaman login dengan pesan error
     //       return redirect()->route('login')->with('error', 'Email atau password salah.');
    //    }