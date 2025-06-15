@extends('layouts.app')

@section('content')

<div class="container mx-auto py-8">
    <h3 class="text-2xl font-bold text-white mb-6">Tambah Data Lapangan</h3>

    <form action="{{ route('admin.fields.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label class="block text-white font-bold">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Alamat</label>
            <input type="text" name="alamat" value="{{ old('alamat') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Kategori</label>
            <input type="text" name="kategori" value="{{ old('kategori') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Futsal, Basket, Voli">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Harga per Jam</label>
            <input type="number" name="harga_per_jam" value="{{ old('harga_per_jam') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Jam Buka</label>
            <input type="time" name="jam_buka" value="{{ old('jam_buka') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Jam Tutup</label>
            <input type="time" name="jam_tutup" value="{{ old('jam_tutup') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Gambar</label>
            <input type="file" name="gambar" class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Status</label>
            <select name="status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="tidak tersedia" {{ old('status') == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-lg">
            SIMPAN
        </button>
    </form>
</div>

@endsection
