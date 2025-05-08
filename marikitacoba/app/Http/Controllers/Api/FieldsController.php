<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\fields;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = fields::all();
        return view('user.fields', compact('rows'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kategori' => 'required',
            'harga_per_jam' => 'required',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'gambar' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ], [
            'nama.required' => 'required',
            'alamat.required' => 'required',
            'kategori.required' => 'required',
            'harga_per_jam.required' => 'required',
            'jam_buka.required' => 'required',
            'jam_tutup.required' => 'required',
            'gambar.required' => 'required',
            'deskripsi.required' => 'required',
            'status.required' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $row = fields::find($id);
        return view('user.fields', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kategori' => 'required',
            'harga_per_jam' => 'required',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'gambar' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ], [
            'nama.required' => 'required',
            'alamat.required' => 'required',
            'kategori.required' => 'required',
            'harga_per_jam.required' => 'required',
            'jam_buka.required' => 'required',
            'jam_tutup.required' => 'required',
            'gambar.required' => 'required',
            'deskripsi.required' => 'required',
            'status.required' => 'required',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = fields::find($id);
        if ($row) {
            $row->delete();
            return redirect('user.fields')->with('success', 'Field Successfully Deleted!');
        } else {
            return redirect('user.fields')->with('error', 'Field Not Found!');
        }
    }
}
