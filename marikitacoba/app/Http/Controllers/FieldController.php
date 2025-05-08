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
        $jurusanList = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Teknik Elektro',
            'Teknik Mesin',
            'Manajemen Bisnis'
        ];
        return view('mahasiswa.add',compact('jurusanList')); 
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
            'gambar' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ], 
        [
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
          
        fields::create([ 
            'nama' => $request->mhsw_nim, 
            'alamat' => $request->mhsw_nama, 
            'kategori' => $request->mhsw_jurusan, 
            'harga_per_jam' => $request->mhsw_alamat,
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'gambar' => $request->gambar,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]); 
    
        return redirect('user.fields')->with('success', 'Field Succesfully Added!'); 
    }
    
    /**
     * EDIT
     */
    // Menampilkan halaman edit
    public function edit($id)
    {
        $fields = fields::findOrFail($id);
        return view('.edit', compact('admin.lapangan'));
    }

    // Memproses update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'mhsw_nim' => 'required',
            'mhsw_nama' => 'required',
            'mhsw_jurusan' => 'required',
            'mhsw_alamat' => 'required',
            'no_telepon' => 'required',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());

        return redirect('/mahasiswa')->with('success', 'Data berhasil diperbarui!');
    }

    //Delete mahasiswa
    public function destroy($mhsw_id)
    {
        $row = Mahasiswa::findOrFail($mhsw_id);
        $row->delete();

        return redirect('mahasiswa');
    }
}
