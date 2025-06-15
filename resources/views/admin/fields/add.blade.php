@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-3xl mx-auto bg-white p-10 rounded-xl shadow-lg border border-gray-200">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-4">Tambah Data Lapangan</h2>

        <form action="{{ route('admin.fields.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat') }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori') }}" placeholder="Futsal, Basket, Voli" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga per Jam</label>
                    <input type="number" name="harga_per_jam" value="{{ old('harga_per_jam') }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jam Buka</label>
                    <input type="time" name="jam_buka" value="{{ old('jam_buka') }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jam Tutup</label>
                    <input type="time" name="jam_tutup" value="{{ old('jam_tutup') }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" name="gambar" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">{{ old('deskripsi') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                    <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak tersedia" {{ old('status') == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>

            <div class="text-right">
                <button type="submit" class="inline-block bg-black text-white hover:bg-gray-800 font-semibold px-6 py-2 rounded-lg transition duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
