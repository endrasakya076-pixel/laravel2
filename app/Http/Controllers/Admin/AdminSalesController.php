<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSalesController extends Controller
{
    public function index()
    {
        return view('admin.sales.index');
    }

    public function create()
    {
        return view('admin.sales.create');
    }

    public function store(Request $request)
    {
        // Logic to store sales
    }

    public function edit($id)
    {
        return view('admin.sales.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update sales
    }

    public function destroy($id)
    {
        // Logic to delete sales
    }
}