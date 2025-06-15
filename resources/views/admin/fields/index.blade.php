@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Daftar Lapangan</h3>

    <a href="{{ route('admin.fields.create') }}" 
       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Tambah Lapangan
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300 dark:border-white">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Alamat</th>
                    <th class="px-4 py-2 border">Kategori</th>
                    <th class="px-4 py-2 border">Harga/jam</th>
                    <th class="px-4 py-2 border">Jam Buka</th>
                    <th class="px-4 py-2 border">Jam Tutup</th>
                    <th class="px-4 py-2 border">Gambar</th>
                    <th class="px-4 py-2 border">Deskripsi</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $field)
                <tr class="text-gray-800 dark:text-white">
                    <td class="px-4 py-2 border">{{ $field->nama }}</td>
                    <td class="px-4 py-2 border">{{ $field->alamat }}</td>
                    <td class="px-4 py-2 border">{{ $field->kategori }}</td>
                    <td class="px-4 py-2 border">Rp{{ number_format($field->harga_per_jam, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border">{{ $field->jam_buka }}</td>
                    <td class="px-4 py-2 border">{{ $field->jam_tutup }}</td>
                    <td class="px-4 py-2 border">
                        @if($field->gambar)
                            <img src="{{ asset('storage/' . $field->gambar) }}" alt="Gambar" class="w-20 h-20 object-cover rounded">
                        @else
                            Tidak ada
                        @endif
                    </td>
                    <td class="px-4 py-2 border">{{ $field->deskripsi }}</td>
                    <td class="px-4 py-2 border">{{ ucfirst($field->status) }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('admin.fields.edit', $field->id) }}" 
                           class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('admin.fields.destroy', $field->id) }}" 
                              method="POST" class="inline-block ml-2"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if(count($rows) === 0)
                <tr>
                    <td colspan="10" class="text-center px-4 py-4 text-gray-500">Data lapangan belum tersedia.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
