<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Field;         
use App\Models\PricingRule;  

class PricingRuleController extends Controller
{
    public function index()
    {
        // Eager load relasi 'field' untuk efisiensi query
        $rules = PricingRule::with('field')->latest()->paginate(10);
        return view('admin.pricing_rules.index', compact('rules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fields = Field::orderBy('name')->get(); // Ambil semua lapangan untuk dropdown
        return view('admin.pricing_rules.create', compact('fields'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'day_type' => 'required|in:weekday,weekend',
            'time_type' => 'required|in:day,night',
            'price_per_hour' => 'required|numeric|min:0',
        ]);

        PricingRule::create($validatedData);

        return redirect()->route('admin.pricing-rules.index')->with('success', 'Aturan harga baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Menampilkan form untuk mengedit aturan harga yang spesifik.
     */
    public function edit(PricingRule $pricingRule)
    {
        // Kita butuh daftar semua lapangan untuk ditampilkan di dropdown,
        // agar admin bisa mengubah aturan ini untuk lapangan lain jika perlu.
        $fields = Field::orderBy('name')->get();
        
        // Kirim data aturan harga spesifik ($pricingRule) dan daftar semua lapangan ($fields) ke view.
        return view('admin.pricing_rules.edit', compact('pricingRule', 'fields'));
    }

    /**
     * Mengupdate aturan harga yang sudah ada di database.
     */
    public function update(Request $request, PricingRule $pricingRule)
    {
        // Aturan validasinya sama persis seperti saat membuat data baru.
        $validatedData = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'day_type' => 'required|in:weekday,weekend',
            'time_type' => 'required|in:day,night',
            'price_per_hour' => 'required|numeric|min:0',
        ]);

        // Gunakan method update() pada data yang sudah ditemukan oleh Laravel.
        $pricingRule->update($validatedData);

        // Arahkan kembali ke halaman index dengan pesan sukses.
        return redirect()->route('admin.pricing-rules.index')->with('success', 'Aturan harga berhasil diperbarui.');
    }

    public function destroy(PricingRule $pricingRule)
    {
        $pricingRule->delete();
        return redirect()->route('admin.pricing-rules.index')->with('success', 'Aturan harga berhasil dihapus.');
    }
}
