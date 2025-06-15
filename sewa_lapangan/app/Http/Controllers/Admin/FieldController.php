<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Field;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Jangan lupa tambahkan ini di bagian atas file

    public function index()
    {
        $fields = Field::latest()->paginate(10);
        return view('admin.fields.index', compact('fields'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fields.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'open_time' => 'required|date_format:H:i:s',
            'close_time' => 'required|date_format:H:i:s|after:open_time',
            'status' => 'required|in:available,maintenance,closed',
        ]);

        // Simpan data baru ke database
        Field::create($validatedData);

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.fields.index')->with('success', 'Lapangan baru berhasil ditambahkan.');
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
    public function edit(Field $field)
    {
        // Perhatikan (Field $field). Ini adalah fitur canggih Laravel bernama
        // "Route-Model Binding". Laravel cukup pintar untuk otomatis mencari
        // data `Field` dari database yang ID-nya cocok dengan angka di URL
        // (misal: /admin/fields/5/edit), lalu menyimpannya ke dalam variabel $field.

        // Kirim data lapangan ($field) yang ditemukan ke view 'edit.blade.php'
        return view('admin.fields.edit', compact('field'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Field $field)
    {
        // Validasi datanya sama seperti saat membuat baru
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'open_time' => 'required|date_format:H:i:s',
            'close_time' => 'required|date_format:H:i:s|after:open_time',
            'status' => 'required|in:available,maintenance,closed',
        ]);

        // Gunakan method update() pada data $field yang sudah ditemukan Laravel
        $field->update($validatedData);

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.fields.index')->with('success', 'Data lapangan berhasil diperbarui.');
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy(Field $field)
    {
        // Laravel sudah otomatis mencari data Field berdasarkan ID di URL.
        // Kita tinggal memanggil method delete().
        $field->delete();

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.fields.index')->with('success', 'Data lapangan berhasil dihapus.');
    }
}
