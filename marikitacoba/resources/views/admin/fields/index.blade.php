@extends('layouts.app')

@section('content')

<div class="container mx-auto py-8"> 
    
    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Daftar Lapangan</h3> 
    
    {{-- Tombol Tambah Data --}}
    <a href="{{ route('admin.fields.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Tambah Data Lapangan
    </a>
    <br>
    <br>

    {{-- Pesan Sukses atau Error --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Gagal!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-700">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 uppercase text-sm leading-normal">
                    <th class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">ID</th>
                    <th class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">Nama</th>
                    <th class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">Alamat</th>
                    <th class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">Kategori</th>
                    <th class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">Harga/Jam</th>
                    <th class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">Jam Buka</th>
                    <th class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">Jam Tutup</th>
                    <th class="py-3 px-4 text-center border border-gray-300 dark:border-gray-600">Gambar</th>
                    <th class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">Status</th>
                    <th class="py-3 px-4 text-center border border-gray-300 dark:border-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 dark:text-gray-300 text-sm font-light">
                @forelse($rows as $row) 
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <td class="py-3 px-4 text-left whitespace-nowrap border border-gray-300 dark:border-gray-600">{{ $row->id }}</td>
                        <td class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">{{ $row->nama }}</td>
                        <td class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">{{ $row->alamat }}</td>
                        <td class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">{{ $row->kategori }}</td>
                        <td class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">{{ 'Rp ' . number_format($row->harga_per_jam, 0, ',', '.') }}</td>
                        <td class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">{{ $row->jam_buka }}</td>
                        <td class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">{{ $row->jam_tutup }}</td>
                        <td class="py-3 px-4 text-center border border-gray-300 dark:border-gray-600">
                            @if($row->gambar)
                                <img src="{{ asset('storage/' . $row->gambar) }}" alt="{{ $row->nama }}" class="h-16 w-auto mx-auto rounded">
                            @else
                                <span>Tidak ada gambar</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-left border border-gray-300 dark:border-gray-600">
                            @if($row->status == 'tersedia')
                                <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">{{ ucfirst($row->status) }}</span>
                            @elseif($row->status == 'tidak tersedia' || $row->status == 'dipesan')
                                <span class="bg-yellow-200 text-yellow-700 py-1 px-3 rounded-full text-xs">{{ ucfirst($row->status) }}</span>
                            @else
                                <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-xs">{{ ucfirst($row->status) }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center border border-gray-300 dark:border-gray-600">
                            <div class="flex item-center justify-center">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.fields.edit', $row->id) }}" class="w-8 h-8 rounded bg-blue-500 text-white flex items-center justify-center hover:bg-blue-700 mr-2 transform hover:scale-110 transition-transform duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.fields.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded bg-red-500 text-white flex items-center justify-center hover:bg-red-700 transform hover:scale-110 transition-transform duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td colspan="10" class="py-3 px-4 text-center text-gray-500 dark:text-gray-400">
                            Tidak ada data lapangan yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table> 
    </div>
</div>

@endsection