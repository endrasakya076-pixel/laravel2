<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::all();
        return view('buku.index', compact('buku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $validated = $request->validate([
            'judul' => 'required|min:3',
            'pengarang' => 'required|min:3',
            'tahun_terbit' => 'required'
        ]);
        Buku::create($validated);
        return redirect()->route('buku.index')->with('success','buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::all();
        $bukuDetail = Buku::findOrFail($id);
        return view('buku.index', compact('buku','bukuDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
            'judul' => 'required|min:3',
            'pengarang' => 'required|min:3',
            'tahun_terbit' => 'required'
        ]);
        Buku::where('id', $id)->update($validated);
        return redirect()->route('buku.index')->with('success','buku berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bukuDetail = Buku::findOrFail($id);
        $bukuDetail->delete();
        return redirect()->route('buku.index')->with('success','buku berhasil dihapus');
    }
}
