<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $data = array(

            'title' => 'Data User',
            'menuUser' => 'active',
            'user'      => User::orderBy('jabatan','asc')->get() 
        );
        return view('admin/user/index', $data);
    }
    public function create()
    {
        $data = array(

            'title' => 'Tambah Data User',
            'menuUser' => 'active',
        );
        return view('admin/user/create', $data);
    }
    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users|email',
            'jabatan' => 'required',
            'password' => 'required|confirmed|min:8',
            
        ],[
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'jabatan.required' => 'Jabatan wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password.min' => 'Password minimal 8 karakter',
            
        ]);
        $user= new User;
        $user->nama =$request->nama;
        $user->email =$request->email;
        $user->jabatan =$request->jabatan;
        $user->password =Hash::make($request->password);
        $user->is_tugas = false;
        $user->save();

        return redirect()->route('user')->with('success','Data user berhasil ditambahkan');
    }
    public function edit($id)
    {
        $data = array(

            'title' => 'Edit Data User',
            'menuUser' => 'active',
            'user'      => User::findOrFail($id),
        );
        return view('admin/user/edit', $data);
}
 public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'jabatan' => 'required',
            'password' => 'nullable|confirmed|min:8',

        ],[
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'jabatan.required' => 'Jabatan wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password.min' => 'Password minimal 8 karakter',     
 ]);
        $user= User::findOrFail($id);
        $user->nama =$request->nama;
        $user->email =$request->email;
        $user->jabatan =$request->jabatan;
        if ($request->filled('password')) {
            $user->password =Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('user')->with('success','Data user berhasil diedit');
    }
    public function destroy($id){
        $user= User::findOrFail($id);
        $user->delete();

        return redirect()->route('user')->with('success','Data user berhasil dihapus');
    }
}