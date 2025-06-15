@extends('layouts.app')

@section('content')

<div class="container mx-auto py-8">
    <h3 class="text-2xl font-bold text-white mb-6">Edit Data Lapangan</h3>

    <form action="{{ url('/admin/fields/' . $row->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-white font-bold">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $row->nama) }}" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Alamat</label>
            <input type="text" name="alamat" value="{{ old('alamat', $row->alamat) }}" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Kategori</label>
            <input type="text" name="kategori" value="{{ old('kategori', $row->kategori) }}" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Harga per Jam</label>
            <input type="number" name="harga_per_jam" value="{{ old('harga_per_jam', $row->harga_per_jam) }}" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Jam Buka</label>
            <input type="time" name="jam_buka" value="{{ old('jam_buka', $row->jam_buka) }}" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Jam Tutup</label>
            <input type="time" name="jam_tutup" value="{{ old('jam_tutup', $row->jam_tutup) }}" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Gambar (biarkan kosong jika tidak ingin mengganti)</label>
            <input type="file" name="gambar" class="w-full px-4 py-2 border rounded-lg bg-white text-black">
            @if($row->gambar)
                <p class="text-white mt-2">Gambar saat ini:</p>
                <img src="{{ asset('storage/' . $row->gambar) }}" alt="Gambar Lapangan" class="w-32 h-20 object-cover rounded">
            @endif
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Deskripsi</label>
            <textarea name="deskripsi" class="w-full px-4 py-2 border rounded-lg">{{ old('deskripsi', $row->deskripsi) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Status</label>
            <select name="status" class="w-full px-4 py-2 border rounded-lg">
                <option value="tersedia" {{ old('status', $row->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="tidak tersedia" {{ old('status', $row->status) == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-lg">UPDATE</button>
    </form>
</div>

@endsection
