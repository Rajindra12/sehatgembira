<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\fields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FieldsController extends Controller
{
    public function index()
    {
        $rows = fields::all();

        // Tambahkan URL gambar ke respons
        foreach ($rows as $row) {
            $row->gambar_url = $row->gambar ? asset('storage/' . $row->gambar) : null;
        }

        return response()->json($rows);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kategori' => 'required',
            'harga_per_jam' => 'required|numeric',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'gambar' => 'nullable|file|image|max:2048',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('fields', 'public');
        }

        $field = fields::create($validated);

        return response()->json([
            'message' => 'Field berhasil ditambahkan',
            'data' => $field,
            'gambar_url' => $field->gambar ? asset('storage/' . $field->gambar) : null
        ], 201);
    }

    public function show(string $id)
    {
        $row = fields::find($id);

        if (!$row) {
            return response()->json(['message' => 'Field tidak ditemukan'], 404);
        }

        $row->gambar_url = $row->gambar ? asset('storage/' . $row->gambar) : null;

        return response()->json($row);
    }

    public function update(Request $request, string $id)
    {
        $field = fields::find($id);

        if (!$field) {
            return response()->json(['message' => 'Field tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kategori' => 'required',
            'harga_per_jam' => 'required|numeric',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'gambar' => 'nullable|file|image|max:2048',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        // Jika ada file gambar baru, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('gambar')) {
            if ($field->gambar) {
                Storage::disk('public')->delete($field->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('fields', 'public');
        }

        $field->update($validated);

        return response()->json([
            'message' => 'Field berhasil diperbarui',
            'data' => $field,
            'gambar_url' => $field->gambar ? asset('storage/' . $field->gambar) : null
        ]);
    }

    public function destroy(string $id)
    {
        $row = fields::find($id);

        if (!$row) {
            return response()->json(['message' => 'Field tidak ditemukan'], 404);
        }

        // Hapus file gambar juga jika ada
        if ($row->gambar) {
            Storage::disk('public')->delete($row->gambar);
        }

        $row->delete();

        return response()->json(['message' => 'Field berhasil dihapus']);
    }
}
