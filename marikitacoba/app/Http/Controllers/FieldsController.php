<?php

namespace App\Http\Controllers;
use App\Models\fields;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    /**
     * VIEW
     */
    public function index()
    {
        $rows = fields::all();
        return view('user.fields', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.fields.create');
    }

    /**
     * CREATE
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
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        $fields = new fields();
        $fields->nama = $request->nama;
        $fields->alamat = $request->alamat;
        $fields->kategori = $request->kategori;
        $fields->harga_per_jam = $request->harga_per_jam;
        $fields->jam_buka = $request->jam_buka;
        $fields->jam_tutup = $request->jam_tutup;
        $fields->gambar = $request->file('gambar')->store('images', 'public');
        $fields->deskripsi = $request->deskripsi;
        $fields->status = $request->status;

        if ($fields->save()) {
            return redirect()->route('admin.fields.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Data gagal ditambahkan!');
        }
    }
    
    /**
     * EDIT
     */
    // Menampilkan halaman edit
    public function edit($id)
    {
        $row = fields::findOrFail($id);
        return view('admin.fields.edit', compact('row'));
    }

    // Memproses update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kategori' => 'required',
            'harga_per_jam' => 'required',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        $fields = fields::findOrFail($id);
        $fields->nama = $request->nama;
        $fields->alamat = $request->alamat;
        $fields->kategori = $request->kategori;
        $fields->harga_per_jam = $request->harga_per_jam;
        $fields->jam_buka = $request->jam_buka;
        $fields->jam_tutup = $request->jam_tutup;

        if ($request->hasFile('gambar')) {
            $fields->gambar = $request->file('gambar')->store('images', 'public');
        }

        $fields->deskripsi = $request->deskripsi;
        $fields->status = $request->status;

        if ($fields->save()) {
            return redirect()->route('admin.fields.index')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Data gagal diperbarui!');
        }
    }

    //Delete mahasiswa
    public function destroy($mhsw_id)
    {
        $row = fields::find($mhsw_id);
        if ($row) {
            $row->delete();
            return redirect()->route('admin.fields.index')->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }
    }
}
