@extends('layouts.app')

@section('content')

<div class="container mx-auto py-8">
    <h3 class="text-2xl font-bold text-white mb-6">Tambah Data Mahasiswa</h3>

    <form action="{{ url('/mahasiswa/store') }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label class="block text-white font-bold">NIM</label>
            <input type="text" name="mhsw_nim" value="{{ old('mhsw_nim') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="mb-4">
            <label class="block text-white font-bold">Nama</label>
            <input type="text" name="mhsw_nama" value="{{ old('mhsw_nama') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Jurusan</label>
            <select name="mhsw_jurusan" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Pilih Jurusan</option>
                @foreach ($jurusanList as $jurusan)
                    $jurusanList = ['Teknik Informatika', 'Sistem Informasi', 'Aktuaria', 'Teknik Elektro', 'Teknik Industri', 'Manajemen'];
                    <option value="{{ $jurusan }}" {{ old('mhsw_jurusan') == $jurusan ? 'selected' : '' }}>
                        {{ $jurusan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">Alamat</label>
            <input type="text" name="mhsw_alamat" value="{{ old('mhsw_alamat') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-white font-bold">No Telepon</label>
            <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-lg">SIMPAN</button>
    </form>
</div>

@endsection
