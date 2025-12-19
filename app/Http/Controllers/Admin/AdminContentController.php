<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminContentController extends Controller
{
    public function index()
    {
        return view('admin.content.index');
    }

    public function create()
    {
        return view('admin.content.create');
    }

    public function store(Request $request)
    {
        // Logic to store content
    }

    public function edit($id)
    {
        return view('admin.content.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update content
    }

    public function destroy($id)
    {
        // Logic to delete content
    }
}