<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Menampilkan halaman katalog dengan semua lapangan yang tersedia.
     */
    public function index(Request $request)
    {
        // Ambil semua kategori unik untuk dropdown filter
        $categories = Field::select('category')->distinct()->get();

        $fields = Field::query()
            // Hanya tampilkan lapangan yang statusnya 'available'
            ->where('status', 'available')
            // Terapkan filter pencarian jika ada
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('address', 'like', '%' . $request->search . '%');
            })
            // Terapkan filter kategori jika ada
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->category);
            })
            ->latest()
            ->paginate(9);

        return view('catalog.index', compact('fields', 'categories'));
    }

    /**
     * Menampilkan halaman detail untuk satu lapangan.
     */
    public function show(Field $field)
    {
        // Pastikan hanya lapangan yang available yang bisa diakses langsung
        if ($field->status !== 'available') {
            abort(404);
        }
        return view('catalog.show', compact('field'));
    }
}