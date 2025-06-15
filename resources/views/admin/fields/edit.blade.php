@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-3xl mx-auto bg-white p-10 rounded-xl shadow-lg border border-gray-200">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-4">Edit Data Lapangan</h2>

        <form action="{{ url('/admin/fields/' . $row->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $row->nama) }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-black focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat', $row->alamat) }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-black focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori', $row->kategori) }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-black focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga per Jam</label>
                    <input type="number" name="harga_per_jam" value="{{ old('harga_per_jam', $row->harga_per_jam) }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-black focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jam Buka</label>
                    <input type="time" name="jam_buka" value="{{ old('jam_buka', $row->jam_buka) }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-black focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jam Tutup</label>
                    <input type="time" name="jam_tutup" value="{{ old('jam_tutup', $row->jam_tutup) }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-black focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar (kosongkan jika tidak ingin mengganti)</label>
                <input type="file" name="gambar" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-black shadow-sm focus:ring-2 focus:ring-black focus:outline-none">
                
                @if($row->gambar)
                    <p class="text-sm text-gray-600 mt-2">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $row->gambar) }}" alt="Gambar Lapangan" class="w-40 h-24 object-cover rounded mt-2 border border-gray-300 shadow-sm">
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-black focus:outline-none">{{ old('deskripsi', $row->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-black focus:outline-none">
                    <option value="tersedia" {{ old('status', $row->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak tersedia" {{ old('status', $row->status) == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>

            <div class="text-right">
                <button type="submit" class="inline-block bg-black text-white hover:bg-gray-800 font-semibold px-6 py-2 rounded-lg transition duration-300">
                    UPDATE
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
