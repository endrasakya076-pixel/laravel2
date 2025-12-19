<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use App\Models\Category;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    public function index()
    {
        $ebooks = Ebook::with('category')
            ->where('is_active', true)
            ->get();
        
        return view('ebooks.index', compact('ebooks'));
    }
    
    public function show($slug)
    {
        $ebook = Ebook::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        $relatedEbooks = Ebook::where('category_id', $ebook->category_id)
            ->where('id', '!=', $ebook->id)
            ->where('is_active', true)
            ->limit(3)
            ->get();
        
        return view('ebooks.show', compact('ebook', 'relatedEbooks'));
    }
}
